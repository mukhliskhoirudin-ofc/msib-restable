<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'date',
        'time',
        'people',
        'amount',
        'file',
        'status',
        'reason',
        'message'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->code = 'ORD-' . str_pad(static::count() + 1, 6, '0', STR_PAD_LEFT);
        });
    }
    public function getRouteKeyName()
    {
        return 'code';
    }

    public function getBadgeColorAttribute()
    {
        return match ($this->status) {
            'success' => 'success',
            'pending' => 'warning',
            'failed' => 'danger',
        };
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }
}
