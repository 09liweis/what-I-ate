<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function foods() {
        return $this->hasMany('App\Food');
    }
}
