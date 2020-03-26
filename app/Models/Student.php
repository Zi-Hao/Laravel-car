<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $table = 'student';
    public $timestamps = false;
    protected $fillable =['sex','name','coach','phone'];
}
