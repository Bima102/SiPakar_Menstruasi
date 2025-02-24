<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua field diisi
    if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo "Semua field harus diisi!";
        exit();
    }

    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hash password
    $role = "user"; // Default role
    $kode_user = "USR" . uniqid(); // Generate kode_user unik

    // Cek apakah email sudah ada di database
    $cek_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $cek_email->bind_param("s", $email);
    $cek_email->execute();
    $cek_email->store_result();
    
    if ($cek_email->num_rows > 0) {
        echo "Email sudah digunakan. Silakan gunakan email lain.";
        exit();
    }
    $cek_email->close();

    // Insert data ke database dengan kode_user
    $stmt = $conn->prepare("INSERT INTO users (kode_user, nama, email, password, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $kode_user, $nama, $email, $password, $role);
    
    if ($stmt->execute()) {
        echo "Registrasi berhasil!";
        header("Location: login.php");
        exit();
    } else {
        echo "Registrasi gagal: " . $stmt->error;
    }
    $stmt->close();
}
?>
