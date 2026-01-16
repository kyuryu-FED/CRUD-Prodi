<?php
session_start();

if (!isset($_SESSION['pengguna']) || $_SESSION['pengguna'] !== true) {
    header("Location: login/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Selamat Datang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4" data-bs-theme="dark">
    <div class="container-fluid">

        <a class="navbar-brand px-5" href="selamat_datang.php">Akademik</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto px-5 d-flex gap-3 align-items-center">

                <a class="nav-link active" href="prodi/index_data_mahasiswa.php">Home</a>

                <!-- Dropdown Mahasiswa -->
                <div class="nav-item dropdown" data-bs-theme="dark">
                    <button class="btn btn-secondary dropdown-toggle px-4"
                            type="button"
                            data-bs-toggle="dropdown">
                        Mahasiswa
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="create.php">Daftar Mahasiswa</a></li>
                        <li><a class="dropdown-item" href="index.php">Tambah Mahasiswa</a></li>
                    </ul>
                </div>

                <!-- Dropdown Prodi -->
                <div class="nav-item dropdown" data-bs-theme="dark">
                    <button class="btn btn-secondary dropdown-toggle px-4"
                            type="button"
                            data-bs-toggle="dropdown">
                        Prodi
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href=prodi/data_prodi.php">Daftar Prodi</a></li>
                        <li><a class="dropdown-item" href="prodi/create_prodi.php">Tambah Prodi</a></li>
                    </ul>
                </div>

                <!-- Login / Profile -->
                <a class="nav-link active" href="login/sudah_login.php">Login</a>
                <a class="nav-link active" href="login/profile.php">Profile</a>
                <a class="nav-link text-danger" href="login/logout.php">Logout</a>

            </div>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-5">
    <div class="bg-white p-4 rounded shadow-sm">

        <h3 class="mb-3 fw-bold">
            Selamat Datang,
            <span class="">
                <?= htmlspecialchars($_SESSION['nama']) ?> 👋
            </span>
            
        </h3>
        <p>
          Ini adalah Website Akademik
        </p>
    </div>
</div>

</body>
</html>
