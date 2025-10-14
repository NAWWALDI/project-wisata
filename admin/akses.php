<?php
include "../koneksi.php";
$akses = mysqli_query($conn, "
  SELECT a.*, w.nama_tempat 
  FROM akses a 
  LEFT JOIN wisata w ON a.id_wisata = w.id_wisata 
  ORDER BY a.id_akses DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Data Akses Wisata</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: #f5f8ff;
      font-family: "Poppins", sans-serif;
    }
    .card {
      border-radius: 18px;
      border: none;
      box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    }
    .card h3 {
      font-weight: 700;
      color: #0d6efd;
    }
    table thead th {
      background: #0d6efd;
      color: white;
      text-align: center;
      font-weight: 500;
      vertical-align: middle;
    }
    table tbody td {
      vertical-align: middle;
    }
    .btn-sm {
      font-size: 0.85rem;
      border-radius: 8px;
      padding: 5px 10px;
    }
    .btn-warning {
      color: #fff;
    }
    .table-hover tbody tr:hover {
      background: #f1f6ff;
      transition: 0.2s;
    }
    .modal-confirm {
      border-radius: 15px;
    }
  </style>
</head>
<body>
  <div class="container mt-5 mb-5">
    <div class="card p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Kelola Data Akses Wisata</h3>
        <div>
          <a href="dashboard.php" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
          </a>
          <a href="tambah_akses.php" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Akses
          </a>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th width="50">#</th>
              <th>Nama Akses</th>
              <th>Jenis</th>
              <th>Lokasi</th>
              <th>Rute</th>
              <th>Transportasi</th>
              <th>Wisata</th>
              <th width="160">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($akses) > 0): ?>
              <?php $no = 1; while ($row = mysqli_fetch_assoc($akses)): ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['nama_akses']) ?></td>
                  <td><?= htmlspecialchars($row['jenis_akses']) ?></td>
                  <td><?= htmlspecialchars($row['lokasi']) ?></td>
                  <td><?= htmlspecialchars($row['rute']) ?></td>
                  <td><?= htmlspecialchars($row['transportasi_darat'] ?: '-') ?></td>
                  <td><?= htmlspecialchars($row['nama_tempat'] ?? '-') ?></td>
                  <td class="text-center">
                    <a href="edit_akses.php?id=<?= $row['id_akses'] ?>" class="btn btn-warning btn-sm">
                      <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#hapusModal" 
                            data-id="<?= $row['id_akses'] ?>" 
                            data-nama="<?= htmlspecialchars($row['nama_akses']) ?>">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="8" class="text-center text-muted py-4">Belum ada data akses wisata.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus -->
  <div class="modal fade" id="hapusModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-confirm">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Konfirmasi Hapus</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Apakah kamu yakin ingin menghapus data akses <strong id="namaAkses"></strong>?</p>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <a href="#" id="btnHapus" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Script modal hapus
    const hapusModal = document.getElementById('hapusModal');
    hapusModal.addEventListener('show.bs.modal', event => {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const nama = button.getAttribute('data-nama');
      document.getElementById('namaAkses').textContent = nama;
      document.getElementById('btnHapus').href = `hapus_akses.php?id=${id}`;
    });
  </script>
</body>
</html>
