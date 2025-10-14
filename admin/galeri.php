<?php
session_start();
include "../koneksi.php";

$query = "SELECT g.*, w.nama_tempat 
          FROM galeri g 
          JOIN wisata w ON g.id_wisata = w.id_wisata 
          ORDER BY g.tanggal DESC";
$galeri = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Galeri</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>Data Galeri Wisata</h3>
      <a href="tambah_galeri.php" class="btn btn-primary">+ Tambah Foto</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success">Foto berhasil ditambahkan!</div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Wisata</th>
          <th>Foto</th>
          <th>Keterangan</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $no=1; 
        while($row = mysqli_fetch_assoc($galeri)) { ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_tempat']; ?></td>
            <td><img src="../assets/img/detail_wisata/<?= $row['foto']; ?>" width="120"></td>
            <td><?= $row['keterangan']; ?></td>
            <td><?= $row['tanggal']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
