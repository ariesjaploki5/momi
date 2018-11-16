<?php

namespace App\Model\Users;

use Illuminate\Database\Eloquent\Model;


class Nurse extends Model
{

    
    protected $fillable = [
        'user_id',
    ];
    


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function screenings()
    {
        return $this->hasMany('App\Model\Screening');
    }

    public function requesting()
    {
        return $this->hasMany('App\Model\Requesting');
    }
}
