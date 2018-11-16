<?php

namespace App\Model\Files;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Milk extends Model
{
    use SoftDeletes;
    
    protected $fillable = [ 'batch_number', 'expiration_date'];

    protected $dates = [ 'deleted_at',];

    public function donors()
    {
        return $this->belongsToMany('App\Model\Users\Donor')
                    ->withTimestamps();
    }

    public function containers()
    {
        return $this->hasMany('App\Model\Files\Container');
    }

}
