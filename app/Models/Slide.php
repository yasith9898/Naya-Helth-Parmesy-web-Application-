<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'order',
        'is_active',
        'button_text',
        'button_link'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('images/default-slide.jpg');
        }

        // If already an absolute URL
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // If it's a relative path starting with '/'
        if (strpos($this->image, '/') === 0) {
            return asset($this->image);
        }

        // Check if file exists in public directory
        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        // Check if file exists in storage
        if (Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }

        // Return default image if not found
        return asset('images/default-slide.jpg');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
