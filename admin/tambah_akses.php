<?php
include "../koneksi.php";
$wisata = mysqli_query($conn, "SELECT * FROM wisata ORDER BY nama_tempat ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama_akses = $_POST['nama_akses'];
  $jenis_akses = $_POST['jenis_akses'];
  $lokasi = $_POST['lokasi'];
  $rute_asal = $_POST['rute_asal'];
  $rute_tujuan = $_POST['rute_tujuan'];
  $jarak_tempuh = $_POST['jarak_tempuh'];
  $durasi = $_POST['durasi'];
  $kondisi_jalan = $_POST['kondisi_jalan'];
  $transportasi_disarankan = $_POST['transportasi_disarankan'];
  $maps_link = $_POST['maps_link'];
  $id_wisata = $_POST['id_wisata'];

  if ($id_wisata != '') {
    $rute = $rute_asal . " → " . $rute_tujuan;
    mysqli_query($conn, "INSERT INTO akses 
      (nama_akses, jenis_akses, lokasi, rute, jarak_tempuh, durasi, kondisi_jalan, transportasi_disarankan, maps_link, id_wisata)
      VALUES 
      ('$nama_akses', '$jenis_akses', '$lokasi', '$rute', '$jarak_tempuh', '$durasi', '$kondisi_jalan', '$transportasi_disarankan', '$maps_link', '$id_wisata')");
    header("Location: akses.php");
    exit;
  } else {
    $error = "Pilih wisata terlebih dahulu!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Akses Wisata</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f5f8ff;
      font-family: 'Poppins', sans-serif;
    }
    .card {
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }
    .card-header {
      background: #0d6efd;
      color: white;
      font-weight: 600;
      font-size: 1.2rem;
      letter-spacing: 0.5px;
    }
    label {
      font-weight: 500;
      margin-bottom: 6px;
    }
    .form-control, .form-select {
      border-radius: 10px;
      box-shadow: none;
    }
    .btn-primary {
      background-color: #0d6efd;
      border: none;
      border-radius: 10px;
      padding: 10px 18px;
    }
    .btn-primary:hover {
      background-color: #0b5ed7;
    }
    .btn-secondary {
      border-radius: 10px;
      padding: 10px 18px;
    }
  </style>
</head>

<body class="bg-light">
  <div class="container mt-5 mb-5">
    <div class="card shadow border-0">
      <div class="card-header">
        Tambah Akses Wisata
      </div>

      <div class="card-body">
        <?php if (!empty($error)): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
          <div class="row g-4">

            <!-- Nama Akses -->
            <div class="col-md-6">
              <label class="form-label">Nama Akses</label>
              <input type="text" name="nama_akses" class="form-control" required placeholder="Contoh: Bandara El Tari">
            </div>

            <!-- Jenis Akses -->
            <div class="col-md-6">
              <label class="form-label">Jenis Akses</label>
              <select name="jenis_akses" class="form-select" required>
                <option value="">-- Pilih Jenis Akses --</option>
                <option value="Pesawat">Pesawat</option>
                <option value="Kapal">Kapal</option>
                <option value="Kereta">Kereta</option>
                <option value="Bus">Bus</option>
                <option value="Mobil">Mobil</option>
                <option value="Motor">Motor</option>
              </select>
            </div>

            <!-- Lokasi -->
            <div class="col-md-6">
              <label class="form-label">Lokasi</label>
              <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Kota Kupang, NTT" required>
            </div>

            <!-- Rute -->
            <div class="col-md-3">
              <label class="form-label">Rute Asal</label>
              <input type="text" name="rute_asal" class="form-control" placeholder="Contoh: Kupang">
            </div>
            <div class="col-md-3">
              <label class="form-label">Rute Tujuan</label>
              <input type="text" name="rute_tujuan" class="form-control" placeholder="Contoh: Pantai Lasiana">
            </div>

            <!-- Jarak & Durasi -->
            <div class="col-md-3">
              <label class="form-label">Jarak Tempuh</label>
              <input type="text" name="jarak_tempuh" class="form-control" placeholder="Contoh: 12 km">
            </div>
            <div class="col-md-3">
              <label class="form-label">Durasi Perjalanan</label>
              <input type="text" name="durasi" class="form-control" placeholder="Contoh: 30 menit">
            </div>

            <!-- Kondisi Jalan -->
            <div class="col-md-6">
              <label class="form-label">Kondisi Jalan</label>
              <input type="text" name="kondisi_jalan" class="form-control" placeholder="Contoh: Aspal halus dan mudah dilalui">
            </div>

            <!-- Transportasi Disarankan -->
            <div class="col-md-6">
              <label class="form-label">Transportasi Disarankan</label>
              <input type="text" name="transportasi_disarankan" class="form-control" placeholder="Contoh: Mobil pribadi / ojek online">
            </div>

            <!-- Google Maps -->
            <div class="col-md-12">
              <label class="form-label">Link Google Maps (Opsional)</label>
              <input type="url" name="maps_link" class="form-control" placeholder="https://goo.gl/maps/...">
            </div>

            <!-- Terkait Wisata -->
            <div class="col-md-6">
              <label class="form-label">Terkait Wisata</label>
              <select name="id_wisata" class="form-select" required>
                <option value="">-- Pilih Wisata --</option>
                <?php while ($w = mysqli_fetch_assoc($wisata)) { ?>
                  <option value="<?= $w['id_wisata'] ?>"><?= htmlspecialchars($w['nama_tempat']) ?></option>
                <?php } ?>
              </select>
            </div>

          </div>

          <!-- Tombol -->
          <div class="d-flex justify-content-between mt-4">
            <a href="akses.php" class="btn btn-secondary">← Kembali</a>
            <button type="submit" class="btn btn-primary">💾 Simpan</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</body>
</html>
