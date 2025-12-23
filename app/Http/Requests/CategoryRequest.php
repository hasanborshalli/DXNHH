<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) optional($this->user())->is_admin;
    }

    public function rules(): array
    {
        $id = $this->route('category')?->id;

        return [
            'name_en' => ['required', 'string', 'max:190'],
            'name_ar' => ['nullable', 'string', 'max:190'],
            'slug' => ['nullable', 'string', 'max:190', 'unique:categories,slug,'.($id ?? 'NULL').',id'],
            'description_en' => ['nullable', 'string', 'max:2000'],
            'description_ar' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'max:4096'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
