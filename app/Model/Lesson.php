<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [];
    // 一对多管理
    pubLic function videos(){
        return $this->hasMany(Video::class);
    }

}
