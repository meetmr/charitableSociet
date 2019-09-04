<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public $table = 'words';
    public $timestamps = false;
    protected $fillable = ['u_id','content','time','name'];

}
