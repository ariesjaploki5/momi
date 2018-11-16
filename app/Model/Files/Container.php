<?php

namespace App\Model\Files;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $fillable = ['number', 'milk_id', 'requesting_id', 'type'];

    public function milk()
    {
        return $this->belongsTo('App\Model\Files\Milk');
    }

    public function requesting()
    {
        return $this->belongsTo('App\Model\Requesting');
    }
}
