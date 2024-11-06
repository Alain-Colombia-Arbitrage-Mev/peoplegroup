<?php

namespace App\Http\Controllers\Tree;

define("BINARY_VERSION",  1.0);

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NetworkInfo  
{

    public function getTree($owner) {
        $matchThese = ['owner' => $owner, 'status' => 0];

        $directs = BonusRedeem::where($matchThese)->get();
        return $directs;
    }

    public static function  generatePartnerLink ($parent, $direct, $leg) {
        $endpoint = 'http://oxigeno.local/register';
        return $endpoint.'?sponsor='.$parent.'&leg='.$leg.'&direct='.$direct;
    }
}
