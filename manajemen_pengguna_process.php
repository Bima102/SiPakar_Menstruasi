<?php
session_start();
include 'functions.php';

// Ambil semua pengguna
$users = getAllUsers();

// Cek apakah user sudah login dan memiliki role admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Periksa jenis operasi yang dilakukan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai form
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    
    // Jika ID kosong, berarti ini tambah pengguna baru
    if (!$id) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if (addUser($nama, $email, $password, $role)) {
            header("Location: manajemen_pengguna.php?success=added");
        } else {
            header("Location: manajemen_pengguna.php?error=failed");
        }
    } else {
        // Jika ID ada, berarti ini update pengguna
        $user = getUserById($id);
        if (!$user) {
            header("Location: manajemen_pengguna.php?error=notfound");
            exit();
        }
        
        // Gunakan password baru jika diisi, jika tidak pakai yang lama
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            $password = $user['password'];
        }
        
        if (updateUser($id, $nama, $email, $password, $role)) {
            header("Location: manajemen_pengguna.php?success=updated");
        } else {
            header("Location: manajemen_pengguna.php?error=failed");
        }
    }
    exit();
}

// Proses hapus pengguna jika ada parameter ID pada GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (deleteUser($id)) {
        header("Location: manajemen_pengguna.php?success=deleted");
    } else {
        header("Location: manajemen_pengguna.php?error=failed");
    }
    exit();
}
// Cek apakah ID tersedia untuk dihapus
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (deleteUser($id)) {
        $message = "Pengguna telah dihapus!";
    } else {
        $message = "Gagal menghapus pengguna!";
    }
} else {
    header("Location: manajemen_pengguna.php?error=notfound");
    exit();
}

// Jika tidak ada request valid, kembalikan ke halaman utama
header("Location: manajemen_pengguna.php");
exit();
?>
