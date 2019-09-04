<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comments';
    public $timestamps = false;
    protected $fillable = ['name','a_id','time','content','u_id'];
}
