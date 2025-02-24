<?php
session_start();
include 'config.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php?error=login_required");
    exit;
}

$kode_user = $_SESSION['kode_user'] ?? null;
$role = $_SESSION['role'] ?? 'user'; // Ambil peran user (default ke 'user')
$gejala = $conn->query("SELECT * FROM gejala");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $selected = $_POST['selected'] ?? [];

    if (count($selected) > 0) {
        $hasil = hitungNaiveBayes($selected, $conn);

        $kodePenyakit = $hasil['kode_penyakit'];
        $totalBobot = $hasil['probabilitas'];
        $gejalaPilih = json_encode($selected);

        // Simpan hasil konsultasi ke tabel diagnosa
        $query = "INSERT INTO diagnosa (kode_user, kode_penyakit, total_bobot, gejala_pilih, created_at) 
                  VALUES ('$kode_user', '$kodePenyakit', '$totalBobot', '$gejalaPilih', NOW())";
        
        if ($conn->query($query)) {
            // Redirect sesuai peran pengguna
            if ($role === 'admin') {
                header("Location: hasil_konsultasi.php?kode_user=$kode_user");
            } else {
                header("Location: hasil_user.php?kode_user=$kode_user");
            }
            exit;
        } else {
            echo "<script>alert('Gagal menyimpan hasil konsultasi.');</script>";
        }
    } else {
        echo "<script>alert('Pilih minimal 1 gejala');</script>";
    }
}

function hitungNaiveBayes($selectedGejala, $conn) {
    $queryPenyakit = $conn->query("SELECT * FROM penyakit");
    $hasil = [];

    while ($p = $queryPenyakit->fetch_assoc()) {
        $kodePenyakit = $p['kode_penyakit'];

        $totalAturan = $conn->query("SELECT COUNT(*) as total FROM aturan")->fetch_assoc()['total'];
        $totalPenyakit = $conn->query("SELECT COUNT(*) as total FROM aturan WHERE kode_penyakit='$kodePenyakit'")->fetch_assoc()['total'];
        $probPenyakit = $totalPenyakit > 0 ? $totalPenyakit / $totalAturan : 0.0001;

        $probabilitas = 1;
        foreach ($selectedGejala as $kodeGejala) {
            $queryAturan = $conn->query("SELECT nilai FROM aturan WHERE kode_penyakit='$kodePenyakit' AND kode_gejala='$kodeGejala'");
            $nilai = $queryAturan->fetch_assoc()['nilai'] ?? 0.0001;
            $probabilitas *= $nilai;
        }

        $hasil[$kodePenyakit] = $probPenyakit * $probabilitas;
    }

    arsort($hasil);
    return [
        'kode_penyakit' => array_key_first($hasil),
        'probabilitas' => $hasil[array_key_first($hasil)]
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?php echo ($role == 'admin') ? 'dashboard_admin.php' : 'dashboard_user.php'; ?>">SiPakar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo ($role == 'admin') ? 'dashboard_admin.php' : 'dashboard_user.php'; ?>">Dashboard</a></li>
                    <?php if ($role == 'admin') : ?>
                        <li class="nav-item"><a class="nav-link" href="penyakit.php">Penyakit</a></li>
                        <li class="nav-item"><a class="nav-link" href="gejala.php">Gejala</a></li>
                        <li class="nav-item"><a class="nav-link" href="aturan.php">Aturan</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link active" href="konsultasi.php">Konsultasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="history.php">Histori</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Konsultasi</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <h5 class="text-center mb-3">Pilih Gejala</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Gejala</th>
                                            <th>Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; while ($g = $gejala->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= htmlspecialchars($g['nama_gejala']) ?></td>
                                                <td><input type="checkbox" name="selected[]" value="<?= $g['kode_gejala'] ?>"></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Diagnosa</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
