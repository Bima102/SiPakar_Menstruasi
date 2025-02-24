<?php
include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Validasi ID
if (!isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
    header("Location: aturan.php");
    exit();
}

$ID = intval($_GET['ID']);

// Menggunakan Prepared Statement untuk keamanan
$stmt = $conn->prepare("SELECT * FROM aturan WHERE ID = ?");
if (!$stmt) {
    die("Error prepare statement: " . $conn->error);
}
$stmt->bind_param("i", $ID);
$stmt->execute();
$result = $stmt->get_result();
$aturan = $result->fetch_assoc();

if (!$aturan) {
    die("Data aturan tidak ditemukan.");
}

// Ambil data penyakit dan gejala untuk dropdown
$penyakit = $conn->query("SELECT * FROM penyakit ORDER BY nama_penyakit");
$gejala = $conn->query("SELECT * FROM gejala ORDER BY nama_gejala");

if (!$penyakit || !$gejala) {
    die("Error mengambil data penyakit/gejala: " . $conn->error);
}

// Proses update data aturan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_penyakit = htmlspecialchars(trim($_POST['kode_penyakit']));
    $kode_gejala = htmlspecialchars(trim($_POST['kode_gejala']));
    $nilai = floatval($_POST['nilai']);

    // Validasi input tidak boleh kosong
    if (!empty($kode_penyakit) && !empty($kode_gejala) && ($nilai >= 0 && $nilai <= 1)) {
        $stmt = $conn->prepare("UPDATE aturan SET kode_penyakit=?, kode_gejala=?, nilai=? WHERE ID=?");
        if (!$stmt) {
            die("Error prepare statement update: " . $conn->error);
        }
        $stmt->bind_param("ssdi", $kode_penyakit, $kode_gejala, $nilai, $ID);

        if ($stmt->execute()) {
            header("Location: aturan.php");
            exit();
        } else {
            die("Gagal memperbarui data: " . $stmt->error);
        }
    } else {
        echo "<script>alert('Data tidak valid atau ada yang kosong!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aturan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-4 d-flex justify-content-center">
    <div class="card col-md-6">
        <div class="card-header text-black">
            <h5 class="text-center">Edit Aturan</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Kode Penyakit</label>
                    <select name="kode_penyakit" class="form-control" required>
                        <option value="">- Pilih Penyakit -</option>
                        <?php while ($row = $penyakit->fetch_assoc()) : ?>
                            <option value="<?= $row['kode_penyakit'] ?>" <?= ($row['kode_penyakit'] == $aturan['kode_penyakit']) ? 'selected' : '' ?>>
                                <?= $row['nama_penyakit'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kode Gejala</label>
                    <select name="kode_gejala" class="form-control" required>
                        <option value="">- Pilih Gejala -</option>
                        <?php while ($row = $gejala->fetch_assoc()) : ?>
                            <option value="<?= $row['kode_gejala'] ?>" <?= ($row['kode_gejala'] == $aturan['kode_gejala']) ? 'selected' : '' ?>>
                                <?= $row['nama_gejala'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bobot</label>
                    <select name="nilai" class="form-control" required>
                        <option value="0" <?= ($aturan['nilai'] == '0') ? 'selected' : '' ?>>Tidak ada</option>
                        <option value="0.4" <?= ($aturan['nilai'] == '0.4') ? 'selected' : '' ?>>Sedikit</option>
                        <option value="0.6" <?= ($aturan['nilai'] == '0.6') ? 'selected' : '' ?>>Cukup</option>
                        <option value="0.8" <?= ($aturan['nilai'] == '0.8') ? 'selected' : '' ?>>Banyak</option>
                        <option value="1" <?= ($aturan['nilai'] == '1') ? 'selected' : '' ?>>Sangat Banyak</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="aturan.php" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
