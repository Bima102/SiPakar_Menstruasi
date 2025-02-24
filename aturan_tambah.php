<?php
include 'config.php';

// Proses tambah aturan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_penyakit = $_POST['kode_penyakit'];
    $kode_gejala = $_POST['kode_gejala'];
    $nilai = $_POST['nilai'];

    // Gunakan $conn untuk query jika sebelumnya digunakan
    $conn->query("INSERT INTO aturan (kode_penyakit, kode_gejala, nilai) VALUES ('$kode_penyakit', '$kode_gejala', '$nilai')");

    // Redirect langsung ke halaman aturan.php
    header("Location: aturan.php");
    exit();
}

// Ambil data penyakit dan gejala untuk dropdown
$penyakit = $conn->query("SELECT * FROM penyakit ORDER BY nama_penyakit");
$gejala = $conn->query("SELECT * FROM gejala ORDER BY nama_gejala");
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aturan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Tambah Aturan</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Penyakit</label>
            <select class="form-control" name="kode_penyakit" required>
                <option value="" disabled selected>Pilih Penyakit</option>
                <?php while ($p = $penyakit->fetch_assoc()) : ?>
                    <option value="<?= $p['kode_penyakit'] ?>"><?= $p['nama_penyakit'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Gejala</label>
            <select class="form-control" name="kode_gejala" required>
                <option value="" disabled selected>Pilih Gejala</option>
                <?php while ($g = $gejala->fetch_assoc()) : ?>
                    <option value="<?= $g['kode_gejala'] ?>"><?= $g['nama_gejala'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Nilai</label>
            <select class="form-control" name="nilai" required>
                <option value="0">Tidak ada</option>
                <option value="0.4">Mungkin</option>
                <option value="0.6">Kemungkinan Besar</option>
                <option value="0.8">Hampir Pasti</option>
                <option value="1">Pasti</option>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a class="btn btn-danger" href="?m=aturan">Kembali</a>
    </form>
</div>
</body>
</html>
