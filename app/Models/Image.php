<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'description',
        'file',
    ];
}
