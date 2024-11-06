<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    public $gateways;
    
    function __construct($collectionsGateways = ['*']) {
        parent::__construct($collectionsGateways);
        $this->gateways =  $collectionsGateways;
    }

    protected $table = 'gateways';
    protected $fillable = array( 'name','gateimg', 'minamo', 'maxamo', 'chargefx','chargepc', 'rate', 'val1', 'val2','val3','currency', 'status');

    public function sell()
    {
        return $this->hasMany(Deposit::class, 'id', 'gateway_id');
    }

    // public function  addGateway($gateway) {
    //     array_push($this->gateways, $gateway);
    // }
    // @override 
    // public  static function  list () {
    //     // return $this->gateways;
    // }
}
