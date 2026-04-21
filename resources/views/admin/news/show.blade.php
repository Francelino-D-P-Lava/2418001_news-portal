<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Detail Berita</h1>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="card">
            <div class="card-body">
                <h2>{{ $news->title }}</h2>
                <div class="text-muted mb-3">
                    <small>Kategori: {{ $news->category->name ?? '-' }}</small> |
                    <small>Status: <span class="badge bg-{{ $news->status == 'published' ? 'success' : 'warning' }}">{{ $news->status }}</span></small> |
                    <small>Views: {{ $news->views }}</small> |
                    <small>Dibuat: {{ $news->created_at->format('d/m/Y H:i') }}</small>
                </div>

                @if($news->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $news->image) }}" class="img-fluid" alt="{{ $news->title }}">
                    </div>
                @endif

                <div class="mt-3">
                    {!! $news->content !!}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>