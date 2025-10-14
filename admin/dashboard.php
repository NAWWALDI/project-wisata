<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Hitung data
$jmlWisata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM wisata"))['total'];
$jmlUser   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM user"))['total'];
$jmlAkses  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM akses"))['total'];

// Ucapan waktu
date_default_timezone_set('Asia/Jakarta');
$hour = date('H');
if ($hour < 12) $ucapan = "Selamat Pagi ";
elseif ($hour < 18) $ucapan = "Selamat Sore ";
else $ucapan = "Selamat Malam ";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: #f8faff;
      font-family: "Poppins", sans-serif;
    }
    .header {
      background: linear-gradient(90deg, #007bff, #0056d6);
      color: white;
      padding: 25px;
      border-radius: 0 0 20px 20px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .card-stat {
      border: none;
      border-radius: 18px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      transition: transform 0.2s;
    }
    .card-stat:hover {
      transform: translateY(-5px);
    }
    .icon-large {
      font-size: 2.5rem;
      color: #007bff;
    }
    .quick-btn {
      border-radius: 12px;
      font-weight: 500;
      transition: 0.3s;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .quick-btn:hover {
      transform: scale(1.05);
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header text-center mb-5">
    <h2 class="fw-bold">Dashboard Admin</h2>
    <p class="mb-0"><?= $ucapan ?>, Admin!</p>
  </div>

  <div class="container">
    <!-- Statistik -->
    <div class="row g-4 mb-5">
      <div class="col-md-4">
        <div class="card card-stat text-center p-4">
          <i class="bi bi-map icon-large mb-2"></i>
          <h4 class="fw-bold"><?= $jmlWisata ?></h4>
          <p class="text-muted mb-0">Total Wisata</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-stat text-center p-4">
          <i class="bi bi-people icon-large mb-2"></i>
          <h4 class="fw-bold"><?= $jmlUser ?></h4>
          <p class="text-muted mb-0">Total User</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-stat text-center p-4">
          <i class="bi bi-signpost-split icon-large mb-2"></i>
          <h4 class="fw-bold"><?= $jmlAkses ?></h4>
          <p class="text-muted mb-0">Total Akses Wisata</p>
        </div>
      </div>
    </div>

    <!-- Navigasi Cepat -->
    <div class="text-center">
      <h5 class="fw-semibold mb-3 text-primary">Navigasi Cepat</h5>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="wisata.php" class="btn btn-primary btn-lg quick-btn">
          <i class="bi bi-map me-2"></i>Kelola Wisata
        </a>
        <a href="tambah_wisata.php" class="btn btn-success btn-lg quick-btn">
          <i class="bi bi-plus-circle me-2"></i>Tambah Wisata
        </a>
        <a href="akses.php" class="btn btn-info btn-lg text-white quick-btn">
          <i class="bi bi-signpost me-2"></i>Kelola Akses
        </a>
        <a href="users.php" class="btn btn-warning btn-lg text-dark quick-btn">
          <i class="bi bi-people-fill me-2"></i>Kelola User
        </a>
        <a href="../logout.php" class="btn btn-danger btn-lg quick-btn">
          <i class="bi bi-box-arrow-right me-2"></i>Logout
        </a>
      </div>
    </div>
  </div>

</body>
</html>
