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

class MembershipController extends Controller
{

    // //membresias User


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
            return back()->with('alert', 'No hay fondos suficientes para realizar la compra, Porfavor dirigase al menu {Recarga de Fondos} ');
        }

        //Genero el registro origen
        // $model = 'MembershipHistory';
        // $model_obj = new MembershipHistory();
        // $model_obj->user_id = $user->id;
        // $model_obj->membership_id = $membership->id;
        // $model_obj->amount = $membership_price;
        // $model_obj->cost = $membership_cost;
        // $model_obj->is_upgrade = $is_upgrade;
        // $model_obj->save();

        //Variables generales
        $amount = $membership_price;
        $charge = 0;
        $total = $amount + $charge;

        //Inicializo usuarios
        // $user_from = &$user;
        // $user_wallet = User::findOrFail(1);
        // $user_admin = User::findOrFail(2);


        // $model_obj->activation_transaction_id = $Tfrom->id;
        // $model_obj->save();

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
        // $price = 1000;
        // $bonusSolidarioPolicy->baseprice = $membership_price;
        // $bonusSolidarioPolicy->fee = $membership->quick_bonus_per;
        
        $bonusSolidarioPolicy = new BonusSolidarioPolicy($rulesPolicySolidary, $user_from)
        
        try {
            
        };
        $bonus = new BonusQuick($bonusSolidarioPolicy);
        
        $bonus->apply(function onRedimAction($user, $sponsor) {
            
            Income::create([
                'user_id' => $user_to->id,
                'amount' => $quick_bonus,
                'description' => 'Bono Rápido '. $trans_description . ' ' . $user->username,
                'type' => 1,
                'status' => 1,
                // 'transaction_id' => $Tto->id,
                'payment_date' => $Tto->created_at
            ]);
        })

        $membership_utility_for_admin = round($membership_price * $membership->utility_perc / 100, 2);
        $model_obj->utility_for_admin = $membership_utility_for_admin;
        $model_obj->save();

        return redirect()->back()->with('message', 'Tu membresía ha sido actualizada con éxito!!');
    }

}
