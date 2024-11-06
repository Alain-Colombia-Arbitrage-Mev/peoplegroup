<?php

namespace App;

use App\Transaction;
use App\MembershipActive;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referrer_id', 'username', 'password',
        'position', 'first_name', 'last_name',
        'balance', 'join_date', 'status',
        'paid_status','ver_status',
        'ver_code', 'forget_code', 'birth_day',
        'email', 'mobile', 'street_address',
        'city', 'country', 'posid','secretcode',
        'wallet', 
        //'city', 'country', 'post_code','posid','secretcode',
        'tauth', 'tfver', 'emailv','smsv','vsent','vercode','image','level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function withdraw()
    {
        return $this->belongsTo(WithdrawTrasection::class)->withDefault();
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class)->withDefault();
    }

    public function trans()
    {
        return $this->belongsTo(Transaction::class)->withDefault();
    }

    public function membership()
    {
        return $this->hasOne(Membership::class, 'id','membership_id')->withDefault();
    }

    //Fin Relaciones con modelos


    //Saldo del usuario

    public function updateBalance ($amount = 0){ //El monto puede ser positivo o negativo
        // IMPORTANTE: Antes de actualizar el saldo del usuario la transacción ya debe estar generada
        //Obtengo el saldo calculado
        $calculated_balance = $this->getBalance();

        //El saldo siempre es calculado de acuerdo al resultado de todas las transacciones del usuario
        //si este saldo no coincide:
        //se genera alerta administrativa por violación a la integridad de datos
        //y luego se procede a actualizar el saldo del usuario con base el calculo de las transacciones
        if ($this->balance + $amount != $calculated_balance) {
            //Genero Log de Alerta a administradores ** TO DO **
            //return false;
        }
        $this->balance = $this->getBalance();
        if ($this->save()) {
            return true;
        }
        else{
            //Genero Log de Alerta a administradores ** TO DO **
            return false;
        }
    }

    public function getBalance(){
        $transactions = Transaction::where('user_id', $this->id)->sum('amount');
        $charges = Transaction::where('user_id', $this->id)->where('amount', '<', 0)->sum('charge');
        $total = $transactions + $charges;
        return $total;
    }

    public function getMembershipStatus(){

        if (MembershipActive::where('user_id', $this->id)->whereDate('finish_date', '>=', Carbon::now()->toDateString())->orderBy('id', 'DESC')->first()) {
            return true;
        }
        return false;
    }

    public function getMembershipDays(){

        return MembershipActive::selectRaw("DATEDIFF(NOW(), finish_date) as days")->where('user_id', $this->id)->orderBy('id', 'DESC')->pluck('days')->first();
    }
}
