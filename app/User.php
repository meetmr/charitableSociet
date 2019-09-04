<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $fillable = ['emal','school_number','emal','department','class','user_name','is_serious','icon_path'];
}
