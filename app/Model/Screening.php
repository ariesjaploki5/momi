<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Screening extends Model
{
    protected $fillable = [
        'child_firstname',
        'child_lastname',
        'birthdate',
        'gender',
        'reason_why',
        'schedule',
        'approved_for_medical_test',
        'approved_to_donate',
        'medical_test',
        'candidate_id',
        'doctor_id',
        'nurse_id',
        'client_id'
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

    //file's foreing keys
    public function tests()
    {
        return $this->belongsToMany('App\Model\Files\Test')
        ->withPivot('result')->withTimestamps();
    }

    public function questions()
    {
        return $this->belongsToMany('App\Model\Files\Question')
        ->withPivot('answer')->withTimestamps();
    }

    public function client()
    {
        return $this->belongsTo('App\Model\Users\Client');
    }
}
