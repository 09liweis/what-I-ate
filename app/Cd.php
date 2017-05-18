<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cd extends Model {
    protected $table = 'cds';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['titel', 'interpret', 'jahr'];
}
