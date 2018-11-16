<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Requesting extends Model
{
    
    protected $fillable = [ 
    'child_firstname', 'child_lastname',  'birthdate', 'gender',  'reason_why', 
    'schedule',  'approved', 'client_id', 'received_at', 'nurse_id', 'doctor_id',
    ];

    protected $dates = [
        'deleted_at'
    ];
    
    //user's foreign keys
    public function nurse()
    {
        return $this->belongsTo('App\Model\Users\Nurse');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Model\Users\Doctor');
    }

    public function containers()
    {
        return $this->hasMany('App\Model\Files\Container');
    }

    public function client()
    {
        return $this->belongsTo('App\Model\Users\Client');
    }

}
