<?php include("koneksi.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="p-3 mb-2 bg-light text-dark: container mt-5 ">
      <h2>Daftar Mahasiswa</h2>
      <table class="table table-bordered table-striped align-middle text-center">
        <thead class="table-primary">
    <tr>
      <th scope="col">No</th>
      <th scope="col">NIM</th>
      <th scope="col">Nama</th>
      <th scope="col">Tanggal Lahir</th>
      <th scope="col">Alamat</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>


    <?php
    $no = 1;
    $sql = mysqli_query($db, "SELECT * FROM mahasiswa ORDER BY id DESC");
    while ($data = mysqli_fetch_array($sql)) {
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $data['nim'] ?></td>
        <td><?= $data['nama_mhs'] ?></td>
        <td><?= $data['tgl_lahir'] ?></td>
        <td><?= $data['alamat'] ?></td>
        <td>
            <a href="edit.php?id=<?= $data['id'] ?>" class="btn btn-warning" >Edit</a> |
            <a href="delete.php?id=<?= $data['id'] ?>" onclick="return confirm('Hapus data?')" class="btn btn-danger" >Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>

<br>
<a href="index.php" class="btn btn-primary">Tambah Data</a>
    </div>
</body>
</html>
