<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    protected $fillable = [
        'name',
        'position',
        'description',
        'image',
        'insta_link',
        'linked_link'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
