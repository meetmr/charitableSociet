<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    public $table = 'abouts';
    public $timestamps = false;
    protected $fillable = ['title','icon','coantent','time'];
}
