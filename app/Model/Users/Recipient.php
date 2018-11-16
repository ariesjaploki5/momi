<?php

namespace App\Model\Users;

use Illuminate\Database\Eloquent\Model;


class Recipient extends Model
{
    protected $fillable = [
        'user_id',
    ];
    

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
