<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class CronController extends Controller
{

    private function checkTransactionCoinpayments ($idtx, $user) {

        // si verifico bien cambia estado y reflejar deposito a usuario.
        if ($gate->id == 9) {
            $sell['status'] = 9; //Se confirmará en la view de preview, pasará a 0
        }

        Cron::Execute($task);
        Deposit::create($sell);
    }


}
