<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->with('category')
            ->orderByDesc('id')
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::query()->where('is_active', true)->orderBy('name_en')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name_en']);
        $data['is_featured'] = (bool) $request->boolean('is_featured', false);

        // published_at handling
        if (($data['status'] ?? 'published') === 'published') {
            $data['published_at'] = $data['published_at'] ?? now();
        } else {
            $data['published_at'] = null;
        }

        $data['benefits'] = $this->parseBenefits($request->input('benefits'));

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }
        if ($request->hasFile('og_image')) {
            $data['og_image_path'] = $request->file('og_image')->store('products-og', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::query()->where('is_active', true)->orderBy('name_en')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name_en']);
        $data['is_featured'] = (bool) $request->boolean('is_featured', false);

        // published_at handling
        if (($data['status'] ?? 'published') === 'published') {
            $data['published_at'] = $data['published_at'] ?? now();
        } else {
            $data['published_at'] = null;
        }

        $data['benefits'] = $this->parseBenefits($request->input('benefits'));

        if ($request->hasFile('image')) {
            if ($product->image_path) Storage::disk('public')->delete($product->image_path);
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }
        if ($request->hasFile('og_image')) {
            if ($product->og_image_path) Storage::disk('public')->delete($product->og_image_path);
            $data['og_image_path'] = $request->file('og_image')->store('products-og', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path) Storage::disk('public')->delete($product->image_path);
        if ($product->og_image_path) Storage::disk('public')->delete($product->og_image_path);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    private function parseBenefits(?string $raw): array
    {
        $raw = trim((string) $raw);
        if ($raw === '') return [];

        // Accept comma-separated or newline-separated lists.
        $parts = preg_split('/[\n,]+/', $raw) ?: [];
        $parts = array_map(fn ($x) => trim($x), $parts);
        $parts = array_values(array_filter($parts, fn ($x) => $x !== ''));

        // Cap to avoid abuse
        return array_slice($parts, 0, 50);
    }
}
