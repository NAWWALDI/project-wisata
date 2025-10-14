<?php
include "koneksi.php";
$id = $_GET['id'] ?? 0;

// Ambil data wisata
$query = mysqli_query($conn, "SELECT * FROM wisata WHERE id_wisata=$id");
$data = mysqli_fetch_assoc($query);

// Ambil galeri tambahan
$galeri = mysqli_query($conn, "SELECT * FROM galeri WHERE id_wisata=$id");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?php echo $data['nama_tempat']; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: #f7f9fc;
      color: #333;
      font-family: "Poppins", sans-serif;
    }

    .wisata-container {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.08);
      padding: 40px;
      margin-top: 50px;
    }

    h2 {
      font-weight: 700;
      color: #007bff;
      margin-bottom: 10px;
    }

    .badge {
      background: #16badb;
      font-size: 0.85rem;
      padding: 6px 10px;
      border-radius: 8px;
    }

    .carousel-inner img {
      height: 420px;
      object-fit: cover;
      border-radius: 12px;
    }

    .btn-custom {
      border-radius: 10px;
      padding: 8px 16px;
      font-weight: 500;
    }

    .deskripsi-scroll {
      max-height: 250px; /* Batas tinggi area teks */
      overflow-y: auto; /* Aktifkan scroll */
      text-align: justify;
      line-height: 1.7;
      padding-right: 10px;
    }

    .deskripsi-scroll::-webkit-scrollbar {
      width: 8px;
    }

    .deskripsi-scroll::-webkit-scrollbar-thumb {
      background: #ccc;
      border-radius: 10px;
    }

    .gallery img {
      height: 180px;
      width: 100%;
      object-fit: cover;
      border-radius: 12px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery img:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      cursor: pointer;
    }
  </style>
</head>
<body class="container">

  <!-- KONTEN DETAIL -->
  <div class="wisata-container">
    <div class="row align-items-start g-4">
      <!-- Gambar Kanan -->
      <div class="col-lg-6 order-lg-2">
        <div id="carouselWisata" class="carousel slide shadow-sm" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="assets/img/wisata/<?php echo $data['foto']; ?>" class="d-block w-100" alt="<?php echo $data['nama_tempat']; ?>">
            </div>
            <?php while($g = mysqli_fetch_assoc($galeri)) { ?>
              <div class="carousel-item">
                <img src="assets/img/detail_wisata/<?php echo $g['foto']; ?>" class="d-block w-100" alt="">
              </div>
            <?php } ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselWisata" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselWisata" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </div>

      <!-- Deskripsi Kiri -->
      <div class="col-lg-6 order-lg-1">
        <h2><?php echo $data['nama_tempat']; ?></h2>
        <p><span class="badge"><?php echo $data['jenis_wisata']; ?></span></p>
        <p class="text-muted mb-2">
          <i class="bi bi-geo-alt-fill"></i> <?php echo $data['lokasi']; ?>
        </p>

        <div class="deskripsi-scroll mb-3">
          <?php echo nl2br($data['deskripsi']); ?>
        </div>

        <div class="mt-3">
          <a href="detail_akses.php?id=<?php echo $data['id_wisata']; ?>" class="btn btn-primary btn-custom me-2">
            <i class="bi bi-map"></i> Lihat Akses
          </a>
          <a href="javascript:history.back()" class="btn btn-outline-secondary btn-custom">
            ← Kembali
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- GALERI TAMBAHAN -->
  <div class="mt-5">
    <h4 class="text-center fw-semibold mb-4">Galeri Tambahan <?php echo $data['nama_tempat']; ?></h4>
    <div class="row g-3 gallery">
      <?php
      $galeri2 = mysqli_query($conn, "SELECT * FROM galeri WHERE id_wisata=$id");
      if (mysqli_num_rows($galeri2) > 0):
        while($g2 = mysqli_fetch_assoc($galeri2)) { ?>
          <div class="col-6 col-md-4 col-lg-3">
            <img src="assets/img/detail_wisata/<?php echo $g2['foto']; ?>" 
                 class="img-fluid shadow-sm" 
                 data-bs-toggle="modal" 
                 data-bs-target="#modalFoto" 
                 onclick="tampilkanFoto('assets/img/detail_wisata/<?php echo $g2['foto']; ?>')">
          </div>
      <?php } else: ?>
        <p class="text-center text-muted">Belum ada foto tambahan di galeri ini.</p>
      <?php endif; ?>
    </div>
  </div>

  <!-- MODAL FOTO -->
  <div class="modal fade" id="modalFoto" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content bg-dark">
        <div class="modal-body p-0">
          <img id="fotoPreview" src="" class="w-100 rounded">
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function tampilkanFoto(src) {
      document.getElementById('fotoPreview').src = src;
    }
  </script>

</body>
</html>
