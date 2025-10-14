<?php
include "../koneksi.php";
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM akses WHERE id_akses=$id");
header("Location: akses.php");
exit;
?>
