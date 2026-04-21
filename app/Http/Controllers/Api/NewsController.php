<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * GET /api/news - Menampilkan semua berita (JSON)
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);
        
        $news = News::with('category')
            ->where('status', 'published')
            ->latest()
            ->paginate($limit);
        
        return response()->json([
            'success' => true,
            'message' => 'Data berita berhasil diambil',
            'data' => $news->items(),
            'pagination' => [
                'current_page' => $news->currentPage(),
                'total' => $news->total(),
                'per_page' => $news->perPage(),
                'last_page' => $news->lastPage(),
            ]
        ], 200);
    }

    /**
     * GET /api/news/{slug} - Menampilkan detail 1 berita
     */
    public function show($slug)
    {
        $news = News::with('category')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->first();
        
        if (!$news) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan'
            ], 404);
        }
        
        // Tambah views
        $news->increment('views');
        
        return response()->json([
            'success' => true,
            'message' => 'Detail berita berhasil diambil',
            'data' => $news
        ], 200);
    }
}