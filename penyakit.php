<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $kode = $_POST['kode_penyakit'];
    $nama = $_POST['nama_penyakit'];
    $bobot = $_POST['bobot'];
    $keterangan = $_POST['keterangan'];

    $query = "INSERT INTO penyakit (kode_penyakit, nama_penyakit, bobot, keterangan) 
            VALUES ('$kode', '$nama', '$bobot', '$keterangan')";
    $conn->query($query);
    header("Location: penyakit.php");
}

$penyakit = $conn->query("SELECT * FROM penyakit");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyakit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchTable() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let table = document.getElementById("penyakitTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) { 
                let cells = rows[i].getElementsByTagName("td");
                let found = false;

                for (let j = 0; j < cells.length - 1; j++) { 
                    if (cells[j].innerHTML.toLowerCase().includes(input)) {
                        found = true;
                        break;
                    }
                }
                rows[i].style.display = found ? "" : "none";
            }
        }
    </script>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">SiPakar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard_admin.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link active" href="penyakit.php">Penyakit</a></li>
                <li class="nav-item"><a class="nav-link" href="gejala.php">Gejala</a></li>
                <li class="nav-item"><a class="nav-link" href="aturan.php">Aturan</a></li>
                <li class="nav-item"><a class="nav-link" href="konsultasi.php">Konsultasi</a></li>
                <li class="nav-item"><a class="nav-link" href="history.php">Histori</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="mb-4">Penyakit</h2>

    <div class="mb-3 d-flex align-items-center gap-2">
        <input type="text" id="searchInput" class="form-control" 
               placeholder="🔍 Cari penyakit..." onkeyup="searchTable()" 
               style="max-width: 300px;">
        <button class="btn btn-success">🔄 Refresh</button>
        <a href="tambah_penyakit.php" class="btn btn-primary">➕ Tambah</a>
    </div>

    <!-- Tabel Data Penyakit -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="penyakitTable">
            <thead class="table-dark">
                <tr>
                    <th style="width: 10%;">Kode</th>
                    <th style="width: 25%;">Nama Penyakit</th>
                    <th style="width: 10%;">Bobot</th>
                    <th style="width: 35%;">Keterangan</th>
                    <th style="width: 20%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $penyakit->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['kode_penyakit'] ?></td>
                    <td class="text-start"><?= $row['nama_penyakit'] ?></td>
                    <td><?= $row['bobot'] ?></td>
                    <td class="text-start"><?= $row['keterangan'] ?></td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="edit_penyakit.php?id=<?= $row['kode_penyakit'] ?>" 
                               class="btn btn-warning btn-sm">✏ Edit</a>
                            <a href="hapus_penyakit.php?id=<?= $row['kode_penyakit'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus?')">🗑 Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
