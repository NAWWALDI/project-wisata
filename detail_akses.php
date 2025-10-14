<?php
include "koneksi.php";
$id = $_GET['id'] ?? 0;

// Ambil data wisata untuk judul halaman
$wisata = mysqli_query($conn, "SELECT nama_tempat FROM wisata WHERE id_wisata=$id");
$w = mysqli_fetch_assoc($wisata);

// Ambil data akses terkait wisata ini
$query = mysqli_query($conn, "SELECT * FROM akses WHERE id_wisata=$id");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akses Wisata: <?= htmlspecialchars($w['nama_tempat']); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8fafc;
      font-family: "Poppins", sans-serif;
    }

    h2 {
      font-weight: 700;
      color: #0056d2;
    }

    .card {
      border-radius: 16px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      transition: 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .icon {
      font-size: 2.3rem;
      color: #0d6efd;
    }

    .info p {
      margin-bottom: 6px;
    }

    .badge-akses {
      background-color: #0d6efd;
      font-size: 0.8rem;
      border-radius: 6px;
      padding: 4px 8px;
      color: #fff;
    }

    .btn-maps {
      background: #0d6efd;
      color: white;
      border-radius: 10px;
      padding: 6px 12px;
      font-weight: 500;
    }

    .btn-maps:hover {
      background: #0a4db5;
      color: #fff;
    }
  </style>
</head>
<body class="container py-5">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Akses Wisata: <?= htmlspecialchars($w['nama_tempat']); ?></h2>
    <a href="javascript:history.back()" class="btn btn-outline-secondary">← Kembali</a>
  </div>

  <?php if (mysqli_num_rows($query) > 0): ?>
    <div class="row g-4">
      <?php while($row = mysqli_fetch_assoc($query)) { ?>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 p-3">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <?php
                  // Ikon otomatis berdasarkan jenis akses
                  $icon = "bi-geo-alt-fill";
                  $jenis = strtolower($row['jenis_akses']);
                  if (str_contains($jenis, 'pesawat')) $icon = "bi-airplane";
                  elseif (str_contains($jenis, 'kapal')) $icon = "bi-ship";
                  elseif (str_contains($jenis, 'kereta')) $icon = "bi-train-front";
                  elseif (str_contains($jenis, 'bis') || str_contains($jenis, 'bus')) $icon = "bi-bus-front";
                  elseif (str_contains($jenis, 'mobil') || str_contains($jenis, 'motor')) $icon = "bi-car-front";
                ?>
                <i class="bi <?= $icon ?> icon me-3"></i>
                <div>
                  <h5 class="mb-0 fw-semibold"><?= htmlspecialchars($row['nama_akses']); ?></h5>
                  <span class="badge-akses"><?= htmlspecialchars($row['jenis_akses']); ?></span>
                </div>
              </div>

              <div class="info">
                <?php if (!empty($row['lokasi'])): ?>
                  <p><i class="bi bi-geo-alt text-primary"></i> <strong>Lokasi:</strong> <?= htmlspecialchars($row['lokasi']); ?></p>
                <?php endif; ?>

                <?php if (!empty($row['rute'])): ?>
                  <p><i class="bi bi-signpost-split text-primary"></i> <strong>Rute:</strong> <?= htmlspecialchars($row['rute']); ?></p>
                <?php endif; ?>

                <?php if (!empty($row['jarak_tempuh'])): ?>
                  <p><i class="bi bi-rulers text-primary"></i> <strong>Jarak:</strong> <?= htmlspecialchars($row['jarak_tempuh']); ?></p>
                <?php endif; ?>

                <?php if (!empty($row['durasi'])): ?>
                  <p><i class="bi bi-clock text-primary"></i> <strong>Durasi:</strong> <?= htmlspecialchars($row['durasi']); ?></p>
                <?php endif; ?>

                <?php if (!empty($row['kondisi_jalan'])): ?>
                  <p><i class="bi bi-cone-striped text-primary"></i> <strong>Kondisi Jalan:</strong> <?= htmlspecialchars($row['kondisi_jalan']); ?></p>
                <?php endif; ?>

                <?php if (!empty($row['transportasi_disarankan'])): ?>
                  <p><i class="bi bi-bus-front text-primary"></i> <strong>Transportasi Disarankan:</strong> <?= htmlspecialchars($row['transportasi_disarankan']); ?></p>
                <?php endif; ?>

                <?php if (!empty($row['tips_perjalanan'])): ?>
                  <p><i class="bi bi-lightbulb text-primary"></i> <strong>Tips:</strong> <?= htmlspecialchars($row['tips_perjalanan']); ?></p>
                <?php endif; ?>
              </div>

              <div class="mt-3 d-flex justify-content-between">
                <?php if (!empty($row['maps_link'])): ?>
                  <a href="<?= htmlspecialchars($row['maps_link']); ?>" target="_blank" class="btn btn-maps btn-sm">
                    <i class="bi bi-map"></i> Lihat Maps
                  </a>
                <?php endif; ?>
                <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm">Kembali</a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php else: ?>
    <div class="alert alert-warning text-center mt-5">
      Belum ada data akses untuk wisata ini.
    </div>
  <?php endif; ?>

</body>
</html>
