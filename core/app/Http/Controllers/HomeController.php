<?php


/**
 * 
 * for deposit view: @method:ether, @method:btc
 */
namespace App\Http\Controllers;

use App\ChargeCommision;
use App\Income;
use App\LendingLog;
use App\Deposit;
use App\Gateway;
use App\Lib\GoogleAuthenticator;
use App\Package;
use App\Transaction;
use App\User;
use App\Tree;
use App\Withdraw;
use App\General;
use App\WithdrawTrasection;
use App\Membership;
use App\Product;
use App\Order;
use App\CryptoTransaction;
use App\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

// BIN
use App\Http\Controllers\Tree\NetworkInfo;
use App\Http\Controllers\Tree\BinaryDeepInfo;
use App\Http\Controllers\Tree\BinaryCountVolumen;
use App\Http\Controllers\Tree\UsersBinary;


use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','ckstatus']);
    }

    public function index()
    {
        return view('home');
    }

    public function treeIndex()
    {
       return view('fonts.marketing.my_tree_d3');
    }

    public function treeBinary()
    {
        $root = Auth::user()->id;
        $tree = DB::table('users_binaries')->get();

        // echo '<pre>';
        // print_r($tree);
        // echo '</pre>';
        $count = new BinaryCountVolumen($tree);
        $left = $count->getTotalLeft($root);
        $right = $count->getTotalRight($root);


        // echo '<pre>';
        // print_r($left);
        // echo '</pre>';


        // echo '<pre>';
        // print_r($right);
        // echo '</pre>';

        $total_right = 0;
        $total_left = 0;

        if (!empty($left)) {

            for ($i = 0; $i < count($left); $i++) {
                $total_left += $left[$i]['volumen'];
            }
        }

        if (!empty($right)) {
            for ($i = 0; $i < count($right); $i++) {
            $total_right += $right[$i]['volumen'];
            }
        }

        $response['left'] = array('volumen' => $total_left);
        $response['right'] = array('volumen' => $total_right);

        /*$minor = min($left['volumen'], $right['volumen']);
        $power = max($left['volumen'], $right['volumen']);
*/
        $minor = min($total_left, $total_right);

        $power = max($total_left, $total_right);


        $rate = 0.5;
        $total = ($minor * $rate) / 100;
        // // Vol Equipo de poder: (' + power + 'pts ) ---- Vol Equipo de pago: (' + minor + 'pts) 
        $msg = 'Felicitaciones, Tu bono binario [0.5%] es  (' . $total . ' pts)';

        // $response['power'] = $power;
        // $response['minor'] = $minor;
        // $response['amount'] = $total;
        // $response['message'] = $msg;


        
        $deepBInaryInfo = new BinaryDeepInfo($tree);
        
        $lastLeftId =  $deepBInaryInfo->getLastNodeLeft($root)->id;
        $lastRightId = $deepBInaryInfo->getLastNodeRight($root)->id;

        $left = NetworkInfo::generatePartnerLink($lastLeftId, $root, 'left');
        $right = NetworkInfo::generatePartnerLink($lastRightId, $root, 'right');
        
        $links = ['left' => $left, 'right'=> $right];

        return view('fonts.marketing.my_tree_binary', compact('links', 'root', 'minor', 'power', 'msg', 'total'));
    }

    public function treeUser()
    {
        $tree = Tree::getNestedTreeForD3(Auth::user()->id, 20);
        return response()->json($tree);
    }

    public function referralIndex()
    {
        $ref = User::where('referrer_id', Auth::user()->id)->get();
        return view('fonts.marketing.my_referral', compact('ref'));
    }

    public function referraCommsisionlIndex()
    {
        $ref_income = Income::where('user_id', Auth::user()->id)
            ->where('type', 1)->orderBy('id', 'desc')->get();
        return view('fonts.my_income.referral_commission', compact('ref_income'));
    }

    public function unilevelCommsisionlIndex()
    {
        $b_income = Income::where('user_id', Auth::user()->id)
            ->where('type', 2)->orderBy('id', 'desc')->get();
        return view('fonts.my_income.unilevel_commission', compact('b_income'));
    }

    public function consumptionCommsisionlIndex()
    {
        $b_income = Income::where('user_id', Auth::user()->id)
            ->where('type', 3)->orderBy('id', 'desc')->get();
        return view('fonts.my_income.consumption_commission', compact('b_income'));
    }

    public function fundIndex()
    {
        $gates = Gateway::where('status', 1)->get();
        return view('fonts.finance.add_fund', compact('gates'));
    }

    //Productos
    public function productIndex()
    {   
        
        $products = Product::where('status', 1)->get();
        return view('fonts.product.product_index', compact('products'));

    }

    public function productBuy(Request $request)
    {   
        $this->validate($request, [
            'id' => 'required|numeric|min:1',
            'qty' => 'required|numeric|min:1'

        ]);

        $user = User::findOrFail(Auth::user()->id);

        $product = Product::findOrFail($request->id);
        
        $price = $product->price;

        if ($user->price_group == 2) {
            $price = $product->price2;
        } elseif ($user->price_group == 3){
            $price = $product->price2;
        }
        
        $trans_description = 'Compra ' . $product->name;

        $product_price = $product->price;

        //valido saldo del usuario
        if ($user->balance < $product_price) {
            return back()->with('alert', 'No hay fondos suficientes para realizar la compra');
        }

        return  back()->with('alert', 'Las compras seran habilitadas próximamente');

    }

    public function withdrawIndex()
    {
        $gates = Withdraw::where('status', 1)->get();
        return view('fonts.finance.request_withdraw', compact('gates'));
    }

    public function withdrawPreview(Request $request)
    {
        $this->validate($request, [
            'gateway' =>'required',
            'amount' => 'required|numeric|min:1'
        ]);

        $amount = $request->amount;
        $method = Withdraw::find($request->gateway);

        if ($request->amount < Auth::user()->balance && $request->amount > $method->min_amo && $request->amount < $method->max_amo)
        {
            return view('fonts.finance.withdraw_preview', compact('method', 'amount'));
        }else{
            return redirect()->back()->with('alert', 'El monto solicitado no es válido');
        }

    }

    public function transferFundIndex()
    {
        $comission = ChargeCommision::first();
        return view('fonts.finance.fund_transfer', compact('comission'));
    }


    public function transacHistory()
    {
        $trans = Transaction::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')->get();
        return view('fonts.finance.trans_history',compact('trans') );
    }

    public function profileIndex()
    {
        
        return view('fonts.profile');
    }

    public function storeDeposit(Request $request)
    {
        $this->validate($request,[
                'amount' => 'required',
                'gateway' => 'required',
            ]);

        $gate = Gateway::findOrFail($request->gateway);

        if ( $request->amount < $gate->minamo || $request->amount > $gate->maxamo)
        {
            return back()->with('alert', 'Invalid Amount');
        }
        else
        {

            if(is_null($gate))
            {
                return back()->with('alert', 'Please Select a Payment Gateway');
            }
            else
            {
                if ($gate->id == 3 ) // @method:btc
                {
                    $all = file_get_contents("https://blockchain.info/ticker");
                    $res = json_decode($all);
                    $btcrate = $res->USD->last;
                    $amount = $request->amount;
                    $btcamount = $request->amount/$btcrate;
                    $btc = round($btcamount, 8);

                    // $one = $amount + $gate->chargefx;
                    // $two = ($amount * $gate->chargepc)/100;

                    $charge = $gate->chargefx + (( $amount *  $gate->chargepc )/100);
                    $totalbase = $amount+$charge;
                    $totalusd = $totalbase/$gate->rate;
                    $payablebtc = round($totalusd/$btcrate, 8); // user will pay this amount of BTC


                    $sell['user_id'] = Auth::id();
                    $sell['gateway_id'] = $gate->id;
                    $sell['amount'] = $amount;
                    $sell['status'] = 0;
                    $sell['bcam'] = $payablebtc;
                    $sell['trx_charge'] = $charge;
                    $sell['trx'] = 'DP'.rand();
                    Deposit::create($sell);

                    Session::put('Track', $sell['trx']);

                    return view('fonts.preview', compact('btc','gate','amount', 'payablebtc'));
                } //@method:ether 
                else if ($gate->id == 10) { 

                    $all = file_get_contents("https://api.etherscan.io/api?module=stats&action=ethprice&apikey=YourApiKeyToken");
                    $res = json_decode($all);
                    
                    $ethrate = $res->result->ethusd;
                    $amount = $request->amount;
                    $btcamount = $request->amount/$ethrate;

                    $btc = round($btcamount, 4);
                    
                    $one = $amount + $gate->chargefx; 
                    $two = ($amount * $gate->chargepc)/100;
                    
                    // $gate = (object) ['name'=> 'Ethereum', 'rate'=> 1, 'id'=> 10, 'chargefx' => 5,  'chargepc' => 0];
                    
                    $charge = $gate->chargefx + (( $amount *  $gate->chargepc )/100);
                    $totalbase = $amount+$charge; // total + fee

                    $totalusd = $totalbase/$gate->rate;
                    //$payablebtc = round($totalusd/$ethrate, 8); // user will pay this amount of BTC
                    $payablebtc = round($totalusd, 8);

                    $sell['user_id'] = Auth::id();
                    $sell['gateway_id'] = $gate->id;
                    $sell['amount'] = $amount;
                    $sell['status'] = 0;
                    $sell['bcam'] = $payablebtc;
                    // $sell['bcid'] = $payablebtc;
                    $sell['trx_charge'] = $charge;
                    $sell['trx'] = 'DP'.rand();
                    Deposit::create($sell);

                    Session::put('Track', $sell['trx']);

                    return view('fonts.preview', compact('btc','gate','amount', 'payablebtc'));
                }
                else if ($gate->id == 11) { 

                    $all = file_get_contents("https://api.etherscan.io/api?module=stats&action=ethprice&apikey=YourApiKeyToken");
                    $res = json_decode($all);
                    
                    $ethrate = $res->result->ethusd;
                    $amount = $request->amount;
                    $btcamount = $request->amount; ///$ethrate;

                    $btc = round($btcamount, 4);
                    
                    $one = $amount + $gate->chargefx; 
                    $two = ($amount * $gate->chargepc)/100;
                    
                    // $gate = (object) ['name'=> 'Ethereum', 'rate'=> 1, 'id'=> 10, 'chargefx' => 5,  'chargepc' => 0];
                    
                    $charge = $gate->chargefx + (( $amount *  $gate->chargepc )/100);
                    $totalbase = $amount+$charge; // total + fee

                    $totalusd = $totalbase/$gate->rate;
                    //$payablebtc = round($totalusd/$ethrate, 8); // user will pay this amount of BTC

                    $payablebtc = round($totalusd, 8); // user will pay this amount of BTC

                    $sell['user_id'] = Auth::id();
                    $sell['gateway_id'] = $gate->id;
                    $sell['amount'] = $amount;
                    $sell['status'] = 0;
                    $sell['bcam'] = $payablebtc;
                    // $sell['bcid'] = $payablebtc;
                    $sell['trx_charge'] = $charge;
                    $sell['trx'] = 'DP'.rand();
                    Deposit::create($sell);

                    Session::put('Track', $sell['trx']);

                    return view('fonts.preview', compact('btc','gate','amount', 'payablebtc'));
                }
                 else {
                    $amount = $request->amount;
                    $usd = $request->amount;

                    $charge = $gate->chargefx + ( $amount *  $gate->chargepc )/100;

                    $sell['user_id'] = Auth::id();
                    $sell['gateway_id'] = $gate->id;
                    $sell['amount'] = $amount;
                    $sell['status'] = 0;
                    $sell['usd_amount'] = $amount;
                    $sell['trx_charge'] = $charge;
                    $sell['trx'] = 'DP'.rand();

                    if ($gate->id == 9) {
                        $sell['status'] = 9; //Se confirmará en la view de preview, pasará a 0
                    }

                    Deposit::create($sell);
                    Session::put('Track', $sell['trx']);

                    return view('fonts.preview', compact('usd','gate','amount'));
                }
            }
        }
    }

    public function storeWithdraw(Request $request)
    {
        $this->validate($request,[
                'amount' => 'required',
                'charge' => 'required',
                'method_name' => 'required',
                'processing_time' => 'required',
                'detail' => 'required',
                'method_cur' => 'required',
            ]);


        $withdraw = WithdrawTrasection::create([
           'amount' => $request->amount,
           'charge' => $request->charge,
           'method_name' => $request->method_name,
           'processing_time' => $request->processing_time,
           'detail' => $request->detail,
           'method_cur' => $request->method_cur,
           'withdraw_id' => 'RET'.rand(),
           'user_id' => Auth::user()->id,
        ]);

         $general = General::first();
         $user = User::find(Auth::user()->id);

         $message ='Tu solicitud de retiro fue éxitosa, Por favor espera a que se procese la transacción durante el tiempo indicado. Monto del retiro : '.$withdraw->amount.' '.$general->symbol;
         

        send_email($user['email'], 'Solicitud de retiro' ,$user['first_name'], $message);

        return redirect('home')->with('message', 'Solicitud de retiro realizado con éxito, Por favor espera a que se complete la transacción durante el tiempo indicado');
    }

    public function confirmUserAjax(Request $request)
    {
        if (Auth::user()->username == $request->name)
        {
            return "<b class='btn btn-warning btn-block btn-lg'style='margin-bottom:20px;'>No te puedes transferir a ti mism@...</b>";
        }else{
            $user_name = User::where('username', $request->name)->first();

            if ($user_name == '')
            {
                return "<b class='btn btn-danger btn-block  btn-lg' style='margin-bottom:20px;'>Usuario no encontrado</b>";
            }
            else{
                return "<b class='btn btn-success btn-block  btn-lg'style='margin-bottom:20px;'>Usuario: {$user_name->first_name} {$user_name->last_name}</b>
                            <input type='hidden' name='username' value='$user_name->id' >";
            }

        }

    }

    public function transferFund(Request $request)
    {

        $this->validate($request, [
            'amount' =>'required|numeric|min:1',
            'username' => 'required|numeric|min:3'
        ],
        [
            'amount.required' =>'El monto es requerido',
            'amount.numeric' =>'El monto no es válido',
            'amount.min' =>'El monto no es válido',
            'username.required' =>'El usuario a transferir no es válido',
            'username.numeric' =>'El usuario a transferir no es válido',
            'username.min' =>'El usuario a transferir no es válido',

        ]);

        if (Auth::user()->id == $request->username) {
            return redirect()->back()->with('alert','No se puede transferir a si mismo');
        }

        $comission = ChargeCommision::first();

        $charge = round(($request->amount * $comission->transfer_charge)/100, 2);

        $total = $charge + $request->amount;

        if(Auth::user()->getBalance() < $total)
        {
            return redirect()->back()->with('alert','Saldo insuficiente');
        }

        $user_from = User::findOrFail(Auth::user()->id);
        $user_wallet =User::findOrFail(1);
        $user_to = User::findOrFail($request->username);
        $user_admin = User::findOrFail(2);

        //Genero el registro origen de la transferencia
        $model = 'Transfer';
        $model_obj = new Transfer();
        $model_obj->user_from = $user_from->id;
        $model_obj->user_to = $user_to->id;
        $model_obj->amount =  $request->amount;
        $model_obj->charge = $charge;
        $model_obj->status = 0;
        $model_obj->save();

        $general = General::first();
        $balance_transfer_id = 'TF'.rand();

        //Genero la transaccion de salida de dinero del usuario origen al reserve wallet
        $Tfrom = new Transaction();
        $Tfrom->user_id = $user_from->id;
        $Tfrom->trans_id = rand();
        $Tfrom->time = Carbon::now();
        $Tfrom->description = 'Transferencia de fondos enviado a ' . $user_to->username . ' #'. $balance_transfer_id;
        $Tfrom->amount = $request->amount * -1;
        $Tfrom->type = 9;
        $Tfrom->charge = $charge * -1;
        $Tfrom->model_ref = $model;
        $Tfrom->model_id = $model_obj->id;
        $Tfrom->saveAndUpdateBalance($user_from);

        //Genero la transacción de entrada de dinero hacia la wallet de reserva
        $Twallet = new Transaction();
        $Twallet->user_id = $user_wallet->id;
        $Twallet->trans_id = rand();
        $Twallet->time = Carbon::now();
        $Twallet->description = 'Ingreso de fondos Transferencia de fondos de '. $user_from->username . ' a ' . $user_to->username . ' #'. $balance_transfer_id;
        $Twallet->amount = $request->amount + $charge;
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
            'amount' => $request->amount + $charge,
            'description' => 'Transferencia de fondos '. $user_from->username . ' a ' . $user_to->username . ' #'. $balance_transfer_id,
            'status' => 0,
            'transaction_id_from' => $Tfrom->id,
            'transaction_id_to' => $Twallet->id,
        ]);

        //Genero la transacción wallet de salida de dinero transferido hacia el usuario destino
        $Twallet = new Transaction();
        $Twallet->user_id = $user_wallet->id;
        $Twallet->trans_id = rand();
        $Twallet->time = Carbon::now();
        $Twallet->description = 'Desembolso Transferencia de fondos para '. $user_to->username . ' #'. $balance_transfer_id;
        $Twallet->amount = $request->amount * -1;
        $Twallet->type = 16;
        $Twallet->charge = 0;
        $Twallet->model_ref = $model;
        $Twallet->model_id = $model_obj->id;
        $Twallet->saveAndUpdateBalance($user_wallet);

        //Genero la transacción de entrada de dinero del usuario destino
        $Tto = new Transaction();
        $Tto->user_id = $user_to->id;
        $Tto->trans_id = rand();
        $Tto->time = Carbon::now();
        $Tto->description = 'Transferencia de fondos recibido de '. $user_from->username . ' #'. $balance_transfer_id;
        $Tto->amount = $request->amount;
        $Tto->type = 8;
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
            'amount' => $request->amount,
            'description' => 'Desembolso Transferencia de fondos para '. $user_from->username . ' #'. $balance_transfer_id,
            'status' => 0,
            'transaction_id_from' => $Twallet->id,
            'transaction_id_to' => $Tto->id,
        ]);

        //Genero la transacción wallet de salida de dinero para ingreso de cargo por transferencia a admin
        $Twallet = new Transaction();
        $Twallet->user_id = $user_wallet->id;
        $Twallet->trans_id = rand();
        $Twallet->time = Carbon::now();
        $Twallet->description = 'Desembolso Cargo - Transferencia de fondos enviados ( ' .$request->amount. ' '.$general->symbol. ' ) de '. $user_from->username . ' a ' . $user_to->username .' #'. $balance_transfer_id;
        $Twallet->amount = $charge * -1;
        $Twallet->type = 16;
        $Twallet->charge = 0;
        $Twallet->model_ref = $model;
        $Twallet->model_id = $model_obj->id;
        $Twallet->saveAndUpdateBalance($user_wallet);

        //Genero la transacción de entrada de dinero por cargo de transaccion a Admin
        $Tadmin = new Transaction();
        $Tadmin->user_id = $user_admin->id;
        $Tadmin->trans_id = rand();
        $Tadmin->time = Carbon::now();
        $Tadmin->description = 'Ingreso por Cargo - Transferencia de fondos enviados ( ' . $request->amount . ' '.$general->symbol. ' ) de '. $user_from->username . ' a ' . $user_to->username .' #'. $balance_transfer_id;
        $Tadmin->amount = $charge;
        $Tadmin->type = 12;
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
            'amount' => $charge,
            'description' => 'Desembolso Cargo - Transferencia de fondos enviados ( ' . $request->amount . ' '.$general->symbol. ' ) de '. $user_from->username . ' a ' . $user_to->username .' #'. $balance_transfer_id,
            'status' => 0,
            'transaction_id_from' => $Twallet->id,
            'transaction_id_to' => $Tadmin->id,
        ]);

        $model_obj->status = 1;
        $model_obj->save();

        //Envío Email

        $message ='Gracias! Tu transferencia de saldos se realizó correctamente. Tu valor de transferencia : '.$request->amount.$general->symbol.' . Cargos de transferencia : '.$charge.$general->symbol.'
        Tu nuevo saldo es: '.$user_from->balance.$general->symbol.'';

        send_email($user_from->email, 'Transferencia de Fondos completa' ,$user_from->first_name, $message);

        $message = $user_from->first_name.' '.$user_from->last_name.' transfirió '.$request->amount.$general->symbol.' a tu cuenta.</p>';

        send_email($user_to['email'], 'Has recibido fondos en tu cuenta' ,$user_to['first_name'], $message);

        return redirect()->back()->with('message', 'Transferencia de fondos realizada correctamente');
                
    }

    public function getChargeAjax(Request $request)
    {
        $comission = ChargeCommision::first();
        $general = General::first();
        $charge = ($request->inputAmount * $comission->transfer_charge)/100;
        $total = $charge+$request->inputAmount;

        $amount = floatval($request->inputAmount);
        if ($amount == '' || $amount <= 0)
        {
            return "<span style='color: red'>Valor a transferir no válido</span>";
        }else{
            return "<span style='color: red'>Con $comission->transfer_charge % de cargo, El total de la transacción es $total $general->symbol</span>";
        }

    }

    public function pinChange(Request $request)
    {
        $this->validate($request, [
            'passwordold' =>'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $id = Auth::user()->id;

           if ($request->password == $request->password_confirmation)
           {
               $c_pin = User::find($id);
               if($request->passwordold == $c_pin->trans_pin)
               {
                   User::whereId($id)
                       ->update([
                           'trans_pin' => $request->password
                       ]);
                   return redirect()->back()->with('message','PIN Changes Successfully.');
               }else
                   {
                   session()->flash('alert', 'PIN Not Match');
                   return redirect()->back();
               }
           }else{
               return redirect()->back()->with('alert','Las contraseñas no coincien');
           }

    }

    public function resetPin(Request $request)
    {
        $this->validate($request,[
            'pranto' =>'required'
        ]);

        $pin = substr(time(), 4);
       
        if ($request->pranto == "RESETPIN") 
        {
            $user = User::findOrFail(Auth::user()->id);
            $user->trans_pin = $pin;
            $user->save();

             $message = 'And your new PIN is '.$pin .'';
             $message .='<p style="color:red;">Remember, never share this PIN with anyone.</p>';
               
            send_email($user['email'], 'Reset Transaction PIN' ,$user['first_name'], $message);

            return redirect()->back()->with('message', 'RESETPIN request success, please check your mail.');
        }

        return redirect()->back()->with('alert', 'Opps, type "RESETPIN".And Try again please.');

    }

    public function updateProfile(Request $request)
    {

        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            //'month' => 'required',
            //'day' => 'required',
            //'year' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            //'post_code' => 'required',
            'country' => 'required',
            'image' => 'mimes:png,jpg,jpeg,svg,gif'
        ]);

        User::whereId(Auth::user()->id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile' => $request->mobile,
                'street_address' => $request->street_address,
                'city' => $request->city,
                //'post_code' => $request->post_code,
                'country' => $request->country,
                'email' => $request->email,
                //'birth_day' => $request->year.'-'.$request->month.'-'.$request->day,
            ]);

        $user = User::find(Auth::user()->id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . 'jpg';
            $location = 'assets/images/user_profile_pic/'. $filename;
            Image::make($image)->resize(224,224)->save($location);
            $user->image =  $filename;
            $user->save();
        }
        return redirect('home')->with('message', 'Actualización Éxitosa ');
    }

    public function securityIndex()
    {
        return view('fonts.security');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'passwordold' =>'required',
            'password' => 'required|min:6|confirmed'],
            [ 
                'passwordold.required' => 'La contrasela actual es requerida',
                'password.required' => 'La nueva contraseña es requerida',
                'password.min' => 'La nueva contraseña debe ser mayor a 6 carácteres',
                'password.confirmed' => 'La confirmación de contraseña no coincide',
            ]
        );

        try {
            $c_password = User::find($request->id)->password;
            $c_id = User::find($request->id)->id;
            $user = User::findOrFail($c_id);

            if(Hash::check($request->passwordold, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();

                return redirect()->back()->with('message','Cambio de contraseña realizado con éxito.');
            }else{
                session()->flash('alert', 'Las contraseñas no coinciden');
                Session::flash('type', 'warning');
                return redirect()->back();
            }
        }catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'warning');
            return redirect()->back();
        }

    }

    public function twoFactorIndex()
    {
        $gnl = General::first();
        $ga = new GoogleAuthenticator();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl(Auth::user()->username.'@'.$gnl->web_title, $secret);
        $prevcode = Auth::user()->secretcode;
        $prevqr = $ga->getQRCodeGoogleUrl(Auth::user()->username.'@'.$gnl->web_title, $prevcode);

        return view('fonts.goauth.create', compact('secret','qrCodeUrl','prevcode','prevqr'));
    }

    public function disable2fa(Request $request)
    {
        $this->validate($request,[
                'code' => 'required',
            ]);

        $user = User::find(Auth::id());
        $ga = new GoogleAuthenticator();

        $secret = $user->secretcode;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;

        if ($oneCode == $userCode)
        {
            $user = User::find(Auth::id());
            $user['tauth'] = 0;
            $user['tfver'] = 1;
            $user['secretcode'] = '0';
            $user->save();

           $message =  'Google Two Factor Authentication Disabled Successfully';
           send_email($user['email'], 'Google 2FA' ,$user['first_name'], $message);



           $sms =  'Google Two Factor Authentication Disabled Successfully';
           send_sms($user->mobile, $sms);

            return back()->with('message', 'Google Authenticator Desactivado correctamente');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }

    }

    public function create2fa(Request $request)
    {
        $user = User::find(Auth::id());
        $this->validate($request,[
                'key' => 'required',
                'code' => 'required',
            ]);

        $ga = new GoogleAuthenticator();

        $secret = $request->key;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;
        if ($oneCode == $userCode)
        {
            $user['secretcode'] = $request->key;
            $user['tauth'] = 1;
            $user['tfver'] = 1;
            $user->save();

         $message ='Google Two Factor Authentication Enabled Successfully';
        send_email($user['email'], 'Google 2FA' ,$user['first_name'], $message);


           $sms =  'Google Two Factor Authentication Enabled Successfully';
           send_sms($user->mobile, $sms);

            return back()->with('message', 'Google Authenticator habilitado correctamente');
        }
        else
        {
            return back()->with('alert', 'Código de verificación incorrecto');
        }

    }

}
