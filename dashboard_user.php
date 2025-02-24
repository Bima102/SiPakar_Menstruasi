<?php
session_start();
include 'functions.php';
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SiPakar - Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/custom-style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">SiPakar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="dashboard_user.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="konsultasi.php">Konsultasi</a></li>
                    <li clas= "nav-item"><a class="nav-link" href="history.php">Histori</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-center mt-5">
        <h1 class="text-primary">Selamat Datang di SiPakar</h1>
        <p class="lead">Sistem Pakar untuk Diagnosis Gangguan Menstruasi dengan Metode Naive Bayes</p>
        <div class="card shadow-sm p-4">
            <h4 class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Mohon Dibaca!</h4>
            <p>Sebelum memulai konsultasi, pahami langkah-langkah berikut lalu klik tombol di bawah:</p>
            <ul class="list-group text-start">
                <li class="list-group-item">1. Pilih gejala-gejala yang dialami.</li>
                <li class="list-group-item">2. Klik tombol <strong>Submit Diagnosa</strong>.</li>
                <li class="list-group-item">3. Hasil diagnosa akan ditampilkan.</li>
            </ul>
            <a href="konsultasi.php" class="btn btn-primary mt-3">Mulai Konsultasi</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
