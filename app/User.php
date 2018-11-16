<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable ,SoftDeletes;

    protected $fillable = [
        'firstname', 'lastname', 'middlename', 'email', 'password', 'type', 'birthdate', 'city', 'address', 'contact'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = [
        'deleted_at'
    ];

    public function donor()
    {
        return $this->hasOne('App\Model\Users\Donor');
    }

    public function recipient()
    {
        return $this->hasOne('App\Model\Users\Recipient');
    }

    public function admin()
    {
        return $this->hasOne('App\Model\Users\Admin');
    }

    public function candidate()
    {
        return $this->hasOne('App\Model\Users\Candidate');
    }

    public function disapproved()
    {
        return $this->hasOne('App\Model\Users\Disapproved');
    }

    public function doctor()
    {
        return $this->hasOne('App\Model\Users\Doctor');
    }

    public function nurse()
    {
        return $this->hasOne('App\Model\Users\Nurse');
    }

    public function client()
    {
        return $this->hasOne('App\Model\Users\Client');
    }

}
