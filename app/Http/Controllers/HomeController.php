<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::published()
            ->where('is_featured', true)
            ->with('category')
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('pages.home', [
            'featured' => $featured,
            'metaTitle' => config('hala.site_name'),
            'metaDescription' => config('hala.default_description'),
        ]);
    }
}
