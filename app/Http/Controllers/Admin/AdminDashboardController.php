<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'counts' => [
                'categories' => Category::count(),
                'products' => Product::count(),
                'messages' => ContactMessage::count(),
            ],
            'latestMessages' => ContactMessage::latest()->take(5)->get(),
        ]);
    }
}