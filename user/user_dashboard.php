<?php

session_start();
include '../koneksi.php';

// cek login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

$userId   = $_SESSION['user_id'];
$username = $_SESSION['username'];

// contoh query: hitung jumlah wisata & akses
$total_wisata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as jml FROM wisata"))['jml'];
$total_akses  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as jml FROM akses"))['jml'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body>

<main class="container my-5">
  <h2 class="mb-4">Dashboard User</h2>
  <a href="../index.php" class="btn btn-secondary btn-sm">← Kembali</a>

  <div class="row g-4">
    <!-- Card Info Akun -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body text-center">
          <h5 class="card-title">Halo, <?= htmlspecialchars($username) ?></h5>
          <p class="card-text">Selamat datang di dashboard akunmu. Dari sini kamu bisa mengelola data dan menjelajahi informasi wisata.</p>
          <a href="user_edit.php" class="btn btn-outline-primary btn-sm">Kelola Akun</a>
        </div>
      </div>
    </div>

    <!-- Card Jumlah Wisata -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100 text-center">
        <div class="card-body">
          <h5 class="card-title">Jumlah Wisata</h5>
          <p class="display-6"><?= $total_wisata ?></p>
          <p class="text-muted">Total data wisata yang tersedia</p>
          <a href="../wisata.php" class="btn btn-outline-success btn-sm">Lihat Wisata</a>
        </div>
      </div>
    </div>

    <!-- Card Jumlah Akses -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100 text-center">
        <div class="card-body">
          <h5 class="card-title">Informasi Akses</h5>
          <p class="display-6"><?= $total_akses ?></p>
          <p class="text-muted">Total jalur/akses yang tercatat</p>
          <a href="../akses.php" class="btn btn-outline-warning btn-sm">Lihat Akses</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Seksi rekomendasi / quick link -->
  <div class="mt-5">
    <h4>Rekomendasi untukmu</h4>
    <p>Telusuri provinsi dan destinasi wisata pilihan:</p>
    <a href="../index.php#daerah" class="btn btn-primary">Pilih Provinsi</a>
  </div>
</main>

</body>
</html>
