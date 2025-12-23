<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) optional($this->user())->is_admin;
    }

    public function rules(): array
    {
        $id = $this->route('product')?->id;

        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name_en' => ['required', 'string', 'max:190'],
            'name_ar' => ['nullable', 'string', 'max:190'],
            'slug' => ['nullable', 'string', 'max:190', 'unique:products,slug,'.($id ?? 'NULL').',id'],

            'excerpt_en' => ['nullable', 'string', 'max:500'],
            'excerpt_ar' => ['nullable', 'string', 'max:500'],

            'description_en' => ['nullable', 'string', 'max:10000'],
            'description_ar' => ['nullable', 'string', 'max:10000'],

            'ingredients' => ['nullable', 'string', 'max:5000'],
            'benefits' => ['nullable', 'string', 'max:5000'], // comma-separated, converted to array

            'image' => ['nullable', 'image', 'max:6144'],
            'og_image' => ['nullable', 'image', 'max:6144'],

            'is_featured' => ['nullable', 'boolean'],
            'status' => ['required', 'in:published,draft'],
            'published_at' => ['nullable', 'date'],

            'seo_title' => ['nullable', 'string', 'max:70'],
            'seo_description' => ['nullable', 'string', 'max:160'],
        ];
    }
}
