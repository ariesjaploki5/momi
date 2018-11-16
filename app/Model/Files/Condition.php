<?php

namespace App\Model\Files;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condition extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'name', 'type',];

    protected $dates = [
        'deleted_at'
    ];

    public function donors()
    {
        return $this->belongsToMany('App\Model\Users\Donor')
                    ->withTimestamps();
    }
}
