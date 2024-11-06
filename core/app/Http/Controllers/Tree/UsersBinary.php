<?php

namespace App\Http\Controllers\Tree;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UsersBinary extends Model 
{
    public $timestamps = false;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tag', 'parent', 'left', 'right', 'position', 'value', 'directowner' 
    ];

  /*  public function withdraw()
    {
        return $this->belongsTo(WithdrawTrasection::class)->withDefault();
    }

*/

    public function getTree($owner) {
        $matchThese = ['owner' => $owner, 'status' => 0];

        $directs = BonusRedeem::where($matchThese)->get();
        return $directs;
    }
}
