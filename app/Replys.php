<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replys extends Model
{
    public $table = 'replys';
    public $timestamps = false;
    protected $fillable = ['name','w_id','time','centent','u_id'];
}
