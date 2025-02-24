<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "sipakar";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk membersihkan input dari karakter berbahaya (mencegah SQL Injection)
function esc_field($str) {
    global $conn;
    return $conn->real_escape_string(trim($str));
}

// Fungsi untuk mendapatkan nilai dari parameter GET dengan validasi
function _get($key) {
    return isset($_GET[$key]) ? $_GET[$key] : '';
}
?>
