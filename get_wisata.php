<?php
include "koneksi.php";

$result = mysqli_query($conn, "SELECT nama_tempat, latitude, longitude FROM wisata");
$wisata = [];

while ($row = mysqli_fetch_assoc($result)) {
    $wisata[] = $row;
}

echo json_encode($wisata);
?>
