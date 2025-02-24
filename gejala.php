<?php
include 'config.php';
session_start();
$gejala = $conn->query("SELECT * FROM gejala");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gejala</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function searchTable() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let rows = document.querySelectorAll("#gejalaTable tbody tr");

            rows.forEach(row => {
                let found = [...row.children].some(td => td.innerText.toLowerCase().includes(input));
                row.style.display = found ? "" : "none";
            });
        }
    </script>
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
                    <li class="nav-item"><a class="nav-link" href="dashboard_admin.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="penyakit.php">Penyakit</a></li>
                    <li class="nav-item"><a class="nav-link active" href="gejala.php">Gejala</a></li>
                    <li class="nav-item"><a class="nav-link " href="aturan.php">Aturan</a></li>
                    <li class="nav-item"><a class="nav-link" href="konsultasi.php">Konsultasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="history.php">Histori</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-4">
    <h2>Data Gejala</h2>

    <div class="mb-3 d-flex align-items-center gap-2">
        <input type="text" id="searchInput" class="form-control" placeholder="🔍 Cari gejala..." onkeyup="searchTable()" style="max-width: 300px;">
        <button class="btn btn-success" onclick="location.reload()">🔄 Refresh</button>
        <a href="tambah_gejala.php" class="btn btn-primary">➕ Tambah</a>
    </div>

    <table class="table table-bordered" id="gejalaTable">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama Gejala</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $gejala->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['kode_gejala'] ?></td>
                <td><?= $row['nama_gejala'] ?></td>
                <td>
                    <a href="edit_gejala.php?id=<?= $row['kode_gejala'] ?>" class="btn btn-warning btn-sm">✏ Edit</a>
                    <a href="hapus_gejala.php?id=<?= $row['kode_gejala'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑 Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
