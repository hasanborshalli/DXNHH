<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()->where('is_active', true)->orderBy('name_en')->get();

        $query = Product::published()->with('category');

        if ($request->filled('q')) {
            $q = trim($request->string('q')->toString());
            $query->where(function ($sub) use ($q) {
                $sub->where('name_en', 'like', "%{$q}%")
                    ->orWhere('name_ar', 'like', "%{$q}%")
                    ->orWhere('excerpt_en', 'like', "%{$q}%")
                    ->orWhere('excerpt_ar', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $slug = $request->string('category')->toString();
            $query->whereHas('category', fn ($q) => $q->where('slug', $slug));
        }

        $sort = $request->string('sort')->toString();
        $sort = in_array($sort, ['newest','oldest','name_asc','name_desc'], true) ? $sort : 'newest';

        match ($sort) {
            'oldest' => $query->orderBy('published_at')->orderBy('id'),
            'name_asc' => $query->orderBy('name_en'),
            'name_desc' => $query->orderByDesc('name_en'),
            default => $query->orderByDesc('published_at')->orderByDesc('id'),
        };

        $products = $query->paginate(12)->withQueryString();

        return view('shop.index', [
            'categories' => $categories,
            'products' => $products,
            'activeCategory' => $request->string('category')->toString(),
            'q' => $request->string('q')->toString(),
            'sort' => $sort,
            'metaTitle' => __('site.nav.shop').' | '.config('hala.site_name'),
            'metaDescription' => __('site.seo.shop_desc'),
        ]);
    }

    public function show(Product $product)
    {
        abort_unless($product->status === 'published', 404);

        $metaTitle = $product->seo_title ?: ($product->name.' | '.config('hala.site_name'));
        $metaDescription = $product->seo_description ?: ($product->excerpt ?: config('hala.default_description'));

        return view('shop.show', [
            'product' => $product->load('category'),
            'metaTitle' => $metaTitle,
            'metaDescription' => $metaDescription,
            'ogImage' => $product->og_image_url,
        ]);
    }
}
