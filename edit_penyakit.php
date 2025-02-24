<?php
include 'config.php';

// Ambil data penyakit berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM penyakit WHERE kode_penyakit = '$id'");
    $data = $result->fetch_assoc();
}

// Update data penyakit
if (isset($_POST['submit'])) {
    $kode = $_POST['kode_penyakit'];
    $nama = $_POST['nama_penyakit'];
    $bobot = $_POST['bobot'];
    $keterangan = $_POST['keterangan'];

    $query = "UPDATE penyakit SET 
                nama_penyakit = '$nama', 
                bobot = '$bobot', 
                keterangan = '$keterangan' 
              WHERE kode_penyakit = '$kode'";
    
    if ($conn->query($query)) {
        header("Location: penyakit.php");
        exit();
    } else {
        echo "Gagal mengupdate data!";
    }
}

// Konversi nilai bobot ke teks
function getBobotText($value) {
    switch ($value) {
        case '0': return 'Tidak ada';
        case '0.3': return 'Sedikit Ada';
        case '0.8': return 'Ada';
        case '1': return 'Sangat Ada';
        default: return '- Pilih Bobot -';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penyakit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-4 d-flex justify-content-center">
    <div class="card col-md-6">
        <div class="card-header text-black">
            <h5 class="text-center">Edit Penyakit</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Kode Penyakit</label>
                    <input type="text" name="kode_penyakit" value="<?= $data['kode_penyakit'] ?>" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Penyakit</label>
                    <input type="text" name="nama_penyakit" value="<?= $data['nama_penyakit'] ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bobot</label>
                    <select name="bobot" class="form-control" required>
                        <option value="0" <?= ($data['bobot'] == '0') ? 'selected' : '' ?>>Tidak ada</option>
                        <option value="0.3" <?= ($data['bobot'] == '0.3') ? 'selected' : '' ?>>Sedikit Ada</option>
                        <option value="0.8" <?= ($data['bobot'] == '0.8') ? 'selected' : '' ?>>Ada</option>
                        <option value="1" <?= ($data['bobot'] == '1') ? 'selected' : '' ?>>Sangat Ada</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" required><?= $data['keterangan'] ?></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="penyakit.php" class="btn btn-danger">Batal</a>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
