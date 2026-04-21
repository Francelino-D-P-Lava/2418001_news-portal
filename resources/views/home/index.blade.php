@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- KOLOM KIRI: DAFTAR BERITA -->
        <div class="col-lg-8">
            <h3 class="mb-4"><i class="fas fa-clock me-2"></i> Berita Terbaru</h3>
            
            @if($latestNews->count() > 0)
                <div class="row">
                    @foreach($latestNews as $news)
                    <div class="col-md-6 mb-4">
                        <div class="news-card">
                            @if($news->image)
                                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
                            @else
                                <img src="https://via.placeholder.com/400x180?text=No+Image" alt="No Image">
                            @endif
                            <div class="card-body">
                                <span class="badge-category mb-2 d-inline-block">
                                    {{ $news->category->name ?? 'Umum' }}
                                </span>
                                <h5 class="card-title">{{ Str::limit($news->title, 50) }}</h5>
                                <p class="card-text text-muted small">
                                    <i class="fas fa-calendar-alt me-1"></i> {{ $news->created_at->format('d M Y') }}
                                    <i class="fas fa-eye ms-2 me-1"></i> {{ number_format($news->views) }}
                                </p>
                                <p class="card-text">{{ Str::limit(strip_tags($news->content), 100) }}</p>
                                <a href="{{ route('berita.show', $news->slug) }}" class="btn-read">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-4">
                    {{ $latestNews->links() }}
                </div>
            @else
                <div class="alert alert-info">Belum ada berita. Silakan cek lagi nanti.</div>
            @endif
        </div>

        <!-- KOLOM KANAN: SIDEBAR -->
        <div class="col-lg-4">
            <div class="sidebar-card">
                <div class="card-header">
                    <i class="fas fa-tags me-2"></i> Kategori Berita
                </div>
                <div class="card-body">
                    <ul class="category-list">
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('berita.category', $cat->slug) }}">
                                <i class="fas fa-folder me-2"></i> {{ $cat->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <div class="sidebar-card">
                <div class="card-header">
                    <i class="fas fa-info-circle me-2"></i> Tentang Kami
                </div>
                <div class="card-body">
                    <p class="small mb-0">Portal Berita adalah platform berita terpercaya yang menyajikan informasi terkini dan terakurat dari berbagai sumber.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection