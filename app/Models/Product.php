<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name_en', 'name_ar', 'slug',
        'excerpt_en', 'excerpt_ar',
        'description_en', 'description_ar',
        'ingredients',
        'benefits',
        'image_path',
        'og_image_path',
        'is_featured',
        'status',
        'seo_title',
        'seo_description',
        'published_at',
    ];

    protected $casts = [
        'benefits' => 'array',
        'is_featured' => 'bool',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function setSlugAttribute($value): void
    {
        $base = $value ?: ($this->attributes['name_en'] ?? '');
        $this->attributes['slug'] = Str::slug($base);
    }

    public function getNameAttribute(): string
    {
        return app()->getLocale() === 'ar' && $this->name_ar ? $this->name_ar : $this->name_en;
    }

    public function getExcerptAttribute(): ?string
    {
        return app()->getLocale() === 'ar' && $this->excerpt_ar ? $this->excerpt_ar : $this->excerpt_en;
    }

    public function getDescriptionAttribute(): ?string
    {
        return app()->getLocale() === 'ar' && $this->description_ar ? $this->description_ar : $this->description_en;
    }

    public function getOgImageUrlAttribute(): ?string
    {
        if ($this->og_image_path) return asset('storage/'.$this->og_image_path);
        if ($this->image_path) return asset('storage/'.$this->image_path);
        return null;
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? asset('storage/'.$this->image_path) : null;
    }
}
