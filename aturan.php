<?php 
include 'config.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Proses hapus data aturan dengan Prepared Statement
if (isset($_GET['act']) && $_GET['act'] == 'hapus' && isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $ID = intval($_GET['ID']); 
    $stmt = $conn->prepare("DELETE FROM aturan WHERE ID = ?");
    $stmt->bind_param("i", $ID);
    $stmt->execute();

    header("Location: aturan.php");
    exit();
}

// Ambil data aturan dengan Prepared Statement
$q = isset($_GET['q']) ? esc_field($_GET['q']) : "";
$stmt = $conn->prepare("
    SELECT r.ID, r.kode_penyakit, r.kode_gejala, g.nama_gejala, p.nama_penyakit, r.nilai
    FROM aturan r 
    INNER JOIN penyakit p ON p.kode_penyakit = r.kode_penyakit 
    INNER JOIN gejala g ON g.kode_gejala = r.kode_gejala
    WHERE r.kode_gejala LIKE ? OR r.kode_penyakit LIKE ? 
          OR g.nama_gejala LIKE ? OR p.nama_penyakit LIKE ?
    ORDER BY r.kode_penyakit, r.kode_gejala");

$search = "%$q%";
$stmt->bind_param("ssss", $search, $search, $search, $search);
$stmt->execute();
$rows = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Aturan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
    function searchTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.querySelectorAll("#aturanTable tbody tr");

        rows.forEach(row => {
            let textContent = row.textContent.toLowerCase(); 
            row.style.display = textContent.includes(input) ? "" : "none";
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
                    <li class="nav-item"><a class="nav-link" href="gejala.php">Gejala</a></li>
                    <li class="nav-item"><a class="nav-link active" href="aturan.php">Aturan</a></li>
                    <li class="nav-item"><a class="nav-link" href="konsultasi.php">Konsultasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="history.php">Histori</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-4">
    <h2>Data Aturan</h2>

    <div class="mb-3 d-flex align-items-center gap-2">
        <input type="text" id="searchInput" class="form-control" placeholder="🔍 Cari aturan..." onkeyup="searchTable()" style="max-width: 300px;">
        <button class="btn btn-success" onclick="location.reload()">🔄 Refresh</button>
        <a href="aturan_tambah.php" class="btn btn-primary">➕ Tambah</a>
    </div>

    <table class="table table-bordered" id="aturanTable">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Penyakit</th>
                <th>Gejala</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0; while ($row = $rows->fetch_object()) : ?>
            <tr>
                <td><?= ++$no ?></td>
                <td>[<?= htmlspecialchars($row->kode_penyakit) ?>] <?= htmlspecialchars($row->nama_penyakit) ?></td>
                <td>[<?= htmlspecialchars($row->kode_gejala) ?>] <?= htmlspecialchars($row->nama_gejala) ?></td>
                <td><?= htmlspecialchars($row->nilai) ?></td>
                <td>
                    <a href="aturan_edit.php?ID=<?= $row->ID ?>" class="btn btn-warning btn-sm">✏ Edit</a>
                    <a href="aturan.php?act=hapus&ID=<?= $row->ID ?>" class="btn btn-danger btn-sm" 
                       onclick="return confirm('Hapus data ini?')">🗑 Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
