<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();
        $totalNews = News::count();
        
        $categories = Category::withCount('news')->get();
        $chartLabels = $categories->pluck('name');
        $chartData = $categories->pluck('news_count');
        
        $recentCategories = Category::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalCategories', 
            'totalNews', 
            'chartLabels', 
            'chartData',
            'recentCategories'
        ));
    }
}