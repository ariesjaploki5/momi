<?php

namespace App\Model\Files;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    
    protected $fillable = [ 'text', 'selected'];

    protected $dates = [ 'deleted_at'];

    public function screenings()
    {
        return $this->belongsToMany('App\Model\Screening')
            ->withPivot('answer')
            ->withTimestamps();
    }
}
