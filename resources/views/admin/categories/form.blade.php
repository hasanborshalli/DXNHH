@php($isEdit = !empty($category))
<div class="panel">
    <form method="POST"
        action="{{ $isEdit ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
        enctype="multipart/form-data" class="form">
        @csrf
        @if($isEdit) @method('PUT') @endif

        <div class="grid-2">
            <div class="field">
                <label>Name (EN)</label>
                <input type="text" name="name_en" value="{{ old('name_en', $category->name_en ?? '') }}" required>
            </div>
            <div class="field">
                <label>Name (AR)</label>
                <input type="text" name="name_ar" value="{{ old('name_ar', $category->name_ar ?? '') }}">
            </div>
        </div>

        <div class="grid-2">

            <div class="field">
                <label>Image (optional)</label>
                <input type="file" name="image" accept="image/*">
                @if(!empty($category?->image_path))
                <small class="muted">Current: {{ $category->image_path }}</small>
                @endif
            </div>
        </div>

        <div class="grid-2">
            <div class="field">
                <label>Description (EN)</label>
                <textarea name="description_en"
                    rows="4">{{ old('description_en', $category->description_en ?? '') }}</textarea>
            </div>
            <div class="field">
                <label>Description (AR)</label>
                <textarea name="description_ar"
                    rows="4">{{ old('description_ar', $category->description_ar ?? '') }}</textarea>
            </div>
        </div>

        <div class="field checkbox">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active ?? true) ?
                'checked' : '' }}>
                Active
            </label>
        </div>

        <button class="btn" type="submit">{{ $isEdit ? 'Update' : 'Create' }}</button>
    </form>
</div>