<?php 
include 'koneksi.php';
$id = $_GET['id'] ?? 0;
$query = mysqli_query($conn, "SELECT * FROM akses WHERE id_akses='$id'");
$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akses Wisata</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2>Detail Akses Wisata</h2>
  <?php if($data): ?>
  <table class="table table-striped mt-3">
    <tr><th>Nama Akses</th><td><?= $data['nama_akses']; ?></td></tr>
    <tr><th>Jenis</th><td><?= $data['jenis_akses']; ?></td></tr>
    <tr><th>Lokasi</th><td><?= $data['lokasi']; ?></td></tr>
    <tr><th>Operator</th><td><?= $data['operator']; ?></td></tr>
    <tr><th>Rute</th><td><?= $data['rute']; ?></td></tr>
    <tr><th>Transportasi</th><td><?= $data['transportasi_darat']; ?></td></tr>
  </table>
  <?php else: ?>
    <p>Tidak ada data akses.</p>
  <?php endif; ?>
  <a href="javascript:history.back()" class="btn btn-secondary">← Kembali</a>
</body>
</html>
