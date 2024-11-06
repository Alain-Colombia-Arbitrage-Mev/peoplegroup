<?php

/*

1-Deposito
2-Compra de membresía
3-Pedido
4-Bono Rápido
5-Bono Unilevel
6-Bono por consumo
7-Retiro de dinero
8-TF Entrante
9-TF Saliente
10-Ingreso Admin por Cargo de Depósito
11-Ingreso Admin por Cargo de Retiro
12-Ingreso Admin por Cargo de Transferencia
13-Ingreso Admin por costo de membresia
14-Ingreso Admin por costo de producto
15-Entrada de dinero a la wallet de reserva
16-Salida de dinero de la wallet de reserva
17-Ingreso Admin por utilidad Compra de membresia
18-Ingreso Admin por utilidad Compra de producto
19-Ingreso Admin por Restante de utilidad Bono Unilevel
20-Ingreso Admin por Restante de utilidad Bono Consumo

*/

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'trans_id',
        'time',
        'description',
        'amount',
        'new_balance',
        'type',
        'charge'
    ];

    public function member()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withDefault();
    }

    //Guardo la transaccion y actualizo saldo
    public function saveAndUpdateBalance(User &$user){
        if (!$this->save()) {
            return false;
        }
        $total = ($this->amount < 0) ? $this->amount + $this->charge : $this->amount;
        if (!$user->updateBalance($this->amount)) {
             //Hago rollback de transacción ** TO DO **
             return false;  
        }

        $this->new_balance = $user->balance;
        $this->save();

        return true;
    }
}
