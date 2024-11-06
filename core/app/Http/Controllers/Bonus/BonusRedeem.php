<?php

namespace App\Http\Controllers\Bonus;

// define("BONUS_SOLIDARIO",  1);
define("BONUS_SOLIDARIO",  4);

use App\Transaction;
use App\MembershipActive;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class BonusRedeem extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner', 'type', 'status', 'referred_user' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

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

    // public function saveAndUpdateBalance(User &$user){
    //     if (!$this->save()) {
    //         return false;
    //     }
    //     $total = ($this->amount < 0) ? $this->amount + $this->charge : $this->amount;
    //     if (!$user->updateBalance($this->amount)) {
    //          //Hago rollback de transacción ** TO DO **
    //          return false;  
    //     }

    //     $this->new_balance = $user->balance;
    //     $this->save();

    //     return true;
    // }

    public function getTotalInvitations ($owner) {
        $matchThese = ['owner' => $owner, 'status' => 0];

        $directs = BonusRedeem::where($matchThese)->get();
        return $directs;
        
        // test data proof
        // $data = [
        //     [
        //         'id'=>78, 'owner' =>     2, 'referred_user'=>3, 'type'=> 'Solidary', 'status'=>  0, 'created_at'=>  '2021-05-04 17:29:18',
        //     ],
        //     [
        //         'id'=>79, 'owner' =>     2, 'referred_user'=>4, 'type'=> 'Solidary', 'status'=>  0, 'created_at'=>  '2021-05-04 17:29:18'
        //     ],

        //     [
        //         'id'=>80, 'owner' =>     2, 'referred_user'=>4, 'type'=> 'Solidary', 'status'=>  0, 'created_at'=>  '2021-05-04 17:29:18'
        //     ],
        //     [
        //         'id'=>81, 'owner' =>     2, 'referred_user'=>4, 'type'=> 'Solidary', 'status'=>  0, 'created_at'=>  '2021-05-04 17:29:18'
        //     ]
        // ];
        
        // return $data;
    }
    //Saldo del usuario

    public function updateBalance ($amount = 0) { //El monto puede ser positivo o negativo
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
