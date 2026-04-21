@extends('layouts.public')

@section('title', $category->name)

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Kolom Kiri: Daftar Berita -->
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">{{ $category->name }}</li>
                </ol>
            </nav>
            
            <h3 class="mb-4">
                <i class="fas fa-folder me-2"></i> Kategori: {{ $category->name }}
            </h3>
            
            @if($news->count() > 0)
                @foreach($news as $item)
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded-start" style="height: 150px; width: 100%; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/300x150?text=No+Image" class="img-fluid rounded-start">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit($item->title, 60) }}</h5>
                                <p class="card-text text-muted small">
                                    <i class="fas fa-calendar-alt me-1"></i> {{ $item->created_at->format('d M Y, H:i') }}
                                    <i class="fas fa-eye ms-2 me-1"></i> {{ number_format($item->views) }}
                                </p>
                                <p class="card-text">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                                <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-sm btn-primary">Baca Selengkapnya →</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $news->links() }}
                </div>
            @else
                <div class="alert alert-info">Belum ada berita dalam kategori {{ $category->name }}.</div>
            @endif
        </div>
        
        <!-- Kolom Kanan: Sidebar -->
        <div class="col-lg-4">
            <div class="sidebar-card">
                <div class="card-header">
                    <i class="fas fa-tags me-2"></i> Kategori Lainnya
                </div>
                <div class="card-body">
                    <ul class="category-list">
                        @foreach($categories->where('id', '!=', $category->id) as $cat)
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