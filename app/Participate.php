<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participate extends Model
{
    protected $table = 'participates';
    public $timestamps = false;
    protected $fillable = ['ac_id','u_id','name','school_number','class','department']; //
}
