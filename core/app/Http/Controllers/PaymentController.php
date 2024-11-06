<?php


/**
 * 
 * search key (@confirm:Efectivo, @confirm:Btc, @confirm:Eth)
 */
namespace App\Http\Controllers;

use App\Deposit;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Gateway;
use App\Lib\coinPayments;
use CoinGate\CoinGate;
use App\Lib\BlockIo;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;
use App\General;
use Illuminate\Support\Facades\View;

class PaymentController extends Controller
{

    private function sendTransactionCoinpayments () {

    }

    public function buyConfirm()
    {
        $track = Session::get('Track');
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();

        if($data->status!=0 && $data->gateway_id !=9)
            return redirect()->route('home')->with('alert', 'An Error Occured!');
        
        $gatewayData = Gateway::where('id', $data->gateway_id)->first();

        // @confirm:BTC
        if ($data->gateway_id==3) {

            $all = file_get_contents("https://blockchain.info/ticker");
            $res = json_decode($all);
            $btcrate = $res->USD->last;

            $amount = intval($data->bcam);
            $usd = $amount;
            $btcamount = $usd/$btcrate;
            $btc = round($btcamount, 8);

            $DepositData = Deposit::where('trx',$track)->orderBy('id', 'DESC')->first();

            if($DepositData->bcam == 0) {
                $blockchain_root = "https://blockchain.info/";
                $blockchain_receive_root = "https://api.blockchain.info/";
                $mysite_root = url('/');
                $secret = "ABIR";
                $my_xpub = $gatewayData->val2;
                $my_api_key = $gatewayData->val1;

                $invoice_id = $track;
                $callback_url = $mysite_root . "/ipnbtc?invoice_id=" . $invoice_id . "&secret=" . $secret;


                $resp = @file_get_contents($blockchain_receive_root . "v2/receive?key=" . $my_api_key . "&callback=" . urlencode($callback_url) . "&xpub=" . $my_xpub);

                if (!$resp) {
                    //BITCOIN API HAVING ISSUE. PLEASE TRY LATER
                    return redirect()->route('home')->with('alert', 'BLOCKCHAIN API HAVING ISSUE. PLEASE TRY LATER');
                    exit;
                }

                $response = json_decode($resp);
                $sendto = $response->address;


                $data['bcid'] = $sendto; // wallet receiver
                $data['bcam'] = $btc; // amount
                $data->save();

            }

            $DepositData = Deposit::where('trx',$track)->orderBy('id', 'DESC')->first();
            /////UPDATE THE SEND TO ID

            $bitcoin['amount'] = $DepositData->bcam;
            $bitcoin['sendto'] = $DepositData->bcid;

            $var = "bitcoin:$DepositData->bcid?amount=$DepositData->bcam";
            $bitcoin['code'] =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;' />";

            return view('fonts.payment.bitcoin', compact('bitcoin'));
        }
        
        // @confirm:Efectivo
        elseif ($data->gateway_id==9)
        {   
            $data->status = 0;
            $data->save();

            $amount = $data->amount;
            $efectivo['amount'] = $amount;
            $efectivo['value1'] = $gatewayData->val1;
            $efectivo['track'] = $track;

            return view('fonts.payment.efectivo', compact('efectivo'));
        }
        // @confirm:Eth
        else if ($data->gateway_id == 10) {
            $all = file_get_contents("https://api.etherscan.io/api?module=stats&action=ethprice&apikey=YourApiKeyToken");
            $res = json_decode($all);
            $ethrate = $res->result->ethusd;

            $amount =  intval($data->bcam);
            
            $btcamount = $amount/$ethrate;

            $DepositData = Deposit::where('trx',$track)->orderBy('id', 'DESC')->first();

            $ether['amount'] = $DepositData->bcam;
            $ether['sendto'] = $gatewayData->val1; 
            // '0x72a95a1833fb31208530bb3fbc032590520864d1'; //$DepositData->bcid;

            $var = "ethereum:" . $ether['sendto'] . "?amount=$DepositData->bcam";
            $ether['code'] =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='qr payment ethereum' style='width:300px;' />";
            return view('fonts.payment.ether', compact('ether'));
        }
    }


    public function ipnbtc(){

        $gatewayData = Gateway::find(3);

        $track = $_GET['invoice_id'];
        $secret = $_GET['secret'];
        $address = $_GET['address'];
        $value = $_GET['value'];
        $confirmations = $_GET['confirmations'];
        $value_in_btc = $_GET['value'] / 100000000;

        $trx_hash = $_GET['transaction_hash'];

        $DepositData = Deposit::where('trx',$track)->orderBy('id', 'DESC')->first();


        if ($DepositData->status == 0) {

            if ($DepositData->bcam==$value_in_btc && $DepositData->bcid==$address && $secret=="ABIR" && $confirmations>2){

                $DepositData['status'] = 1;

                $user = User::find($DepositData['user_id']);
                $new_balance = $user['balance'] =  $user['balance'] + $DepositData['amount'];

                Transaction::create([
                    'user_id' => $DepositData['user_id'],
                    'trans_id' => rand(),
                    'time' => Carbon::now(),
                    'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
                    'amount' => $DepositData['amount'],
                    'new_balance' => $new_balance,
                    'type' => 1,
                ]);

                $user->save();

                $DepositData->save();

                     $general = General::first();

         $message ='Welcome! Your payment was processed successfully.</br>   
         Successfully Add : '.$DepositData['amount'].$general->symbol.'</br>
          And your current balance is '.$new_balance.$general->symbol.' .';
        send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);

                $sms = $message;
                send_sms($user['mobile'], $sms);

                return redirect()->route('home')->withMsg( 'Deposit Successfull!');

            }

        }

    }

    // public function ipnstripe(Request $request)
    // {
    //     $track =   Session::get('Track');
    //     $data = Deposit::where('trx',$track)->orderBy('id', 'DESC')->first();

    //     $this->validate($request,
    //         [
    //             'cardNumber' => 'required',
    //             'cardExpiry' => 'required',
    //             'cardCVC' => 'required',
    //         ]);

    //     $cc = $request->cardNumber;
    //     $exp = $request->cardExpiry;
    //     $cvc = $request->cardCVC;

    //     $exp = $pieces = explode("/", $_POST['cardExpiry']);
    //     $emo = trim($exp[0]);
    //     $eyr = trim($exp[1]);
    //     $cnts = $data->usd_amount*100;


    //     $gatewayData = Gateway::find(4);

    //     Stripe::setApiKey($gatewayData->val1);

    //     try{
    //         $token = Token::create(array(
    //             "card" => array(
    //                 "number" => "$cc",
    //                 "exp_month" => $emo,
    //                 "exp_year" => $eyr,
    //                 "cvc" => "$cvc"
    //             )
    //         ));

    //         try{
    //             $charge = Charge::create(array(
    //                 'card' => $token['id'],
    //                 'currency' => 'USD',
    //                 'amount' => $cnts,
    //                 'description' => 'item',
    //             ));


    //             if ($charge['status'] == 'succeeded') {

    //                 $user = User::find($data['user_id']);
    //                 $new_balance = $user['balance'] =  $user['balance'] + $data['amount'];

    //                 Transaction::create([
    //                     'user_id' => $data['user_id'],
    //                     'trans_id' => rand(),
    //                     'time' => Carbon::now(),
    //                     'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
    //                     'amount' => $data['amount'],
    //                     'new_balance' => $new_balance,
    //                     'type' => 1,
    //                 ]);

    //                 $user->save();

    //                 $data['status'] = 1;
    //                 $data->save();

    //                $general = General::first();

    //      $message ='Welcome! Your payment was processed successfully.</br>   
    //      Successfully Add : '.$data['amount'].$general->symbol.'</br>
    //       And your current balance is '.$new_balance.$general->symbol.' .';
    //     send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);

    //                 $sms = $message;
    //                 send_sms($user['mobile'], $sms);
                


    //             return redirect()->route('home')->with('success', 'Added Successfully!');

    //             }

    //         }
    //         catch (Exception $e){
    //             return redirect()->route('home')->with('alert', $e->getMessage());
    //         }

    //     }catch (Exception $e){
    //         return redirect()->route('home')->with('alert', $e->getMessage());
    //     }

    // }

    // public function ipncoin(Request $request)
    // {
    //     $track = $request->custom;
    //     $status = $request->status;
    //     $amount1 = floatval($request->amount1);
    //     $currency1 = $request->currency1;

    //     $DepositData = Deposit::where('trx', $track)->first();
    //     $bcoin = $DepositData->bcam;;

    //     if ($currency1 == "BTC" && $amount1 >= $bcoin && $DepositData->status == '0')
    //     {
    //         if ($status>=100 || $status==2)
    //         {
    //             $user = User::find($DepositData['user_id']);
    //             $new_balance = $user['balance'] =  $user['balance'] + $DepositData['amount'];

    //             Transaction::create([
    //                 'user_id' => $DepositData['user_id'],
    //                 'trans_id' => rand(),
    //                 'time' => Carbon::now(),
    //                 'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
    //                 'amount' => $DepositData['amount'],
    //                 'new_balance' => $new_balance,
    //                 'type' => 1,
    //             ]);

    //             $user->save();

    //             $DepositData['status'] = 1;
    //             $DepositData->save();

    //             $general = General::first();

    //             $message ='Welcome! Your payment was processed successfully.</br>   
    //                 Successfully Add : '.$DepositData['amount'].$general->symbol.'</br>
    //                  And your current balance is '.$new_balance.$general->symbol.' .';
    //             send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);

    //             $sms = $message;
    //             send_sms($user['mobile'], $sms);


    //         }
    //     }

    // }


    // //CoinGate
    // public function coingatePayment()
    // {
    //     $track = Session::get('Track');

    //     if (is_null($track))
    //     {
    //         return redirect()->back();
    //     }

    //     $DepositData = Deposit::where('trx',$track)->first();

    //     $amount = $DepositData->bcam;

    //     $gateway =Gateway::find(6);
    //     //return $DepositData;
    //     \CoinGate\CoinGate::config(array(
    //         'environment' => 'sandbox', // sandbox OR live
    //         'app_id'      =>  $gateway->val1,
    //         'api_key'     =>  $gateway->val2,
    //         'api_secret'  =>  $gateway->val3
    //     ));

    //     $post_params = array(
    //         'order_id'          => $DepositData->trx,
    //         'price'             => $amount,
    //         'currency'          => 'BTC',
    //         'receive_currency'  => 'BTC',
    //         'callback_url'      => route('ipn.coinGate'),
    //         'cancel_url'        => route('home'),
    //         'success_url'       => route('home'),
    //         'title'             => 'AF#'.$DepositData->trx,
    //         'description'       => 'Add Fund'
    //     );

    //     $order = \CoinGate\Merchant\Order::create($post_params);

    //     if ($order)
    //     {
    //         return redirect($order->payment_url);
    //     } else {
    //         echo "Something Wrong with your API";
    //     }
    // }

    // public function coinGateIPN(Request $request)
    // {

    //     $DepositData = Deposit::where('trx',$request->order_id)->first();

    //     $amount = $DepositData->bcam;

    //     if($request->status=='paid'&& $request->price == $amount && $DepositData->status=='0')
    //     {
    //         $user = User::find($DepositData['user_id']);
    //         $new_balance = $user['balance'] =  $user['balance'] + $DepositData['amount'];

    //         Transaction::create([
    //             'user_id' => $DepositData['user_id'],
    //             'trans_id' => rand(),
    //             'time' => Carbon::now(),
    //             'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
    //             'amount' => $DepositData['amount'],
    //             'new_balance' => $new_balance,
    //             'type' => 1,
    //         ]);

    //         $user->save();

    //         $DepositData['status'] = 1;
    //         $DepositData->save();

    //     $general = General::first();

    //      $message ='Welcome! Your payment was processed successfully.</br>   
    //      Successfully Add : '.$DepositData['amount'].$general->symbol.'</br>
    //       And your current balance is '.$new_balance.$general->symbol.' .';
    //     send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);
    //         $sms = $message;
    //         send_sms($user['mobile'], $sms);

    //         return redirect()->route('home')->with('success', 'Payment Complete via CoinGate');
    //     }
    // }


    // public function skrillIPN()
    // {

    //     $skrill = Gateway::find(5);
    //     $concatFields = $_POST['merchant_id']
    //         .$_POST['transaction_id']
    //         .strtoupper(md5($skrill->val2))
    //         .$_POST['mb_amount']
    //         .$_POST['mb_currency']
    //         .$_POST['status'];

    //     $DepositData = Deposit::where('trx',$_POST['transaction_id'])->first();

    //     if (strtoupper(md5($concatFields)) == $_POST['md5sig'] && $_POST['status'] == 2 && $_POST['pay_to_email'] == $skrill->val1 && $DepositData->status='0') {


    //         $user = User::find($DepositData['user_id']);
    //         $new_balance = $user['balance'] =  $user['balance'] + $DepositData['amount'];


    //         Transaction::create([
    //             'user_id' => $DepositData['user_id'],
    //             'trans_id' => rand(),
    //             'time' => Carbon::now(),
    //             'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
    //             'amount' => $DepositData['amount'],
    //             'new_balance' => $new_balance,
    //             'type' => 1,
    //         ]);

    //         $user->save();

    //         $DepositData['status'] = 1;
    //         $DepositData->save();

    //              $general = General::first();


    //              $message ='Welcome! Your payment was processed successfully.</br>   
    //      Successfully Add : '.$DepositData['amount'].$general->symbol.'</br>
    //       And your current balance is '.$new_balance.$general->symbol.' .';
    //     send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);

    //         $sms = $message;
    //         send_sms($user['mobile'], $sms);
    //     }
    // }


    // public function blockIpn(Request $request)
    // {

    //     $DepositData = Deposit::where('status', 0)->where('gateway_id', 8)->where('try','<=',100)->get();


    //     $method = Gateway::find(8);
    //     $apiKey = $method->val1;
    //     $version = 2; // API version
    //     $pin =  $method->val2;
    //     $block_io = new BlockIo($apiKey, $pin, $version);


    //     foreach($DepositData as $data)
    //     {
    //         $balance = $block_io->get_address_balance(array('addresses' => $data->bcid));


    //         $bal = $balance->data->available_balance;

    //         echo $data->bcid."-".$bal.'<br>';


    //         if($bal > 0 && $bal >= $data->bcam)
    //         {
    //             $user = User::find($data['user_id']);
    //             $new_balance = $user['balance'] =  $user['balance'] + $data['amount'];

    //             Transaction::create([
    //                 'user_id' => $DepositData['user_id'],
    //                 'trans_id' => rand(),
    //                 'time' => Carbon::now(),
    //                 'description' => 'ADD FUND'. '#ID'.'-'.'DP'.rand(),
    //                 'amount' => $DepositData['amount'],
    //                 'new_balance' => $new_balance,
    //                 'type' => 1,
    //             ]);

    //             $user->save();

    //             $data['status'] = 1;
    //             $data['try'] = $data->try+ 1;
    //             $data->save();

    //                  $general = General::first();


    //     $message ='Welcome! Your payment was processed successfully.</br>   
    //      Successfully Add : '.$data['amount'].$general->symbol.'</br>
    //       And your current balance is '.$new_balance.$general->symbol.' .';
    //     send_email($user['email'], 'Add Fund Successfull' ,$user['first_name'], $message);

    //             $sms = $message;
    //             send_sms($user['mobile'], $sms);


    //         }
    //         $data['try'] = $data->try + 1;
    //         $data->save();
    //     }
    // }

    public function cron()
    {
        file_get_contents(route('ipn.block'));
    }
}	
