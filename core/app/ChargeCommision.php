<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChargeCommision extends Model
{
    protected $table = 'charge_commisions';
    protected $fillable = [
        'transfer_charge',
        'withdraw_charge',
        'update_text',
        'level1_bonus',
        'level2_bonus',
        'level3_bonus',
        'level4_bonus',
        'level5_bonus',
        'level1_consu',
        'level2_consu',
        'level3_consu',
        'level4_consu',
        'level5_consu',
        'rest_bonus_for',
    ];
}
