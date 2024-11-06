<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CryptoTransaction extends Model
{
    protected $table = 'crypto_transactions';

    protected $fillable = [
        'user_from',
        'user_to',
        'wallet_from',
        'wallet_to',
        'description',
        'amount',
        'status',
        'transaction_id_from',
        'transaction_id_to',
    ];
}
