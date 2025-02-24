<?php
session_start();
include 'config.php';
include 'includes/bayes.php';

if (!isset($_GET['kode_user'])) {
    die("Error: User tidak ditemukan!");
}

$kode_user = $_GET['kode_user'];

// Ambil nama user
$sql_user = "SELECT nama FROM users WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $kode_user);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$stmt_user->close();

// Ambil data diagnosa terakhir
$sql = "SELECT d.kode_user, d.created_at, d.gejala_pilih, p.nama_penyakit, p.keterangan, d.total_bobot, d.kode_penyakit
        FROM diagnosa d
        JOIN penyakit p ON d.kode_penyakit = p.kode_penyakit
        WHERE d.kode_user = ?
        ORDER BY d.created_at DESC LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $kode_user);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Error: Data diagnosa tidak ditemukan.");
}
$stmt->close();

// Ambil gejala yang dipilih
$gejala_pilih = json_decode($data['gejala_pilih'], true);
$gejala = [];

if (!empty($gejala_pilih)) {
    $gejala_list = "'" . implode("','", $gejala_pilih) . "'";
    $sql_gejala = "SELECT kode_gejala, nama_gejala FROM gejala WHERE kode_gejala IN ($gejala_list)";
    $result_gejala = $conn->query($sql_gejala);
    while ($row = $result_gejala->fetch_assoc()) {
        $gejala[$row['kode_gejala']] = $row['nama_gejala'];
    }
}

// Ambil data penyakit
$penyakit = [];
$sql_penyakit = "SELECT * FROM penyakit ORDER BY kode_penyakit";
$result_penyakit = $conn->query($sql_penyakit);
while ($row = $result_penyakit->fetch_assoc()) {
    $penyakit[$row['kode_penyakit']] = $row;
}

// Ambil data aturan
function get_data($gejala_pilih)
{
    global $conn;
    $data = [];
    if (!empty($gejala_pilih)) {
        $gejala_list = "'" . implode("','", $gejala_pilih) . "'";
        $sql = "SELECT kode_penyakit, kode_gejala, nilai AS bobot FROM aturan WHERE kode_gejala IN ($gejala_list)";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $data[$row['kode_penyakit']][$row['kode_gejala']] = $row['bobot'];
        }
    }
    return $data;
}

// Hitung probabilitas dengan metode Bayes
$data_bayes = get_data($gejala_pilih);
$bayes = new Bayes($gejala_pilih, $penyakit, $data_bayes);
$persentase_kepastian = isset($bayes->persen[$data['kode_penyakit']]) ? round($bayes->persen[$data['kode_penyakit']] * 100, 2) : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Diagnosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .table thead { background-color: #007bff; color: white; }
        .table tfoot { background-color: #f8f9fa; font-weight: bold; }
        .btn-custom { background-color: #007bff; color: white; border-radius: 8px; }
        .btn-custom:hover { background-color: #0056b3; }
    </style>
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
                    <li class="nav-item"><a class="nav-link" href="aturan.php">Aturan</a></li>
                    <li class="nav-item"><a class="nav-link active" href="konsultasi.php">Konsultasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="history.php">Histori</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
<body>
<div class="container mt-5">
        <div class="card p-4">
            <h2 class="text-center text-primary">Hasil Diagnosa</h2>
            <hr>
            <h4 class="mb-3">Gejala yang dipilih:</h4>
            <ul>
                <?php foreach ($gejala as $key => $val) : ?>
                    <li><?= htmlspecialchars($val) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- PROBABILITAS PENYAKIT GEJALA -->
        <div class="card mt-3">
            <div class="card-header">
                <h5>Probabilitas Penyakit Gejala</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-info">
                        <tr>
                            <th>Probabilitas</th>
                            <th>Nilai</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gejala as $kode_gejala => $nama_gejala) : ?>
                            <?php foreach ($bayes->penyakit as $kode_penyakit => $data_penyakit) : ?>
                                <?php 
                                    $p_gejala_penyakit = $bayes->data[$kode_penyakit][$kode_gejala] ?? 0;
                                    $p_penyakit = $bayes->penyakit[$kode_penyakit]['bobot'] ?? 0;
                                    $hasil = $p_gejala_penyakit * $p_penyakit;
                                ?>
                                <tr>
                                    <td>P(<?= $kode_gejala ?>|<?= $kode_penyakit ?>) * P(<?= $kode_penyakit ?>)</td>
                                    <td><?= round($p_gejala_penyakit, 4) ?> * <?= round($p_penyakit, 4) ?></td>
                                    <td><?= round($hasil, 4) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
       <!-- PROBABILITAS GEJALA -->
       <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                <h5>Probabilitas Gejala</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-info">
                        <tr>
                            <th>Gejala</th>
                            <th>Probabilitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bayes->pro_gejala as $key => $val) : ?>
                            <tr>
                                <td>P(<?= $key ?>)</td>
                                <td><?= round($val, 4) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PROBABILITAS TIAP PENYAKIT -->
        <?php foreach ($penyakit as $kode_penyakit => $data_penyakit) : ?>
            <div class="card mt-3">
                <div class="card-header">
                    <h5>Probabilitas Penyakit <?= htmlspecialchars($data_penyakit['nama_penyakit']) ?></h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>Bobot Penyakit-Gejala</th>
                                <th>Bobot Gejala</th>
                                <th>Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_hasil = 0; ?>
                            <?php foreach ((array) $bayes->pro_penyakit[$kode_penyakit] as $kode_gejala => $nilai) : ?>
                                <tr>
                                    <td>P(<?= $kode_gejala ?>|<?= $kode_penyakit ?>) = <?= $nilai['x'] ?></td>
                                    <td><?= $nilai['y'] ?></td>
                                    <td><?= round($nilai['z'], 4) ?></td>
                                </tr>
                                <?php $total_hasil += $nilai['z']; ?>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-warning">
                                <td colspan="2"><strong>Total</strong></td>
                                <td><strong><?= round($total_hasil, 4) ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>

<!-- PERSENTASE -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Persentase</h3>
    </div>
    <div class="table-responsive show" id="persentase">
        <table class="table table-bordered table-hover table-striped color-white">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Bayes</th>
                    <th>Persen</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (!empty($bayes->persen)) :
                    foreach ($bayes->persen as $key => $val) : ?>
                        <tr>
                            <td><?= htmlspecialchars($key) ?></td>
                            <td><?= htmlspecialchars($penyakit[$key]['nama_penyakit']) ?></td>
                            <td><?= round($bayes->hasil[$key], 4) ?></td>
                            <td><?= round($val * 100, 2) ?>%</td>
                        </tr>
                <?php 
                    endforeach;
                else : ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data tersedia</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><strong>Total</strong></td>
                    <td><strong><?= round(array_sum($bayes->hasil), 4) ?></strong></td>
                    <td><strong>100%</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

        <!-- Hasil Diagnosis -->
        <div class="card mt-4 p-4 mb-5">
            <h5 class="text-center">Hasil Diagnosa</h5>
            <p>Berdasarkan perhitungan sistem, penyakit yang didiagnosis adalah:</p>
            <h3 class="text-danger text-center"><strong><?= htmlspecialchars($data['nama_penyakit']) ?></strong></h3>
            <p class="text-center">Dengan kepastian sebesar <strong><?= $persentase_kepastian ?>%</strong>.</p>
            <h5 class="mt-3">Keterangan Penyakit:</h5>
            <p><?= htmlspecialchars($data['keterangan']) ?></p>
            <div class="text-center mt-4 pb-4">
                <a class="btn btn-custom" href="konsultasi.php">&#x21bb; Konsultasi Lagi</a>
                <a class="btn btn-secondary" href="cetak.php?m=hasil&<?= http_build_query(array('selected' => $selected)) ?>" target="_blank">&#x1F5A8; Cetak</a>
            </div>
        </div>
    </div>
</body>
</html>
