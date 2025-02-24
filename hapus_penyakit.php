<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus penyakit berdasarkan kode_penyakit
    $query = "DELETE FROM penyakit WHERE kode_penyakit = '$id'";
    if ($conn->query($query)) {
        header("Location: penyakit.php");
        exit();
    } else {
        echo "Gagal menghapus data!";
    }
}
?>
