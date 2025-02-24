<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $kode = $_POST['kode_gejala'];
    $nama = $_POST['nama_gejala'];

    $query = "INSERT INTO gejala (kode_gejala, nama_gejala) VALUES ('$kode', '$nama')";
    if ($conn->query($query)) {
        header("Location: gejala.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gejala</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Tambah Gejala</h2>
    <form method="POST">
        <div class="mb-2 w-50">
            <label class="form-label">Kode Gejala</label>
            <input type="text" name="kode_gejala" class="form-control" required>
        </div>
        <div class="mb-2 w-50">
            <label class="form-label">Nama Gejala</label>
            <input type="text" name="nama_gejala" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="gejala.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
