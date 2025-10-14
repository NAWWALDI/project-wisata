<?php
include "../koneksi.php";

$id = $_GET['id'] ?? 0;

// Ambil data akses berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM akses WHERE id_akses = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
  echo "<script>alert('Data tidak ditemukan!'); window.location='akses.php';</script>";
  exit;
}

// Ambil data wisata untuk dropdown
$wisata = mysqli_query($conn, "SELECT * FROM wisata ORDER BY nama_tempat ASC");

// Update data jika form disubmit
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

  $rute = $rute_asal . " → " . $rute_tujuan;

  mysqli_query($conn, "UPDATE akses SET
    nama_akses = '$nama_akses',
    jenis_akses = '$jenis_akses',
    lokasi = '$lokasi',
    rute = '$rute',
    jarak_tempuh = '$jarak_tempuh',
    durasi = '$durasi',
    kondisi_jalan = '$kondisi_jalan',
    transportasi_disarankan = '$transportasi_disarankan',
    maps_link = '$maps_link',
    id_wisata = '$id_wisata'
    WHERE id_akses = $id
  ");

  header("Location: akses.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Akses Wisata</title>
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
    }
    label {
      font-weight: 500;
      margin-bottom: 6px;
    }
    .form-control, .form-select {
      border-radius: 10px;
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
        Edit Akses Wisata
      </div>

      <div class="card-body">
        <form method="POST">
          <div class="row g-4">

            <!-- Nama Akses -->
            <div class="col-md-6">
              <label class="form-label">Nama Akses</label>
              <input type="text" name="nama_akses" class="form-control" required
                     value="<?= htmlspecialchars($data['nama_akses']) ?>">
            </div>

            <!-- Jenis Akses -->
            <div class="col-md-6">
              <label class="form-label">Jenis Akses</label>
              <select name="jenis_akses" class="form-select" required>
                <?php
                $opsi = ["Pesawat", "Kapal", "Kereta", "Bus", "Mobil", "Motor"];
                foreach ($opsi as $o) {
                  $selected = ($data['jenis_akses'] == $o) ? 'selected' : '';
                  echo "<option value='$o' $selected>$o</option>";
                }
                ?>
              </select>
            </div>

            <!-- Lokasi -->
            <div class="col-md-6">
              <label class="form-label">Lokasi</label>
              <input type="text" name="lokasi" class="form-control" required
                     value="<?= htmlspecialchars($data['lokasi']) ?>">
            </div>

            <!-- Rute -->
            <?php
              $rute_parts = explode(" → ", $data['rute']);
              $rute_asal = $rute_parts[0] ?? '';
              $rute_tujuan = $rute_parts[1] ?? '';
            ?>
            <div class="col-md-3">
              <label class="form-label">Rute Asal</label>
              <input type="text" name="rute_asal" class="form-control" value="<?= htmlspecialchars($rute_asal) ?>">
            </div>
            <div class="col-md-3">
              <label class="form-label">Rute Tujuan</label>
              <input type="text" name="rute_tujuan" class="form-control" value="<?= htmlspecialchars($rute_tujuan) ?>">
            </div>

            <!-- Jarak & Durasi -->
            <div class="col-md-3">
              <label class="form-label">Jarak Tempuh</label>
              <input type="text" name="jarak_tempuh" class="form-control" value="<?= htmlspecialchars($data['jarak_tempuh']) ?>">
            </div>
            <div class="col-md-3">
              <label class="form-label">Durasi Perjalanan</label>
              <input type="text" name="durasi" class="form-control" value="<?= htmlspecialchars($data['durasi']) ?>">
            </div>

            <!-- Kondisi Jalan -->
            <div class="col-md-6">
              <label class="form-label">Kondisi Jalan</label>
              <input type="text" name="kondisi_jalan" class="form-control" value="<?= htmlspecialchars($data['kondisi_jalan']) ?>">
            </div>

            <!-- Transportasi -->
            <div class="col-md-6">
              <label class="form-label">Transportasi Disarankan</label>
              <input type="text" name="transportasi_disarankan" class="form-control"
                     value="<?= htmlspecialchars($data['transportasi_disarankan']) ?>">
            </div>

            <!-- Google Maps -->
            <div class="col-md-12">
              <label class="form-label">Link Google Maps (Opsional)</label>
              <input type="url" name="maps_link" class="form-control" value="<?= htmlspecialchars($data['maps_link']) ?>">
            </div>

            <!-- Terkait Wisata -->
            <div class="col-md-6">
              <label class="form-label">Terkait Wisata</label>
              <select name="id_wisata" class="form-select" required>
                <?php while ($w = mysqli_fetch_assoc($wisata)) { ?>
                  <option value="<?= $w['id_wisata'] ?>" <?= ($data['id_wisata'] == $w['id_wisata']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($w['nama_tempat']) ?>
                  </option>
                <?php } ?>
              </select>
            </div>

          </div>

          <div class="d-flex justify-content-between mt-4">
            <a href="akses.php" class="btn btn-secondary">← Kembali</a>
            <button type="submit" class="btn btn-primary">💾 Update</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</body>
</html>
