@php($isEdit = !empty($product))
<div class="panel">
    <form method="POST"
        action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}"
        enctype="multipart/form-data" class="form">
        @csrf
        @if($isEdit) @method('PUT') @endif

        <div class="grid-2">
            <div class="field">
                <label>Category</label>
                <select name="category_id" required>
                    <option value="">Select category</option>
                    @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ (string) old('category_id', $product->category_id ?? '') ===
                        (string) $c->id ? 'selected' : '' }}>
                        {{ $c->name_en }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>Status</label>
                <select name="status" required>
                    @php($st = old('status', $product->status ?? 'published'))
                    <option value="published" {{ $st==='published' ? 'selected' : '' }}>published</option>
                    <option value="draft" {{ $st==='draft' ? 'selected' : '' }}>draft</option>
                </select>
            </div>
        </div>

        <div class="grid-2">
            <div class="field">
                <label>Name (EN)</label>
                <input type="text" name="name_en" value="{{ old('name_en', $product->name_en ?? '') }}" required>
            </div>
            <div class="field">
                <label>Name (AR)</label>
                <input type="text" name="name_ar" value="{{ old('name_ar', $product->name_ar ?? '') }}">
            </div>
        </div>

        <div class="field">
            <label>Slug (optional)</label>
            <input type="text" name="slug" value="{{ old('slug', $product->slug ?? '') }}">
            <small class="muted">If empty, it will be generated from Name (EN).</small>
        </div>

        <div class="grid-2">
            <div class="field">
                <label>Excerpt (EN)</label>
                <textarea name="excerpt_en" rows="3">{{ old('excerpt_en', $product->excerpt_en ?? '') }}</textarea>
            </div>
            <div class="field">
                <label>Excerpt (AR)</label>
                <textarea name="excerpt_ar" rows="3">{{ old('excerpt_ar', $product->excerpt_ar ?? '') }}</textarea>
            </div>
        </div>

        <div class="grid-2">
            <div class="field">
                <label>Description (EN)</label>
                <textarea name="description_en"
                    rows="6">{{ old('description_en', $product->description_en ?? '') }}</textarea>
            </div>
            <div class="field">
                <label>Description (AR)</label>
                <textarea name="description_ar"
                    rows="6">{{ old('description_ar', $product->description_ar ?? '') }}</textarea>
            </div>
        </div>

        <div class="grid-2">
            <div class="field">
                <label>Ingredients</label>
                <textarea name="ingredients" rows="5">{{ old('ingredients', $product->ingredients ?? '') }}</textarea>
            </div>
            <div class="field">
                <label>Benefits (comma or new line separated)</label>
                <textarea name="benefits"
                    rows="5">{{ old('benefits', !empty($product?->benefits) ? implode("\n", $product->benefits) : '') }}</textarea>
            </div>
        </div>

        <div class="grid-2">
            <div class="field">
                <label>Product Image (optional)</label>
                <input type="file" name="image" accept="image/*">
                @if(!empty($product?->image_path))
                <small class="muted">Current: {{ $product->image_path }}</small>
                @endif
            </div>
            <div class="field">
                <label>OG Image (optional)</label>
                <input type="file" name="og_image" accept="image/*">
                @if(!empty($product?->og_image_path))
                <small class="muted">Current: {{ $product->og_image_path }}</small>
                @endif
            </div>
        </div>

        <div class="grid-2">
            <div class="field">
                <label>SEO Title (max 70)</label>
                <input type="text" name="seo_title" maxlength="70"
                    value="{{ old('seo_title', $product->seo_title ?? '') }}">
            </div>
            <div class="field">
                <label>SEO Description (max 160)</label>
                <input type="text" name="seo_description" maxlength="160"
                    value="{{ old('seo_description', $product->seo_description ?? '') }}">
            </div>
        </div>

        <div class="field checkbox">
            <label>
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured ??
                false) ? 'checked' : '' }}>
                Featured
            </label>
        </div>

        <button class="btn" type="submit">{{ $isEdit ? 'Update' : 'Create' }}</button>
    </form>
</div>