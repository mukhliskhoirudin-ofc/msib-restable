<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Vidio extends Model
{
    protected $fillable = [
        'title',
        'url',
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

    // ambil video ID dari url YouTube
    public function getVideoIdAttribute(): ?string
    {
        $url = $this->url;

        // Format: https://www.youtube.com/watch?v=xxxx
        if (str_contains($url, 'v=')) {
            return Str::before(Str::after($url, 'v='), '&');
        }

        // Format: https://youtu.be/xxxx
        if (str_contains($url, 'youtu.be/')) {
            return Str::before(Str::after($url, 'youtu.be/'), '?');
        }

        return null;
    }


    // ambil thumbnail otomatis dari YouTube
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->video_id
            ? "https://img.youtube.com/vi/{$this->video_id}/hqdefault.jpg"
            : null;
    }

    // ambil embed URL YouTube
    public function getEmbedUrlAttribute(): ?string
    {
        return $this->video_id
            ? "https://www.youtube.com/embed/{$this->video_id}"
            : null;
    }
}
