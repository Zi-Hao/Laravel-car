<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $table = 'coach';
    public $timestamps = true;

    protected $fillable = [
        'id', 'name', 'sex', 'phone',
        'wechat', 'image', 'describe', 'status'
    ];
}
