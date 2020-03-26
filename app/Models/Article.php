<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $table='article';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'title',
        'content',
        'created_at',
        'status'
    ];
}
