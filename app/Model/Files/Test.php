<?php

namespace App\Model\Files;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use SoftDeletes;
    
    protected $fillable = [ 'name', 'selected', 'correct'];

    protected $dates = [ 'deleted_at'];

    public function screenings()
    {
        return $this->belongsToMany('App\Model\Screening')
            ->withPivot('result')->withTimestamps();
    }
}
