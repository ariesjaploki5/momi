<?php

namespace App\Model\Users;

use Illuminate\Database\Eloquent\Model;


class Donor extends Model
{
    protected $fillable = [
        'user_id',
    ];
    

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function milks()
    {
        return $this->belongsToMany('App\Model\Files\Milk')
        ->withTimestamps();
    }

    public function medical_conditions()
    {
        return $this->belongsToMany('App\Model\MedicalCondition')
        ->withTimestamps();
    }
}
