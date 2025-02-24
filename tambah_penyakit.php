<?php
include 'config.php'; // Pastikan file koneksi ke database sudah tersedia

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_penyakit = $_POST["kode_penyakit"];
    $nama_penyakit = $_POST["nama_penyakit"];
    $bobot = $_POST["bobot"];
    $keterangan = $_POST["keterangan"];

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO penyakit (kode_penyakit, nama_penyakit, bobot, keterangan) VALUES ('$kode_penyakit', '$nama_penyakit', '$bobot', '$keterangan')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: penyakit.php");
        exit(); // Pastikan exit() agar script berhenti setelah redirect
    }
    
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Penyakit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #4c8bf5;
            border-color: #4c8bf5;
        }
        .btn-danger {
            background-color: #d9534f;
            border-color: #d43f3a;
        }
        .btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Tambah Penyakit</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post">
                <div class="form-group">
                    <label>Kode <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="kode_penyakit" placeholder="Masukkan kode penyakit" required />
                </div>
                <div class="form-group">
                    <label>Nama Penyakit <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="nama_penyakit" placeholder="Masukkan nama penyakit" required />
                </div>
                <div class="form-group">
                    <label>Bobot <span class="text-danger">*</span></label>
                    <select name="bobot" class="form-control" required>
                        <option value="">- Pilih Bobot -</option>
                        <option value="0">Tidak ada</option>
                        <option value="0.3">Sedikit Ada</option>
                        <option value="0.8">Ada</option>
                        <option value="1">Sangat Ada</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" rows="3" placeholder="Tambahkan keterangan"></textarea>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i> Simpan</button>
                    <a class="btn btn-danger" href="?m=penyakit"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
