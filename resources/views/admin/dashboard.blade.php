<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
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
        .sidebar .brand p {
            font-size: 12px;
            opacity: 0.8;
            margin-top: 5px;
        }
        .sidebar .nav-menu {
            list-style: none;
            padding: 0;
        }
        .sidebar .nav-menu li {
            margin: 5px 15px;
            border-radius: 12px;
            transition: 0.3s;
        }
        .sidebar .nav-menu li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 500;
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
        /* CARD STATISTIK */
        .stat-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card .card-body {
            padding: 25px;
        }
        .stat-card h2 {
            font-size: 36px;
            font-weight: bold;
            margin: 10px 0 0;
        }
        .bg-purple {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .bg-green {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }
        /* TABEL */
        .table-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .table-card .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            padding: 15px 20px;
            font-weight: 600;
        }
        .table-card table {
            margin-bottom: 0;
        }
        .table-card th {
            background-color: #f8f9fa;
            padding: 12px 15px;
        }
        .table-card td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        .btn-edit {
            background: #ffc107;
            color: #856404;
            border: none;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
        }
        .btn-edit:hover {
            background: #e0a800;
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
            <li class="active">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.news.index') }}">
                    <i class="fas fa-newspaper"></i> Berita
                </a>
            </li>
            <li>
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
        <!-- STATISTIK -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card stat-card bg-purple">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 opacity-75">Total Berita</p>
                                <h2>{{ $totalNews }}</h2>
                            </div>
                            <i class="fas fa-newspaper fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card stat-card bg-green">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 opacity-75">Total Kategori</p>
                                <h2>{{ $totalCategories }}</h2>
                            </div>
                            <i class="fas fa-tags fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABEL KATEGORI TERBARU -->
        <div class="card table-card">
            <div class="card-header">
                <i class="fas fa-list me-2"></i> Kategori Terbaru
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentCategories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn-edit">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada kategori</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>