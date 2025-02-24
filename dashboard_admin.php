<?php
session_start();
include 'functions.php';
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SiPakar - Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="Dashboard.php">SiPakar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="dashboard_admin.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="penyakit.php">Penyakit</a></li>
                    <li class="nav-item"><a class="nav-link " href="gejala.php">Gejala</a></li>
                    <li class="nav-item"><a class="nav-link " href="aturan.php">Aturan</a></li>
                    <li class="nav-item"><a class="nav-link" href="konsultasi.php">Konsultasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="history.php">Histori</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>  
    <div class="container text-center mt-5">
        <h1 class="text-primary">Selamat Datang di SiPakar</h1>
        <p class="lead">Sistem Pakar untuk Diagnosis Gangguan Menstruasi dengan Metode Naive Bayes</p>
    </div>
    <div class="container mt-5">
        <h2 class="text-center text-primary">Dashboard Admin</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card shadow-lg p-3 text-center">
                    <h5>Total Gejala</h5>
                    <p class="display-6 text-primary"><?php echo countGejala(); ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg p-3 text-center">
                    <h5>Total Diagnosa</h5>
                    <p class="display-6 text-success"><?php echo countDiagnoses(); ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg p-3 text-center">
                    <h5>Total penyakit</h5>
                    <p class="display-6 text-danger"><?php echo countPenyakit(); ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
