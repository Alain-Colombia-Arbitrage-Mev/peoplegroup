<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MembershipHistory;
use App\MembershipActive;
use App\User;
use App\ChargeCommision;

class Membership extends Model
{
    protected $table = 'memberships';
    protected $fillable = [
        'tittle',
        'description',
        'max_level',
        'cost_perc',
        'price',
        'quick_bonus_per',
        'bonus_solidary_fee',
        'days_for_upgrade',
        'unilevel_perc',
        'binary_perc',
        'matrix_perc',
        'capitalization_perc',
        'image',
        'active',
    ];


    //Recibo el usuario que realizó la compra y el monto de unilevel neto a liquidar
    public function DisperseUnilevelUtility(User &$user, $amount){

        $commission = ChargeCommision::first();

        $level1 = round($commission->level1_bonus * $amount / 100, 2);
        $level2 = round($commission->level2_bonus * $amount / 100, 2);
        $level3 = round($commission->level3_bonus * $amount / 100, 2);
        $level4 = round($commission->level4_bonus * $amount / 100, 2);
        $level5 = $amount - $level1 -$level2 - $level3 - $level4;

        // cambiar por round($commission->level5_bonues * $amount / 100)
        
        $dispersion = [
            '1' => ['user_id' => 2, 'amount' => $level1, 'pay' => 1],
            '2' => ['user_id' => 2, 'amount' => $level2, 'pay' => 1],
            '3' => ['user_id' => 2, 'amount' => $level3, 'pay' => 1],
            '4' => ['user_id' => 2, 'amount' => $level4, 'pay' => 1],
            '5' => ['user_id' => 2, 'amount' => $level5, 'pay' => 1],
        ];

        $current_level = 1;
        $max_level = 5;

        $current_affiliate = User::find($user->referrer_id);  // busca al sponsor 

        while ($current_level <= $max_level) {

            //Valido que el id del actual afiliado no sea el admin, si lo es detengo la ejecución ya que por defecto todos los bonos se liquidan al admin
            if ($current_affiliate->id <= 2) {
                return $dispersion;
            }
            //Valido que el usuario tenga membresia comprada asociada
            if ($current_affiliate->membership->id == 0) {
                //Aplico compresión dinámica, me paso al siguiente usuario ya que este usuario está inactivo
                $current_affiliate = User::find($current_affiliate->referrer_id);
                continue;
            }
            //valido de acuerdo a su membresia su nivel máximo a recibir bonos
            if ($current_level <= $current_affiliate->membership->max_level) {
                //Valido si tiene membresia activa
                if ($current_affiliate->getMembershipStatus()) {
                    
                    $dispersion[$current_level]['user_id'] = $current_affiliate->id;
                    $current_level ++;
                    //Me paso al patrocinador del actual afiliado
                    $current_affiliate = User::find($current_affiliate->referrer_id);
                }
                //Si la membresia no esta activa valido los dias de gracia para realizar el consumo mensual
                else{
                    //Si se encuentra dentro de los días de gracia continuo
                    if ($current_affiliate->getMembershipDays() <= $current_affiliate->membership->days_for_consu) {
                        //Liquido el bono
                        $dispersion[$current_level]['user_id'] = $current_affiliate->id;
                        //Retengo el pago
                        $dispersion[$current_level]['pay'] = 0;
                        $current_level ++;
                        //Me paso al patrocinador del actual afiliado
                        $current_affiliate = User::find($current_affiliate->referrer_id);
                    }
                    else{
                        //Aplico compresión dinámica, me paso al siguiente usuario ya que este usuario está inactivo
                        $current_affiliate = User::find($current_affiliate->referrer_id);
                    }
                }
            }
            else{
                //La membresía queda como ingreso para el admin
                $current_level ++;
                //Me paso al patrocinador del actual afiliado
                $current_affiliate = User::find($current_affiliate->referrer_id);
            }
        }

        return $dispersion;
    }

}
