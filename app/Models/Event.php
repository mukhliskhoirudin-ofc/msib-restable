<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'status'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getBadgeColorAttribute()
    {
        return match ($this->status) {
            'active' => 'success',
            'inactive' => 'danger',
        };
    }
}
