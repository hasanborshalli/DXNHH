<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [
            route('home'),
            route('about'),
            route('services'),
            route('products'),
            route('shop'),
            route('contact'),
        ];

        $productUrls = Product::published()->get(['slug', 'updated_at'])
            ->map(fn ($p) => [
                'loc' => route('shop.show', $p->slug),
                'lastmod' => optional($p->updated_at)->toAtomString(),
            ])->all();

        $xml = view('sitemap.index', [
            'urls' => $urls,
            'productUrls' => $productUrls,
        ])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
