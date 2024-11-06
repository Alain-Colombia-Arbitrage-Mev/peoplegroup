<?php

namespace App\Http\Controllers;

use App\Admin;
use App\ChargeCommision;
use App\Deposit;
use App\Income;
use App\LendingLog;
use App\Package;
use App\Transaction;
use App\User;
use App\General;
use App\Withdraw;
use App\WithdrawTrasection;
use App\CryptoTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function saveResetPassword(Request $request){

        $this->validate($request,[
            'passwordold' =>'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {
            $c_password = Admin::find($request->id)->password;
            $c_id = Admin::find($request->id)->id;
            $user = Admin::findOrFail($c_id);
            if(Hash::check($request->passwordold, $c_password)){
                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                return redirect()->back()->withMsg('Password Changes Successfully.');
            }else{
                session()->flash('message', 'Password Not Matched');
                Session::flash('type', 'warning');
                return redirect('admin/home');
            }
        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'warning');
            return redirect('admin/home');
        }

    }

    public function usersIndex()
    {   
        
        $user = User::orderBy('first_name', 'ASC')->paginate(50);
        $tittle_list = '';
        return view('admin.user_mmanagement.index', compact('user', 'tittle_list'));
    }

    public function userLeaderIndex()
    {
        $user = User::where('referrer_id', 2)->orderBy('first_name', 'ASC')->paginate(50);
        $tittle_list = 'Líderes';
        return view('admin.user_mmanagement.index', compact('user', 'tittle_list'));
    }

    public function deactiveUser()
    {
        $user = User::orderBy('id', 'desc')->where('status', 0)->paginate(50);
        $tittle_list = 'Bloqueados';
        return view('admin.user_mmanagement.index', compact('user', 'tittle_list'));
    }

    public function paidUser()
    {
        $user = User::orderBy('id', 'desc')->where('paid_status', 1)->where('membership_id', '>' ,0)->paginate(50);
        $tittle_list = 'Con Membresía';
        return view('admin.user_mmanagement.index', compact('user', 'tittle_list'));
    }

    public function freeUser()
    {
        $user = User::orderBy('id', 'desc')->where('paid_status', 0)->paginate(50);
        $tittle_list = 'Sin Pago';
        return view('admin.user_mmanagement.index', compact('user', 'tittle_list'));
    }

    public function indexWithdraw()
    {
        $withdraw = Withdraw::all();
        return view('admin.withdraw.add_withdraw_method', compact('withdraw'));
    }

    public function storeWithdraw(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,svg',
            'min_amo' => 'required|numeric|min:1',
            'max_amo' => 'required|numeric|min:1',
            'chargefx' => 'required',
            'chargepc' => 'required',
            'rate' => 'required',
            'processing_day' => 'required',
        ]);

        $withdraw = Withdraw::create($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . 'jpg';
            $location = 'assets/images/withdraw/'. $filename;
            Image::make($image)->save($location);
            $withdraw->image =  $filename;
            $withdraw->save();
        }

        return redirect()->back()->withMsg('Created Payment Method Successfully');
    }

    public function updateWithdraw(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:jpg,jpeg,png,svg',
            'min_amo' => 'required|numeric|min:1',
            'max_amo' => 'required|numeric|min:1',
            'chargefx' => 'required',
            'chargepc' => 'required',
            'rate' => 'required',
            'currency' => 'required',
            'processing_day' => 'required',
            'status' => 'required',
        ]);

        $withdraw = Withdraw::whereId($id)
        ->update([
            'name' => $request->name,
            'min_amo' => $request->min_amo,
            'max_amo' => $request->max_amo,
            'chargefx' => $request->chargefx,
            'chargepc' => $request->chargepc,
            'rate' => $request->rate,
            'currency' => $request->currency,
            'processing_day' => $request->processing_day,
            'status' => $request->status,
        ]);

        $general = Withdraw::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . 'jpg';
            $location = 'assets/images/withdraw/'. $filename;
            Image::make($image)->save($location);
            $general->image =  $filename;
            $general->save();
        }

        return redirect()->back()->withMsg('Updated Payment Method Successfully');
    }

    public function requestWithdraw()
    {
        $withdraw = WithdrawTrasection::orderBy('id', 'desc')->
        where('status', 0)->paginate(30);
        return view('admin.withdraw.withdraw_request', compact('withdraw'));
    }

    public function detailWithdraw($id)
    {
        $data = WithdrawTrasection::findOrFail($id);
        return view('admin.withdraw.withdraw_detal', compact('data'));
    }

    public function repondWithdraw(Request $request, $id)
    {
         $this->validate($request,[
            'message' => 'required',
        ]);
         WithdrawTrasection::whereId($id)
        ->update([
            'status' => $request->status,
        ]);
        if ($request->status == 1 )
        {
            $withdraw = WithdrawTrasection::find($id);
            $user_id = $withdraw->user_id;
            $user = User::find($user_id);
            $general = General::first();


            $message = $request->message;

            $user = User::find($user_id);
            User::whereId($user_id)
                ->update([
                    'balance' => $user->balance + $withdraw->amount + $withdraw->charge
                ]);
                
            send_email($user['email'], 'Withdraw Request Accept', $user->first_name , $message);
            return redirect('admin/withdraw/requests')->withMsg('Paid Complete');
        } else {
            $withdraw = WithdrawTrasection::find($id);
            $user_id = $withdraw->user_id;
            $user = User::find($user_id);
            User::whereId($user_id)
                ->update([
                    'balance' => $user->balance + $withdraw->amount + $withdraw->charge
                ]);

            $message = $request->message;
            send_email($user['email'], 'Withdraw Request Refund' ,$user->first_name, $message);

            return redirect('admin/withdraw/requests')->withMsg('Refund Complete');
        }
    }

    public function showWithdrawLog()
    {
        $withdraw = WithdrawTrasection::orderBy('id', 'desc')->get();
        return view('admin.withdraw.view_log', compact('withdraw'));
    }

    //Depositos manuales

    public function requestDeposit()
    {
        $deposit = Deposit::orderBy('id', 'desc')->
        where('status', 0)->paginate(30);
        return view('admin.deposit.deposit_request', compact('deposit'));
    }

    public function detailDeposit($id)
    {
        $data = Deposit::findOrFail($id);
        return view('admin.deposit.deposit_detail', compact('data'));
    }

    public function repondDeposit(Request $request, $id)
    {
         $this->validate($request,[
            'message' => 'required',
        ]);

        $id = (int)$id;
        if ($id <= 0) {
            return redirect('admin/deposit/requests')->withMsg('Error en los datos');
        }

        if ($request->status == 1 )
        {   
    
            //Genero el registro origen
            $model = 'Deposit';
            $model_obj = Deposit::find($id);
            $model_obj->detail = $request->message;
            $model_obj->save();

            //Variables generales
            $general = General::first();
            $trans_id = 'DP'.rand();
            $trans_description = 'DEPOSITO'. ' #'. $trans_id;
            $amount = $model_obj->amount;
            $charge = $model_obj->trx_charge;
            $total = $amount + $charge;

            //Inicializo usuarios
            $user_wallet = User::findOrFail(1);
            $user_to = User::findOrFail($model_obj->user_id);
            $user_admin = User::findOrFail(2);

            //Genero la transacción de entrada de dinero hacia la wallet de reserva
            $Twallet = new Transaction();
            $Twallet->user_id = $user_wallet->id;
            $Twallet->trans_id = rand();
            $Twallet->time = Carbon::now();
            $Twallet->description = 'Ingreso de fondos ' .$trans_description;
            $Twallet->amount = $total;
            $Twallet->type = 15;
            $Twallet->charge = 0;
            $Twallet->model_ref = $model;
            $Twallet->model_id = $model_obj->id;
            $Twallet->saveAndUpdateBalance($user_wallet);

            //Genero la transacción wallet de salida de dinero transferido hacia el usuario destino
            $Twallet = new Transaction();
            $Twallet->user_id = $user_wallet->id;
            $Twallet->trans_id = rand();
            $Twallet->time = Carbon::now();
            $Twallet->description = 'Desembolso ' . $trans_description;
            $Twallet->amount = $amount * -1;
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
            $Tto->description = $trans_description;
            $Tto->amount = $amount;
            $Tto->type = 1;
            $Tto->charge = $charge;
            $Tto->model_ref = $model;
            $Tto->model_id = $model_obj->id;
            $Tto->saveAndUpdateBalance($user_to);

            //Genero la transaccion Crypto
            CryptoTransaction::create([
                'user_from' => $user_wallet->id,
                'user_to' => $user_to->id,
                'wallet_from' => $user_wallet->wallet,
                'wallet_to' => $user_to->wallet,
                'amount' => $amount,
                'description' => 'Desembolso ' . $trans_description,
                'status' => 0,
                'transaction_id_from' => $Twallet->id,
                'transaction_id_to' => $Tto->id,
            ]);

            //Genero la transacción wallet de salida de dinero de cargo por transferencia
            $Twallet = new Transaction();
            $Twallet->user_id = $user_wallet->id;
            $Twallet->trans_id = rand();
            $Twallet->time = Carbon::now();
            $Twallet->description = 'Desembolso Cargo ' . $trans_description;
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
            $Tadmin->description = 'Ingreso por Cargo ' . $trans_description;
            $Tadmin->amount = $charge;
            $Tadmin->type = 10;
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
                'description' => 'Desembolso Cargo ' . $trans_description,
                'status' => 0,
                'transaction_id_from' => $Twallet->id,
                'transaction_id_to' => $Tadmin->id,
            ]);

            $model_obj->status = 1;
            $model_obj->save();

            $message = '<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Tu depósito en . ' . $model_obj->method_name->name . ' por valor de '. $model_obj->amount .' fue aprobado, este valor ya se encuentra reflejado en el saldo de tu cuenta</p>';
            send_email($user_to['email'], 'Depósito verificado y aprobado', $user_to->first_name , $message);

            return redirect('admin/deposit/requests')->withMsg('Aprobación completada');

        }else{

            $deposit = Deposit::find($id);
            $deposit->detail = $request->message;
            $deposit->save();
            $user_id = $deposit->user_id;
            $user = User::find($user_id);
            

            $message = '<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Tu depósito en . ' . $deposit->method_name->name . ' por valor de '. $deposit->amount .' fue rechazado.</p>';
            $message .= '<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"> Detalle: . ' . $request->message . '</p>';

            send_email($user['email'], 'Depósito rechazado' ,$user->first_name, $message);

            return redirect('admin/deposit/requests')->withMsg('Depósito rechazado');
        }

    }

    public function indexEmail()
    {
        $temp = General::first();
        if(is_null($temp))
        {
            $default = [
                'esender' => 'email@example.com',
                'emessage' => 'Email Message',
                'smsapi' => 'SMS Message',

            ];
            General::create($default);
            $temp = General::first();
        }
        return view('admin.website.email', compact('temp'));
    }

    public function updateEmail(Request $request)
    {
        $temp = General::first();
        $this->validate($request,[
                'esender' => 'required',
                'emessage' => 'required'
            ]);

        $temp['esender'] = $request->esender;
        $temp['emessage'] = $request->emessage;

        $temp->save();

        return back()->withMsg('Configuración de Email actualizada correctamente!');
    }

    public function smsApi()
    {
        $temp = General::first();
        if(is_null($temp))
        {
            $default = [
                'esender' => 'email@example.com',
                'emessage' => 'Email Message',
                'smsapi' => 'SMS Message',

            ];
            General::create($default);
            $temp = General::first();
        }
        return view('admin.website.sms', compact('temp'));
    }

    public function smsUpdate(Request $request)
    {
        $temp = General::first();

        $this->validate($request,[
                'smsapi' => 'required',
            ]);
        $temp['smsapi'] = $request->smsapi;

        $temp->save();

        return back()->withMsg('SMS Api Updated Successfully!');
    }

    public function indexUserDetail($id)
    {
        $user = User::find($id);
        return view('admin.user_mmanagement.view',compact('user'));
    }

    public function userUpdate(Request $request ,$id)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        if ($request->status == 'on'){
            $status = 1;
        }else{
            $status = 0;
        }

        if ($request->emailv == 'on'){
            $emailv = 0;
        }else{
            $emailv = 1;
        }

        if ($request->smsv == 'on'){
            $smsv = 0;
        }else{
            $smsv = 1;
        }

        User::whereId($id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'country' => $request->country,
            'status' => $status,
            'emailv' => $emailv,
            'smsv' => $smsv,
        ]);
        return redirect()->back()->withMsg('Actualización Éxitosa');
    }

    public function indexUserBalance($id)
    {
        $user = User::find($id);
        return view('admin.user_mmanagement.balance',compact('user'));
    }

    public function indexBalanceUpdate(Request $request ,$id)
    {
        /* $this->validate($request,[
            'amount' => 'required|numeric|min:1',
            'message' => 'required',
        ]);

            if ($request->operation == 'on'){

                $user = User::find($id);
                $new_balance = $user['balance'] =  $user['balance'] + $request->amount;
                $user->save();
                $message = $request->message;

                Transaction::create([
                    'user_id' => $id,
                    'trans_id' => rand(),
                    'time' => Carbon::now(),
                    'description' => 'ADMIN'. '#ID'.'-'.'ADD'.rand(),
                    'amount' => $request->amount,
                    'new_balance' => $new_balance,
                    'type' => 5,
                ]);

                send_email($user['email'], 'Admin Balance Add' ,$user['first_name'], $message);


                $sms = $request->message;
                send_sms($user['mobile'], $sms);
                return redirect()->back()->withMsg('Balance Add Successful');
            }else{
                $user = User::find($id);
                if ($user->balance > $request->amount){
                    $new_balance = $user['balance'] =  $user['balance'] - $request->amount;
                    $user->save();
                    $message = $request->message;

                    Transaction::create([
                        'user_id' => $id,
                        'trans_id' => rand(),
                        'time' => Carbon::now(),
                        'description' => 'ADMIN'. '#ID'.'-'.'SUBTRACT'.rand(),
                        'amount' => '-'.$request->amount,
                        'new_balance' => $new_balance,
                        'type' => 6,
                    ]);

                    send_email($user['email'], 'Admin Balance Subtract' ,$user['first_name'], $message);
                    $sms = $request->message;
                    send_sms($user['mobile'], $sms);
                    return redirect()->back()->withMsg('Balance Subtract Successful');
                    }
                return redirect()->back()->withdelmsg('Fondos insuficientes del usuario');
            } */

    }

    public function userSendMail($id)
    {
        $user = User::find($id);
        return view('admin.user_mmanagement.user_mail',compact('user'));
    }

    public function userSendMailUser(Request $request, $id)
    {
        $user = User::find($id);
        $subject =$request->subject;
        $message = $request->message;
        send_email($user['email'], $subject ,$user['first_name'], $message);
        return redirect()->back()->withMsg('Mail Send');

    }

    public function matchIndex()
    {
        $match = Income::where('type', 'B')->get();
        return view('admin.matching.index', compact('match'));
    }

    public function userSearch(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if ($user == ''){
            $user_notfound = 0;
            return redirect()->back()->with( 'not_found', 'Oops, Usuario no encontrado!');
        }else{
            return view('admin.user_mmanagement.view', compact('user'));
        }
    }

    public function userSearchEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user == ''){
            $user_notfound = 0;
            return redirect()->back()->with( 'not_found', 'Oops, Usuario no encontrado!');
        }else{
            return view('admin.user_mmanagement.view', compact('user'));
        }
    }

   

    public function depositLog()
    {
        $add_fund = Deposit::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.deposit_log', compact('add_fund'));
    }

     public function transBalanceLog()
    {
        $trans = Transaction::orderBy('id', 'desc')->get();
        return view('admin.transfer_balance_log', compact('trans'));
    }

    public function transView($id)
    {
        $trans_object = Transaction::where('user_id', $id)->first();
        $trans = Transaction::where('user_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.user_mmanagement.trans_view', compact('trans', 'trans_object'));
    }

    public function depositView($id)
    {
        $trans_object = Deposit::where('user_id', $id)->first();
        $trans = Deposit::where('user_id', $id)->where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.user_mmanagement.deposit_view', compact('trans', 'trans_object'));
    }

    public function withDrawView($id)
    {
        $trans_object = WithdrawTrasection::where('user_id', $id)->first();
        $trans = WithdrawTrasection::where('user_id', $id)->where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.user_mmanagement.withdraw_view', compact('trans', 'trans_object'));
    }

    public function sendMoneyView($id)
    {
        $trans_object = Transaction::where('user_id', $id)->first();
        $trans = Transaction::where('user_id', $id)->where('type', 3)->orderBy('id', 'desc')->get();
        return view('admin.user_mmanagement.send_money_view', compact('trans', 'trans_object'));
    }

    public function generateAdmin()
    {
        $trans = Transaction::where('type', 5)->orderBy('id', 'desc')->get();
        return view('admin.admin_generate', compact('trans'));
    }

    public function subtractAdmin()
    {
        $trans = Transaction::where('type', 6)->orderBy('id', 'desc')->get();
        return view('admin.admin_subtract', compact('trans'));
    }

    public function refView()
    {
        $trans = Income::where('type', 'R')->orderBy('id', 'desc')->get();
        return view('admin.ref_amount', compact('trans'));
    }



//    public function lendHistoryIndex()
//    {
//        $lend = LendingLog::orderBy('id', 'desc')->get();
//        return view('admin.lend_history', compact('lend'));
//    }
//
//    public function lendCompleteIndex()
//    {
//        $lend = LendingLog::orderBy('id', 'desc')->where('status', 0)->get();
//        return view('admin.lend_complete_history', compact('lend'));
//    }
//
//    public function lendBonusIndex()
//    {
//        $lend = LendingLog::orderBy('id', 'desc')->get();
//        return view('admin.lend_ref_bonus', compact('lend'));
//    }

}
