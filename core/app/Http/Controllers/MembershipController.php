<?php

namespace App\Http\Controllers;

use App\Membership;
use App\Product;
use App\Transaction;
use App\User;
use App\General;
use App\Income;
use App\MembershipHistory;
use App\MembershipActive;
use App\CryptoTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use App\BonusSolidarioPolicy;
use App\BonusSolidary;
use App\Http\Controllers\Bonus\BonusRedeem;

class MembershipController extends Controller
{

    public function index()
    {
        $memberships = Membership::all();
        return view('admin.membership.membership', compact('memberships'));
    }

    public function edit($id)
    {
        $membership = Membership::find($id);
        $products = Product::all();
        return view('admin.membership.edit_membership', compact('membership', 'products'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tittle' => 'required',
            'max_level' => 'required',
            'cost' => 'required|numeric|min:1',
            'utility_perc' => 'required|numeric|min:1',
            'unilevel_perc' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'quick_bonus_per' => 'required|numeric|min:1',
            'days_for_upgrade' => 'required|numeric|min:0',
            'status' => 'required',
            'description' => 'required',
            'product_id' => 'required',
            'product_qty' => 'required|numeric|min:1',
            'days_for_consu' => 'required|numeric|min:0'
        ]);

        $membership = Membership::findOrFail($id);

        //dd($membership);

        if ($request->hasFile('image')) {
            $path = 'assets/images/membership/' . $membership->image;

            if (file_exists($path)) {
                unlink($path);
            }

            $membership['image'] = uniqid() . '.' . ImageCheck($request->image->getClientOriginalExtension());
            $request->image->move('assets/images/membership', $membership['image']);
        }

        $membership['tittle'] = $request->tittle;
        $membership['description'] = $request->description;
        $membership['max_level'] = $request->max_level;
        $membership['cost'] = $request->cost;
        $membership['utility_perc'] = $request->utility_perc;
        $membership['price'] = $request->price;
        $membership['quick_bonus_per'] = $request->quick_bonus_per;
        $membership['days_for_upgrade'] = $request->days_for_upgrade;
        $membership['status'] = $request->status;
        $membership['product_id'] = $request->product_id;
        $membership['product_qty'] = $request->product_qty;
        $membership['days_for_consu'] = $request->days_for_consu;
        $membership['unilevel_perc'] = $request->unilevel_perc;
        $membership->save();

        return redirect()->route('membership.admin.index')->withMsg('Información de membresía actualizada correctamente.');
    }

    //membresias User
    public function membershipIndex()
    {   

        $remaining_days = 0;

        $membership_date = Auth::user()->membership_date;
        if ($membership_date && $membership_date != '0000-00-00') {
            $date1 = new \DateTime($membership_date);
            $date2 = new \DateTime("now");
            $diff = $date1->diff($date2);

            $days = $diff->days;

            if ($days <= Auth::user()->membership->days_for_upgrade) {
                $remaining_days = Auth::user()->membership->days_for_upgrade - $days;
            }
        }
        
        $memberships = Membership::where('status', 1)->get();
        return view('fonts.membership.membership_index', compact('memberships', 'remaining_days'));
    }

    public function membershipHistoryIndex()
    {
        $trans = MembershipHistory::orderBy('id', 'DESC')->paginate(50);
        return view('admin.membership.membership_history', compact('trans'));
    }

    public function historyView($id)
    {
        $trans_object = Transaction::where('model_ref', 'MembershipHistory')->where('model_id', $id)->first();
        $trans = Transaction::where('model_ref', 'MembershipHistory')->where('model_id', $id)->orderBy('id', 'ASC')->get();
        return view('admin.membership.history_view', compact('trans', 'trans_object'));
    }

    public function redeemBonusSolidary ($user, $baseprice) {
        
        $rulesPolicySolidary = [
            'customrules' => [
                'required_directs' => 4,
                'all_directs_active' => true,
            ],
            'payroll' => [
                .10,
                .10,
                .10,
                .30 
            ],
            'isFreeze' => true
        ];
        
        
        // leer bonusredeem contando los referidos activos que posee el 
        $redeem = new BonusRedeem();
        $solidarylist = $redeem->getTotalInvitations($user);
        
        $bonusSolidarioPolicy = new BonusSolidarioPolicy($rulesPolicySolidary, $user,  $baseprice);
        $bonus = new BonusSolidary($bonusSolidarioPolicy);
        
        foreach ($solidarylist as $referreduser) {
            $bonus->addPartner($referreduser);
        }

        $model = 'BonusRedeem';
        
        if (count($bonus->redimir()) > 0) {
            // liquidar bono solidario a owner(sponsor)
            $trans_description = 'Comision b.solidario';

            // leer la nomina y asignar a cada item la transaccion. 
            $nomina =  $bonus->redimir();
            
            foreach ($nomina as $item ) {
                // $quick_bonus = round($membership_price * $membership->quick_bonus_per / 100, 2);
                $solidary_bonus = round($item['amount'], 2);
                //
                $Tto = new Transaction();
                $Tto->user_id = $user->id;
                $Tto->trans_id = rand();
                $Tto->time = Carbon::now();
                $Tto->description = 'Bono Solidario: '. $trans_description . ' '. $item['from_user'];
                $Tto->amount = $solidary_bonus;
                $Tto->type = 80;
                $Tto->charge = 0;
                $Tto->model_ref = $model;
                $Tto->model_id = 1; //$model_obj->id;$user->id;
                $Tto->saveAndUpdateBalance($user);

                Income::create([
                    'user_id' => $user->id,
                    'amount' => $solidary_bonus,
                    'description' => 'Bono Solidario '. $trans_description . ' via usuario (' . $item['from_user'],
                    'type' => 4,
                    'status' => 1,
                    'transaction_id' => $Tto->id,
                    'payment_date' => $Tto->created_at
                ]);
            }

            return true;
        }

        return false;
    }

    public function membershipBuy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|min:1'
        ]);

        $user = User::findOrFail(Auth::user()->id);

        $membership = Membership::findOrFail($request->id);
        
        //calculo días restantes para applicar el valor que pagó en el plan anterior
        $remaining_days = 0;

        $membership_date = $user->membership_date;
        if ($membership_date && $membership_date != '0000-00-00') {
            $date1 = new \DateTime($membership_date);
            $date2 = new \DateTime("now");
            $diff = $date1->diff($date2);

            $days = $diff->days;

            if ($days < $user->membership->days_for_upgrade) {
                $remaining_days = $user->membership->days_for_upgrade - $days;
            }
        }

        $general = General::first();
        $trans_id = 'DP'.rand();
        $trans_description = 'Compra de Membresía ' . $membership->tittle . ' #'. $trans_id;
        $is_upgrade = 0;

        $membership_price = $membership->price;
        $membership_cost = $membership->cost;
        //Si los días de gracia para actualizar plan son vigentes le descuento el valor pagado anteriormente
        if ($user->membership_id < $membership->id && $user->membership_id != 0) {
            if ($remaining_days > 0) {
                $membership_price -= $user->membership->price;
                //actualizo el costo
                $membership_cost -= $user->membership->cost;
                $trans_description = 'Actualización de membresía a ' . $membership->tittle . ' #'. $trans_id;
                $is_upgrade = 1;               
            }
        }

        //valido saldo del usuario
        if ($user->getBalance() < $membership_price) {
            return back()->with('alert', 'No hay fondos suficientes para la compra, Porfavor dirigase a la pestaña Recarga de Fondos');
        }

        //Genero el registro origen
        $model = 'MembershipHistory';
        $model_obj = new MembershipHistory();
        $model_obj->user_id = $user->id;
        $model_obj->membership_id = $membership->id;
        $model_obj->amount = $membership_price;
        $model_obj->cost = $membership_cost;
        $model_obj->is_upgrade = $is_upgrade;
        $model_obj->save();

        //Variables generales
        $amount = $membership_price;
        $charge = 0;
        $total = $amount + $charge;

        //Inicializo usuarios
        $user_from = &$user;
        $user_wallet = User::findOrFail(1);
        $user_admin = User::findOrFail(2);

        //Genero la transaccion de salida de dinero del usuario origen al reserve wallet
        $Tfrom = new Transaction();
        $Tfrom->user_id = $user_from->id;
        $Tfrom->trans_id = rand();
        $Tfrom->time = Carbon::now();
        $Tfrom->description = $trans_description;
        $Tfrom->amount = $total * -1;
        $Tfrom->type = 2;
        $Tfrom->charge = 0;
        $Tfrom->model_ref = $model;
        $Tfrom->model_id = $model_obj->id;
        $Tfrom->saveAndUpdateBalance($user_from);

        //Genero la transacción de entrada de dinero hacia la wallet de reserva
        $Twallet = new Transaction();
        $Twallet->user_id = $user_wallet->id;
        $Twallet->trans_id = rand();
        $Twallet->time = Carbon::now();
        $Twallet->description = 'Ingreso de fondos ' . $trans_description . ' ' . $user_from->username;
        $Twallet->amount = $total;
        $Twallet->type = 15;
        $Twallet->charge = 0;
        $Twallet->model_ref = $model;
        $Twallet->model_id = $model_obj->id;
        $Twallet->saveAndUpdateBalance($user_wallet);


        //Genero la transacción crypto
        CryptoTransaction::create([
            'user_from' => $user_from->id,
            'user_to' => $user_wallet->id,
            'wallet_from' => $user_from->wallet,
            'wallet_to' => $user_wallet->wallet,
            'amount' => $total,
            'description' => $trans_description,
            'status' => 0,
            'transaction_id_from' => $Tfrom->id,
            'transaction_id_to' => $Twallet->id,
        ]);

        $model_obj->activation_transaction_id = $Tfrom->id;
        $model_obj->save();

        //Genero registro de membresia activa

        $start_date = Carbon::now()->toDateString();
        $finish_date =Carbon::now()->addDays(30)->toDateString();

        $membership_active = new MembershipActive();
        $membership_active->user_id = $user_from->id;
        $membership_active->membership_id = $membership->id;
        $membership_active->start_date = $start_date;
        $membership_active->finish_date = $finish_date;
        $membership_active->activation_transaction_id = $Tfrom->id;
        $membership_active->save();

        //Actualizo informacion de usuario
        $user_from->level = 1;
        $user_from->paid_status = 1;
        $user->membership_id = $membership->id;
        $user->membership_date = Carbon::now();
        $user_from->save();

        //Le genero la comisión de bono rápido al patrocinador directo
        $quick_bonus = round($membership_price * $membership->quick_bonus_per / 100, 2);

        //Inicializo al referrer
        $user_to = User::findOrFail($user_from->referrer_id);
        
        //Genero la transacción wallet de salida de dinero para bono rápido al referrer
        $Twallet = new Transaction();
        $Twallet->user_id = $user_wallet->id;
        $Twallet->trans_id = rand();
        $Twallet->time = Carbon::now();
        $Twallet->description = 'Desembolso a ' . $user_to->username . ' Bono Rápido '. $trans_description . ' ' . $user->username;
        $Twallet->amount = $quick_bonus * -1;
        $Twallet->type = 16;
        $Twallet->charge = 0;
        $Twallet->model_ref = $model;
        $Twallet->model_id = $model_obj->id;
        $Twallet->saveAndUpdateBalance($user_wallet);

         //Genero la transacción de entrada de dinero del bono rapido del referrer
         $Tto = new Transaction();
         $Tto->user_id = $user_to->id;
         $Tto->trans_id = rand();
         $Tto->time = Carbon::now();
         $Tto->description = 'Bono Rápido '. $trans_description . ' ' . $user->username;
         $Tto->amount = $quick_bonus;
         $Tto->type = 4;
         $Tto->charge = 0;
         $Tto->model_ref = $model;
         $Tto->model_id = $model_obj->id;
         $Tto->saveAndUpdateBalance($user_to);
 
         //Genero la transaccion Crypto
         CryptoTransaction::create([
             'user_from' => $user_wallet->id,
             'user_to' => $user_to->id,
             'wallet_from' => $user_wallet->wallet,
             'wallet_to' => $user_to->wallet,
             'amount' => $quick_bonus,
             'description' => 'Desembolso ' . $trans_description,
             'status' => 0,
             'transaction_id_from' => $Twallet->id,
             'transaction_id_to' => $Tto->id,
         ]);
 
         //Le genero el registro del ingreso de bono rápido al referrer
         Income::create([
             'user_id' => $user_to->id,
             'amount' => $quick_bonus,
             'description' => 'Bono Rápido '. $trans_description . ' ' . $user->username,
             'type' => 1,
             'status' => 1,
             'transaction_id' => $Tto->id,
             'payment_date' => $Tto->created_at
         ]);
 
         //Genero la transacción wallet de salida de dinero de costo de la membresía a Admin
         $Twallet = new Transaction();
         $Twallet->user_id = $user_wallet->id;
         $Twallet->trans_id = rand();
         $Twallet->time = Carbon::now();
         $Twallet->description = 'Desembolso a Admin Costo ' . $trans_description;
         $Twallet->amount = $membership_cost * -1;
         $Twallet->type = 16;
         $Twallet->charge = 0;
         $Twallet->model_ref = $model;
         $Twallet->model_id = $model_obj->id;
         $Twallet->saveAndUpdateBalance($user_wallet);
 
         //Genero la transacción de entrada de dinero de costo de la membresía a Admin
         $Tadmin = new Transaction();
         $Tadmin->user_id = $user_admin->id;
         $Tadmin->trans_id = rand();
         $Tadmin->time = Carbon::now();
         $Tadmin->description = 'Ingreso por Costo ' . $trans_description . ' ' . $user->username;
         $Tadmin->amount = $membership_cost;
         $Tadmin->type = 13;
         $Tadmin->charge = 0;
         $Tadmin->model_ref = $model;
         $Tadmin->model_id = $model_obj->id;
         $Tadmin->saveAndUpdateBalance($user_admin);
 
         //genero la transaccion crypto
         CryptoTransaction::create([
             'user_from' => $user_wallet->id,
             'user_to' => $user_admin->id,
             'wallet_from' => $user_wallet->wallet,
             'wallet_to' => $user_admin->wallet,
             'amount' => $membership_cost,
             'description' => 'Desembolso Costo ' . $trans_description . ' ' . $user->username,
             'status' => 0,
             'transaction_id_from' => $Twallet->id,
             'transaction_id_to' => $Tadmin->id,
         ]);
 
         $membership_utility_for_admin = round($membership_price * $membership->utility_perc / 100, 2);
         $model_obj->utility_for_admin = $membership_utility_for_admin;
         $model_obj->save();
 
 
         //Genero la transacción wallet de salida de dinero de utilidad de la membresía a Admin
         $Twallet = new Transaction();
         $Twallet->user_id = $user_wallet->id;
         $Twallet->trans_id = rand();
         $Twallet->time = Carbon::now();
         $Twallet->description = 'Desembolso a Admin Utilidad ' . $trans_description;
         $Twallet->amount = $membership_utility_for_admin * -1;
         $Twallet->type = 16;
         $Twallet->charge = 0;
         $Twallet->model_ref = $model;
         $Twallet->model_id = $model_obj->id;
         $Twallet->saveAndUpdateBalance($user_wallet);
 
         //Genero la transacción de entrada de dinero de utilidad de la membresía a Admin
         $Tadmin = new Transaction();
         $Tadmin->user_id = $user_admin->id;
         $Tadmin->trans_id = rand();
         $Tadmin->time = Carbon::now();
         $Tadmin->description = 'Ingreso por Utilidad ' . $trans_description . ' ' . $user->username;
         $Tadmin->amount = $membership_utility_for_admin;
         $Tadmin->type = 17;
         $Tadmin->charge = 0;
         $Tadmin->model_ref = $model;
         $Tadmin->model_id = $model_obj->id;
         $Tadmin->saveAndUpdateBalance($user_admin);
 
         //genero la transaccion crypto
         CryptoTransaction::create([
             'user_from' => $user_wallet->id,
             'user_to' => $user_admin->id,
             'wallet_from' => $user_wallet->wallet,
             'wallet_to' => $user_admin->wallet,
             'amount' => $membership_utility_for_admin,
             'description' => 'Desembolso Utilidad ' . $trans_description . ' ' . $user->username,
             'status' => 0,
             'transaction_id_from' => $Twallet->id,
             'transaction_id_to' => $Tadmin->id,
         ]);
 
         //Calculo la utilidad restanter epartir en la red
         $membership_utility_for_network = round(($membership_price - $quick_bonus -  $membership_cost - $membership_utility_for_admin ) * $membership->unilevel_perc / 100, 2);
         //Calculo el residuo de la compra
         $residue = $membership_price - $quick_bonus - $membership_cost - $membership_utility_for_admin - $membership_utility_for_network;
 
         $model_obj->utility_for_network = $membership_utility_for_network;
         $model_obj->residue = $residue;
         $model_obj->save();
 
         //hago la dispersión de utilidad en la red
 
         $dispersion = $membership->DisperseUnilevelUtility($user, $membership_utility_for_network);
 
         //Reparto los bonos por ingreso unilevel
         foreach ($dispersion as $key => $reg) {
 
             $user_to = User::findOrFail($reg['user_id']);
             $bonus = $reg['amount'];
             $status = 0;
             $payment_date = null;
             $transaction_id = 0;
 
             //Si al usuario se le puede pagar registro transacciones
             if ($reg['pay']) {
             
                 //Genero la transacción wallet de salida de dinero para bono Unilevel al usuario
                 $Twallet = new Transaction();
                 $Twallet->user_id = $user_wallet->id;
                 $Twallet->trans_id = rand();
                 $Twallet->time = Carbon::now();
                 $Twallet->description = 'Desembolso a ' . $user_to->username. ' Bono Unilevel Ingreso usuario ' . $user->username . ' Nivel ' . $key;
                 $Twallet->amount = $bonus * -1;
                 $Twallet->type = 16;
                 $Twallet->charge = 0;
                 $Twallet->model_ref = $model;
                 $Twallet->model_id = $model_obj->id;
                 $Twallet->saveAndUpdateBalance($user_wallet);
 
                 //Genero la transacción de entrada de dinero del bono Unilevel al usuario
                 $Tto = new Transaction();
                 $Tto->user_id = $user_to->id;
                 $Tto->trans_id = rand();
                 $Tto->time = Carbon::now();
                 $Tto->description = 'Bono Unilevel Ingreso usuario ' . $user->username . ' Nivel ' . $key;
                 $Tto->amount = $bonus;
                 $Tto->type = 5;
                 $Tto->charge = 0;
                 $Tto->model_ref = $model;
                 $Tto->model_id = $model_obj->id;
                 $Tto->saveAndUpdateBalance($user_to);
 
                 //Genero la transaccion Crypto
                 CryptoTransaction::create([
                     'user_from' => $user_wallet->id,
                     'user_to' => $user_to->id,
                     'wallet_from' => $user_wallet->wallet,
                     'wallet_to' => $user_to->wallet,
                     'amount' => $bonus,
                     'description' => 'Desembolso Bono Unilevel Ingreso usuario ' . $user->username . ' Nivel ' . $key,
                     'status' => 0,
                     'transaction_id_from' => $Twallet->id,
                     'transaction_id_to' => $Tto->id,
                 ]);
                 
                 $status = 1;
                 $payment_date =$Tto->created_at;
                 $transaction_id = $Tto->id;
             }
 
             //Le genero el registro del ingreso de bono Unilevel al usuario
             Income::create([
                 'user_id' => $user_to->id,
                 'amount' => $bonus,
                 'description' => 'Bono Unilevel '. $trans_description . ' ' . $user->username . ' Nivel ' . $key,
                 'type' => 2,
                 'status' => $status,
                 'transaction_id' => $transaction_id,
                 'payment_date' => $payment_date
             ]);
         }
 
         //Si hay residuo envío al admin
         if ($residue != 0) {
                 //Genero la transacción wallet de salida de dinero de Restante utilidad de la membresía a Admin
             $Twallet = new Transaction();
             $Twallet->user_id = $user_wallet->id;
             $Twallet->trans_id = rand();
             $Twallet->time = Carbon::now();
             $Twallet->description = 'Desembolso a Admin Restante Utilidad ' . $trans_description;
             $Twallet->amount = $residue * -1;
             $Twallet->type = 16;
             $Twallet->charge = 0;
             $Twallet->model_ref = $model;
             $Twallet->model_id = $model_obj->id;
             $Twallet->saveAndUpdateBalance($user_wallet);
 
             //Genero la transacción de entrada de dinero de Restante de utilidad de la membresía a Admin
             $Tadmin = new Transaction();
             $Tadmin->user_id = $user_admin->id;
             $Tadmin->trans_id = rand();
             $Tadmin->time = Carbon::now();
             $Tadmin->description = 'Ingreso por Restante Utilidad ' . $trans_description . ' ' . $user->username;
             $Tadmin->amount = $residue;
             $Tadmin->type = 19;
             $Tadmin->charge = 0;
             $Tadmin->model_ref = $model;
             $Tadmin->model_id = $model_obj->id;
             $Tadmin->saveAndUpdateBalance($user_admin);
 
             //genero la transaccion crypto
             CryptoTransaction::create([
                 'user_from' => $user_wallet->id,
                 'user_to' => $user_admin->id,
                 'wallet_from' => $user_wallet->wallet,
                 'wallet_to' => $user_admin->wallet,
                 'amount' => $residue,
                 'description' => 'Desembolso Restante Utilidad ' . $trans_description . ' ' . $user->username,
                 'status' => 0,
                 'transaction_id_from' => $Twallet->id,
                 'transaction_id_to' => $Tadmin->id,
             ]);
         }
 
         $model_obj->status = 1;
         $model_obj->save();
 
         return redirect()->back()->with('message', 'Tu membresía ha sido actualizada con éxito!!');
     
    }

}
