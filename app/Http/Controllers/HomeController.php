<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Halaman utama (daftar semua berita)
     */
    public function index()
    {
        // Ambil berita yang statusnya publish, urutkan terbaru, 9 per halaman
        $latestNews = News::with('category')
            ->where('status', 'published')
            ->latest()
            ->paginate(9);
        
        // Ambil semua kategori untuk sidebar
        $categories = Category::all();
        
        return view('home.index', compact('latestNews', 'categories'));
    }

    /**
     * Halaman detail berita
     */
    public function show($slug)
    {
        // Cari berita berdasarkan slug
        $news = News::with('category')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        
        // Tambah jumlah dilihat
        $news->increment('views');
        
        // Berita terkait (kategori sama)
        $relatedNews = News::with('category')
            ->where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->where('status', 'published')
            ->latest()
            ->take(4)
            ->get();
        
        return view('home.show', compact('news', 'relatedNews'));
    }

    /**
     * Halaman berita berdasarkan kategori
     */
    public function category($slug)
    {
        // Cari kategori berdasarkan slug
        $category = Category::where('slug', $slug)->firstOrFail();
        
        // Ambil berita dalam kategori ini
        $news = News::with('category')
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(9);
        
        // Ambil semua kategori untuk sidebar
        $categories = Category::all();
        
        return view('home.category', compact('category', 'news', 'categories'));
    }
}