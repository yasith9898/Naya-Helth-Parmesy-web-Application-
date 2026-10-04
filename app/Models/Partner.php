<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'website_link',
        'order',
        'is_active'
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'is_active' => 'boolean'
    ];

    protected $appends = ['image_url'];

    public function getNameAttribute($value)
    {
        return json_decode($value, true) ?? ['en' => '', 'es' => ''];
    }

    public function getDescriptionAttribute($value)
    {
        return json_decode($value, true) ?? ['en' => '', 'es' => ''];
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('images/default-image.png');
        }

        $path = $this->image;

        // If it's already a full URL, return as is
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Ensure no leading slash
        $path = ltrim($path, '/\\');

        // Check if file exists in storage disk
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->url($path);
        }

        // Check if file exists under public/storage
        if (file_exists(public_path('storage/' . $path))) {
            return asset('storage/' . $path);
        }

        // Check if file exists in public folder
        if (file_exists(public_path($path))) {
            return asset($path);
        }

        // Fallback to default image
        return asset('images/default-image.png');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at');
    }
}

