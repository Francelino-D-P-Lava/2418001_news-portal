@extends('layouts.public')

@section('title', $news->title)

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Kolom Kiri: Detail Berita -->
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('berita.category', $news->category->slug) }}">{{ $news->category->name }}</a></li>
                    <li class="breadcrumb-item active">{{ Str::limit($news->title, 40) }}</li>
                </ol>
            </nav>
            
            <!-- Card Detail Berita -->
            <div class="detail-card">
                <div class="card-body">
                    <h1 class="h2 mb-3">{{ $news->title }}</h1>
                    
                    <div class="d-flex flex-wrap gap-3 mb-4 text-muted small">
                        <span><i class="fas fa-folder me-1"></i> {{ $news->category->name }}</span>
                        <span><i class="fas fa-calendar-alt me-1"></i> {{ $news->created_at->format('d F Y, H:i') }}</span>
                        <span><i class="fas fa-eye me-1"></i> {{ number_format($news->views) }} kali dibaca</span>
                    </div>
                    
                    @if($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" class="img-fluid rounded mb-4 w-100" alt="{{ $news->title }}" style="max-height: 400px; object-fit: cover;">
                    @endif
                    
                    <div class="news-content">
                        {!! nl2br(e($news->content)) !!}
                    </div>
                </div>
            </div>
            
            <!-- Berita Terkait -->
            @if($relatedNews->count() > 0)
            <div class="mt-5">
                <h4 class="mb-4">Berita Terkait</h4>
                <div class="row">
                    @foreach($relatedNews as $item)
                    <div class="col-md-6 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded-start" style="height: 100px; width: 100%; object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/100x100?text=News" class="img-fluid rounded-start">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body py-2">
                                        <h6 class="card-title small">{{ Str::limit($item->title, 40) }}</h6>
                                        <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
                                        <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-link btn-sm text-primary p-0 d-block mt-1">Baca →</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        
        <!-- Kolom Kanan: Sidebar -->
        <div class="col-lg-4">
            <div class="sidebar-card">
                <div class="card-header">
                    <i class="fas fa-tags me-2"></i> Kategori Berita
                </div>
                <div class="card-body">
                    <ul class="category-list">
                        @foreach(\App\Models\Category::all() as $cat)
                        <li>
                            <a href="{{ route('berita.category', $cat->slug) }}">
                                <i class="fas fa-folder me-2"></i> {{ $cat->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection