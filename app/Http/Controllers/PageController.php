<?php

namespace App\Http\Controllers;

use App\Models\Category;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about', [
            'metaTitle' => __('site.nav.about').' | '.config('hala.site_name'),
            'metaDescription' => config('hala.default_description'),
        ]);
    }

    public function services()
    {
        return view('pages.services', [
            'metaTitle' => __('site.nav.services').' | '.config('hala.site_name'),
            'metaDescription' => config('hala.default_description'),
        ]);
    }

    public function products()
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->withCount(['products' => fn ($q) => $q->published()])
            ->orderBy('name_en')
            ->get();

        return view('pages.products', [
            'categories' => $categories,
            'metaTitle' => __('site.nav.products').' | '.config('hala.site_name'),
            'metaDescription' => config('hala.default_description'),
        ]);
    }
}
