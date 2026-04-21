<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * GET /api/categories - Menampilkan semua kategori
     */
    public function index()
    {
        $categories = Category::all();
        
        return response()->json([
            'success' => true,
            'message' => 'Data kategori berhasil diambil',
            'data' => $categories
        ], 200);
    }

    /**
     * GET /api/categories/{slug} - Menampilkan detail kategori + beritanya
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }
        
        $news = $category->news()
            ->where('status', 'published')
            ->latest()
            ->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Detail kategori berhasil diambil',
            'data' => [
                'category' => $category,
                'news' => $news
            ]
        ], 200);
    }
}