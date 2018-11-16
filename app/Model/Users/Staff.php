<?php

namespace App\Model\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    protected $fillable = [
        'user_id',
    ];
    
    protected $dates = [
        'deleted_at'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
