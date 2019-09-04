<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activitys';
    public $timestamps = false;
    protected $fillable = ['activity_name','start_time','number','activity_type','participant','place','activity_content','is_over','summary'];
}
