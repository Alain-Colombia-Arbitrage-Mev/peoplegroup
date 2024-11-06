<?php

namespace App;

interface IPolicy {
    function read($config);
    function verify($payload);
    function liquidity();
}

abstract class PolicyGeneral implements IPolicy {

    public $version;
    public static  $ALLREADY = 100;
    protected $_isHold = true;

    public $rules = [
            'all_directs_active' => true,
            'owner_active' => true,
    ]; 

    function __construct ($rules) {
        if (is_array($rules)){
            $this->read($rules);
        }
    }


    public function getRules() {
        return $this->rules;
    }

    public function read($rules) {
        $this->rules = array_merge($this->rules, $rules['customrules']);
        // print_r($this->rules);
        // die(print_r($this->rules));
        if (!$this->_check()) {
            throw new \Exception(static::class . ' Rule is missing!');
        }
    }

    public function existsRule ($key) {
        return array_key_exists($key, $this->rules);
    }

    private function _check () {
        $rules = $this->rules;
        $totalRulesAproved = 0;
        foreach($rules as $rule => $val) {
            if ($this->existsRule($rule))  {
                $totalRulesAproved++;
            } 
        }
        return ($totalRulesAproved == count($rules));
    }


    public function getRequirements () {
        return  (Object) $this->rules['customrules'];
    }
    
    public function verify ($payload) {    
        $requirements = (Object) $this->rules['customrules'];

        if ($this->_isHold) {
            echo "oh, oh este bono es acumulable";

            if ($requirements->all_directs_active !== $payload['all_directs_active']) {
                throw new \Exception("No cumple con la politica de todos los directos!");
            }
        }

        return OxigenoStatusCode::$OK;
    }
}


class OxigenoStatusCode 
{
    public static $ERROR = 0; 
    public static $OK = 1; 
}


class BonusSolidarioPolicy extends PolicyGeneral {

    public $version = '1.0.0';
    public $name = 'Solidary Bonus Policy';
    public $owner;
    public $baseprice = 0;

    public function __construct ($rules, User $owner, $baseprice) {
        $this->owner = $owner;
        $this->baseprice = $baseprice;
        $this->payroll = [0.04, 0.04, 0.04, 0.1];
        
        parent::__construct($rules, $owner);
    }

    public function setOwner (User $user) {
        $this->owner = $user;
    }

    public function  __toString () {
        return $this->name;
    }


    public function liquidity () {
        return "liquidity...";
    }

    public function notify () {
        echo "notificando bono solidario acumulado!";
    }

    public function verify ($payload) {
        try {
            $preVerify = parent::verify($payload);
            if (parent::getRequirements()->required_directs == $payload['required_directs']) {
                // $this->notify(); 
                return OxigenoStatusCode::$OK;
            }
        } catch (\Exception $e) {
            print_r($e->message);
        }
        return OxigenoStatusCode::$ERROR;
    }
}

class BonusSolidary {
    
    // change the owner of this Bonus    
    private $payloadPolicy; 
    private $policy;
    private $directs = [];

    public function addPartner($directs) {
        array_push($this->directs, $directs);
    }
    
    public function __construct(BonusSolidarioPolicy $policy) {
        $this->policy = $policy;
    }

    public function payable () {
        $directs = $this->directs;

        $payments = [];
        $i = 0;
        foreach ($directs as $dir) {
            $item = ['from_user' => $dir['referred_user'], 'amount'=> $this->policy->baseprice * $this->policy->payroll[$i]];
            array_push($payments, $item);
            $i++;
        }

        return  $payments;
    }

    public function redimir () {
        $directs = $this->directs;
        $nominaPayable = [];

        if (count($directs) === $this->policy->rules['required_directs']) {
            $nominaPayable = $this->payable();
        } 
        return $nominaPayable;  
    }
    
    public function setPayload($payload) {
        if ($this->policy->getRequirements()) {
            $this->payloadPolicy = $payload;
        }
    }

    private function _liquidity () {
        if ($this->policy->liquidity()) {
            print_r($this->policy);
        }
    }   

    public function liquidity ($to) {
        return $this->_liquidity();
    }
}

