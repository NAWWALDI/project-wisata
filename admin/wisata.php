<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM wisata ORDER BY id_wisata DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Wisata</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .table-wrapper {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .card-wisata {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: transform 0.2s;
    }
    .card-wisata:hover {
      transform: translateY(-5px);
    }
    .card-img-top {
      height: 200px;
      object-fit: cover;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }
    .img-thumb {
      width: 100px;
      border-radius: 8px;
      object-fit: cover;
    }
  </style>
</head>
<body class="container my-4">
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">Kelola Data Wisata</h2>
    <div>
      <button id="toggleView" class="btn btn-outline-primary me-2">🔄 Ganti Tampilan</button>
      <a href="dashboard.php" class="btn btn-outline-secondary me-2">← Kembali</a>
      <a href="tambah_wisata.php" class="btn btn-primary">+ Tambah Wisata</a>
    </div>
  </div>

  <!-- Tabel View -->
  <div id="tableView" class="table-wrapper">
    <table class="table table-hover align-middle">
      <thead class="table-primary text-center">
        <tr>
          <th style="width: 60px;">ID</th>
          <th>Nama Tempat</th>
          <th>Jenis</th>
          <th>Lokasi</th>
          <th style="width: 35%;">Deskripsi</th>
          <th>Foto</th>
          <th style="width: 150px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php mysqli_data_seek($query, 0); while($row = mysqli_fetch_assoc($query)): ?>
        <tr>
          <td class="text-center"><?= $row['id_wisata'] ?></td>
          <td><strong><?= $row['nama_tempat'] ?></strong></td>
          <td><?= $row['jenis_wisata'] ?></td>
          <td><?= $row['lokasi'] ?></td>
          <td class="text-muted"><?= substr($row['deskripsi'], 0, 100) ?>...</td>
          <td class="text-center">
            <img src="../assets/img/wisata/<?= $row['foto'] ?>" class="img-thumb">
          </td>
          <td class="text-center">
            <a href="edit_wisata.php?id=<?= $row['id_wisata'] ?>" class="btn btn-sm btn-warning me-1">✏ Edit</a>
            <a href="hapus.php?id=<?= $row['id_wisata'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">🗑 Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- Card View -->
  <div id="cardView" class="row g-4 d-none">
    <?php mysqli_data_seek($query, 0); while($row = mysqli_fetch_assoc($query)): ?>
    <div class="col-md-4">
      <div class="card card-wisata h-100">
        <img src="../assets/img/wisata/<?= $row['foto'] ?>" class="card-img-top" alt="<?= $row['nama_tempat'] ?>">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title"><?= $row['nama_tempat'] ?></h5>
          <span class="badge bg-primary mb-2"><?= $row['jenis_wisata'] ?></span>
          <p class="mb-1"><strong>Lokasi:</strong> <?= $row['lokasi'] ?></p>
          <p class="text-muted"><?= substr($row['deskripsi'], 0, 120) ?>...</p>
          <div class="mt-auto">
            <a href="edit_wisata.php?id=<?= $row['id_wisata'] ?>" class="btn btn-sm btn-warning me-2">✏ Edit</a>
            <a href="hapus.php?id=<?= $row['id_wisata'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">🗑 Hapus</a>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>

  <script>
    const toggleBtn = document.getElementById("toggleView");
    const tableView = document.getElementById("tableView");
    const cardView  = document.getElementById("cardView");

    toggleBtn.addEventListener("click", () => {
      tableView.classList.toggle("d-none");
      cardView.classList.toggle("d-none");
    });
  </script>
</body>
</html>
