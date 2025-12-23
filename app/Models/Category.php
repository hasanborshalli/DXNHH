<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en', 'name_ar', 'slug',
        'description_en', 'description_ar',
        'image_path', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'bool',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function setSlugAttribute($value): void
    {
        $this->attributes['slug'] = $value ? Str::slug($value) : Str::slug($this->attributes['name_en'] ?? '');
    }

    public function getNameAttribute(): string
    {
        return app()->getLocale() === 'ar' && $this->name_ar ? $this->name_ar : $this->name_en;
    }

    public function getDescriptionAttribute(): ?string
    {
        return app()->getLocale() === 'ar' && $this->description_ar ? $this->description_ar : $this->description_en;
    }
}
