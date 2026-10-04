<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name_en', 'name_es',
        'trade_name_en', 'trade_name_es',
        'origin_en', 'origin_es',
        'packaging_en', 'packaging_es',
        'composition_en', 'composition_es',
        'desc_en', 'desc_ar', 'desc_ku', 'desc_tr', 'desc_fa',
        'normal_price', 'price_with_ice_cream', 'price_per_kilo', 'currency',
        'cover_image', 'gallery_images', 'slug', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'gallery_images' => 'array'
    ];

    protected $appends = ['cover_image_url'];

    // FIXED: Proper image URL accessor for items
    public function getCoverImageUrlAttribute()
    {
        $raw = $this->cover_image;

        if (empty($raw)) {
            return asset('images/default-item.png');
        }

        // Normalize if stored as JSON or array (some code paths saved arrays)
        $path = null;
        if (is_array($raw)) {
            $path = $raw[0] ?? null;
        } elseif (is_string($raw)) {
            $decoded = json_decode($raw, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $path = $decoded[0] ?? null;
            } else {
                $path = $raw;
            }
        } else {
            $path = (string) $raw;
        }

        if (empty($path)) {
            return asset('images/default-item.png');
        }

        // Ensure no leading slash
        $path = ltrim($path, '/\\');

        // If it's already a full URL, return as is
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Prefer using the public storage asset path for consistency
        if (Storage::disk('public')->exists($path) || file_exists(public_path('storage/' . $path))) {
            return asset('storage/' . $path);
        }

        // If stored as a public path (e.g., 'uploads/...')
        if (file_exists(public_path($path))) {
            return asset($path);
        }

        return asset('images/default-item.png');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            // If slug not provided, generate from English name
            if (empty($item->slug)) {
                $base = Str::slug($item->name_en ?: time());
                $slug = $base;
                $counter = 1;

                while (self::where('slug', $slug)
                          ->where('trade_name_en', $item->trade_name_en ?? null)
                          ->exists()) {
                    $slug = $base . '-' . $counter++;
                }

                $item->slug = $slug;
            }
        });
    }

    // Accessor for getting name in current language
    public function getNameAttribute()
    {
        $lang = session('language', 'en');
        $nameField = "name_{$lang}";

        return $this->$nameField ?? $this->name_en;
    }

    // Accessor for description (desc_* fields)
    public function getDescriptionAttribute()
    {
        $lang = session('language', 'en');
        $field = $lang === 'en' ? 'desc_en' : "desc_{$lang}";

        if (isset($this->$field) && !empty($this->$field)) {
            return $this->$field;
        }

        return $this->desc_en ?? null;
    }

    // Accessor for getting trade name in current language
    public function getTradeNameAttribute()
    {
        $lang = session('language', 'en');
        $tradeNameField = "trade_name_{$lang}";

        return $this->$tradeNameField ?? $this->trade_name_en;
    }

    // Accessor for getting origin in current language
    public function getOriginAttribute()
    {
        $lang = session('language', 'en');
        $originField = "origin_{$lang}";

        return $this->$originField ?? $this->origin_en;
    }

    // Accessor for getting packaging in current language
    public function getPackagingAttribute()
    {
        $lang = session('language', 'en');
        $packagingField = "packaging_{$lang}";

        return $this->$packagingField ?? $this->packaging_en;
    }

    // Accessor for getting composition in current language
    public function getCompositionAttribute()
    {
        $lang = session('language', 'en');
        $compositionField = "composition_{$lang}";

        return $this->$compositionField ?? $this->composition_en;
    }

    // Helper method to get all data in current language
    public function getLocalizedData()
    {
        $lang = session('language', 'en');

        return [
            'name' => $this->{"name_{$lang}"} ?? $this->name_en,
            'trade_name' => $this->{"trade_name_{$lang}"} ?? $this->trade_name_en,
            'origin' => $this->{"origin_{$lang}"} ?? $this->origin_en,
            'packaging' => $this->{"packaging_{$lang}"} ?? $this->packaging_en,
            'composition' => $this->{"composition_{$lang}"} ?? $this->composition_en,
        ];
    }
}
