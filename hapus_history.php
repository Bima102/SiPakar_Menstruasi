<?php
session_start();
include 'config.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id']) || !isset($_POST['id_diagnosa'])) {
    $_SESSION['error'] = "Akses tidak valid.";
    header("Location: history.php");
    exit;
}

// Ambil id_diagnosa dari form
$id_diagnosa = intval($_POST['id_diagnosa']);

// Hanya user yang bisa menghapus riwayatnya sendiri
$query = "DELETE FROM diagnosa WHERE id_diagnosa = ? AND kode_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $id_diagnosa, $_SESSION['kode_user']);

if ($stmt->execute()) {
    $_SESSION['success'] = "Riwayat berhasil dihapus.";
} else {
    $_SESSION['error'] = "Gagal menghapus riwayat.";
}
$stmt->close();

header("Location: history.php");
exit;
