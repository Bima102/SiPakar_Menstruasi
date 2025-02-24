<?php
include 'config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM gejala WHERE kode_gejala = '$id'");
$data = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_gejala'];
    $query = "UPDATE gejala SET nama_gejala = '$nama' WHERE kode_gejala = '$id'";
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
    <title>Edit Gejala</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Gejala</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Kode Gejala</label>
            <input type="text" class="form-control" value="<?= $data['kode_gejala'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Gejala</label>
            <input type="text" name="nama_gejala" class="form-control" value="<?= $data['nama_gejala'] ?>" required>
        </div>
        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
        <a href="gejala.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
