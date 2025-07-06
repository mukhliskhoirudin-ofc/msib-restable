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

    //slug dan uuid otomatis
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            if ($model->isDirty('name')) {  //isDirty: ngecek ada perubahan gk di name, kalo tidak ada dia tidak update/kebalikannya
                $model->slug = Str::slug($model->name);
            }
        });
    }
}
