<?php 

namespace App\Http\Controllers\Bonus;


use App\Income;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


use App\Membership;
use App\Product;
use App\Transaction;
use App\User;
use App\General;
use App\MembershipHistory;
use App\MembershipActive;
use App\CryptoTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\BonusSolidarioPolicy;
use App\BonusSolidary;
use App\Http\Controllers\Bonus\BonusRedeem;

class BonusController extends Controller 
{
    public function __construct () {
        $url = route('solidario.commision.index'); // http://oxigeno.local/solidario/commission
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

    public function redeem () {
        $user = User::findOrFail(Auth::user()->id);
        $sponsor = User::findOrFail($user->referrer_id);
        $redeemResult = $this->redeemBonusSolidary($user, 100);
        
        if ($redeemResult) {
            BonusRedeem::where('owner', $user->id)
            ->where('status', 0)
            ->update(['status' => 1]);
           
            return back()->with('alert', 'El Bono Solidario fue redimido!');
        }

        return  back()->with('alert', 'Aún no cumples con los requisitos');
    }

    public function getSolidario () {
        // leer bonusredeem  los referidos activos que posee el inversor
        $redeem = new BonusRedeem();
        $user = User::findOrFail(Auth::user()->id);
        $directs = count($redeem->getTotalInvitations($user->id));
        // $membership = Membership::findOrFail($request->id);
        
        $income = Income::where('user_id', Auth::user()->id)
        ->where('type', BONUS_SOLIDARIO)->orderBy('id', 'desc')->get();

        return view('bonus.solidario', compact('income', 'directs'));
    }
}