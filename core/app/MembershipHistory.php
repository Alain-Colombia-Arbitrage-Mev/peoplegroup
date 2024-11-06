<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipHistory extends Model
{
     protected $table = 'membership_history';

     public function user()
     {
          return $this->hasOne(User::class, 'id','user_id')->withDefault();
     }

    public function membership()
    {
          return $this->hasOne(Membership::class, 'id','membership_id')->withDefault();
    }
}
