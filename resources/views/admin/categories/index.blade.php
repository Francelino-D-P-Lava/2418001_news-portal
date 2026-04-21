<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* SIDEBAR KIRI */
        .sidebar {
            width: 280px;
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding: 30px 0;
        }
        .sidebar .brand {
            text-align: center;
            padding: 0 20px 30px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 30px;
        }
        .sidebar .brand h3 {
            font-size: 22px;
            font-weight: bold;
        }
        .sidebar .nav-menu {
            list-style: none;
            padding: 0;
        }
        .sidebar .nav-menu li {
            margin: 5px 15px;
            border-radius: 12px;
        }
        .sidebar .nav-menu li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            border-radius: 12px;
        }
        .sidebar .nav-menu li:hover {
            background: rgba(255,255,255,0.2);
        }
        .sidebar .nav-menu li.active {
            background: rgba(255,255,255,0.3);
        }
        .sidebar .nav-menu li.logout {
            margin-top: 50px;
        }
        /* KONTEN UTAMA */
        .main-content {
            margin-left: 280px;
            padding: 25px;
        }
        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .content-card .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-add {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
        }
        .btn-edit {
            background: #ffc107;
            color: #856404;
            border: none;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
        }
        .pagination {
            justify-content: center;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR KIRI -->
    <div class="sidebar">
        <div class="brand">
            <h3><i class="fas fa-newspaper me-2"></i> Portal Berita</h3>
            <p>Admin Panel</p>
        </div>
        <ul class="nav-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.news.index') }}">
                    <i class="fas fa-newspaper"></i> Berita
                </a>
            </li>
            <li class="active">
                <a href="{{ route('categories.index') }}">
                    <i class="fas fa-tags"></i> Kategori
                </a>
            </li>
            <li>
                <!-- HOME TANPA target="_blank" -->
                <a href="{{ route('home') }}">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li class="logout">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="main-content">
        <div class="content-card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-tags me-2"></i> Manajemen Kategori</h5>
                <a href="{{ route('categories.create') }}" class="btn-add">+ Tambah Kategori</a>
            </div>
            <div class="card-body p-0">
                @if(session('success'))
                    <div class="alert alert-success m-3">{{ session('success') }}</div>
                @endif
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ $categories->firstItem() + $key }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn-edit">Edit</a>
                                <button class="btn-delete" onclick="confirmDelete({{ $category->id }})">Hapus</button>
                                <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin hapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>