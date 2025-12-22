<?php
include("../koneksi.php"); // sesuaikan path
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Data Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand px-5" href="index_data_mahasiswa.php">Akademik</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto px-4">

<div class="navbar-nav ms-auto px-5 d-flex gap-3">
  <a class="nav-link active" aria-current="page" href="index_data_mahasiswa.php">Home</a>

  <!-- Dropdown Mahasiswa -->
  <div class="nav-item dropdown" data-bs-theme="dark">
    <button class="btn btn-secondary dropdown-toggle flex-fill px-4"
            type="button"
            id="dropdownMahasiswa"
            data-bs-toggle="dropdown">
      Mahasiswa
    </button>

    <ul class="dropdown-menu dropdown-menu-dark">
      <li><a class="dropdown-item active" href="../create.php">Daftar Mahasiswa</a></li>
      <li><a class="dropdown-item" href="../index.php">Tambah Mahasiswa</a></li>
    </ul>
  </div>

  <!-- Dropdown Prodi -->
  <div class="nav-item dropdown" data-bs-theme="dark">
    <button class="btn btn-secondary dropdown-toggle flex-fill px-4"
            type="button"
            id="dropdownProdi"
            data-bs-toggle="dropdown">
      Prodi
    </button>

    <ul class="dropdown-menu dropdown-menu-dark">
      <li><a class="dropdown-item active" href="data_prodi.php">Daftar Prodi</a></li>
      <li><a class="dropdown-item" href="create_prodi.php">Tambah Prodi</a></li>
    </ul>
  </div>

</div>
      </div>
    </div>
  </div>
</nav>

<!-- CONTENT -->
<div class="container mt-5">
  <div class="bg-white p-4 rounded shadow-sm">
    <h3 class="mb-3 fw-bold">Data Mahasiswa</h3>

    <table class="table table-bordered align-middle text-center">
      <thead class="table-primary">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>NIM</th>
          <th>Tanggal Lahir</th>
          <th>Alamat</th>
          <th>Prodi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
       <tbody>
<?php
$no = 1;
$query = "
    SELECT 
        mahasiswa.id,
        mahasiswa.nim,
        mahasiswa.nama_mhs,
        mahasiswa.tgl_lahir,
        mahasiswa.alamat,
        prodi.nama_prodi,
        prodi.jenjang,
        prodi.keterangan
    FROM mahasiswa
    LEFT JOIN prodi ON mahasiswa.prodi_id = prodi.id
    ORDER BY mahasiswa.id DESC
";


$sql = mysqli_query($db, $query);

while ($data = mysqli_fetch_assoc($sql)) {
?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $data['nama_mhs'] ?></td>
        <td><?= $data['nim'] ?></td>
        <td><?= $data['tgl_lahir'] ?></td>
        <td><?= $data['alamat'] ?></td>
        <td>    <?= 
        ($data['nama_prodi'] ?? '-') . ' ' .
        ($data['jenjang'] ?? '') . ' ' .
        ($data['keterangan'] ?? '')
    ?></td>
        <td>
            <a href="../edit.php?id=<?= $data['id'] ?>" class="btn btn-warning btn-sm">
                Edit
            </a>
            <a href="../delete.php?id=<?= $data['id'] ?>"
               onclick="return confirm('Hapus data?')"
               class="btn btn-danger btn-sm">
                Hapus
            </a>
        </td>
    </tr>
<?php } ?>
</tbody>

      </tbody>
    </table>

  </div>
</div>

</body>
</html>
