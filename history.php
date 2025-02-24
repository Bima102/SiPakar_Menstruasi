<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$is_admin = ($_SESSION['role'] == 'admin');

if ($is_admin) {
    $query = "SELECT d.id_diagnosa, u.nama AS user, p.nama_penyakit, d.total_bobot, d.gejala_pilih, d.created_at 
            FROM diagnosa d
            INNER JOIN users u ON d.kode_user = u.kode_user
            INNER JOIN penyakit p ON d.kode_penyakit = p.kode_penyakit
            ORDER BY d.created_at DESC";
} else {
    $query = "SELECT d.id_diagnosa, u.nama AS user, p.nama_penyakit, d.total_bobot, d.gejala_pilih, d.created_at 
            FROM diagnosa d
            INNER JOIN users u ON d.kode_user = u.kode_user
            INNER JOIN penyakit p ON d.kode_penyakit = p.kode_penyakit
            WHERE d.kode_user = '{$_SESSION['kode_user']}'
            ORDER BY d.created_at DESC";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Konsultasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?= ($is_admin) ? 'dashboard_admin.php' : 'dashboard_user.php' ?>">SiPakar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= ($is_admin) ? 'dashboard_admin.php' : 'dashboard_user.php' ?>">Dashboard</a></li>
                <?php if ($is_admin) : ?>
                    <li class="nav-item"><a class="nav-link" href="penyakit.php">Penyakit</a></li>
                    <li class="nav-item"><a class="nav-link" href="gejala.php">Gejala</a></li>
                    <li class="nav-item"><a class="nav-link" href="aturan.php">Aturan</a></li>
                    <li class="nav-item"><a class="nav-link" href="konsultasi.php">Konsultasi</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link active" href="history.php">Histori</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center text-primary">Riwayat Konsultasi</h2>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Penyakit</th>
                    <th>Hasil Diagnosa</th>
                    <th>Waktu</th>
                    <th>Gejala</th>
                    <?php if (!$is_admin) : ?> <th>Aksi</th> <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while ($row = $result->fetch_assoc()) :
                    $gejala_pilih = json_decode($row['gejala_pilih'], true);
                    $gejala_list = "'" . implode("','", $gejala_pilih) . "'";
                    $gejala_query = "SELECT nama_gejala FROM gejala WHERE kode_gejala IN ($gejala_list)";
                    $gejala_result = $conn->query($gejala_query);
                    $gejala_arr = [];
                    while ($gejala = $gejala_result->fetch_assoc()) {
                        $gejala_arr[] = $gejala['nama_gejala'];
                    }
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['user']) ?></td>
                    <td><?= htmlspecialchars($row['nama_penyakit']) ?></td>
                    <td><?= round($row['total_bobot'], 2) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                    <td><?= implode(", ", $gejala_arr) ?></td>
                    <?php if (!$is_admin) : ?>
                    <td>
                        <form action="hapus_history.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat ini?');">
                            <input type="hidden" name="id" value="<?= $row['id_diagnosa'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
