<?php
include 'functions.php';

// Ambil hasil dari parameter GET
$selected = (array) ($_GET['selected'] ?? []);
$time = $_GET['time'] ?? date('Y-m-d H:i:s');

// Ambil data gejala
$rows = $db->get_results("SELECT kode_gejala, nama_gejala FROM tb_gejala WHERE kode_gejala IN ('" . implode("','", $selected) . "')");
$gejala_nama = [];
foreach ($rows as $row) {
    $gejala_nama[] = $row->nama_gejala;
}

// Ambil informasi pengguna dan diagnosa
$users = $db->get_results("SELECT tb_user.kode_user, tb_user.user, tb_user.tgl_lahir, tb_user.kota_asal, tb_user.jenis_kelamin, tb_user.pekerjaan, tb_diagnosa.created_at 
                           FROM tb_user INNER JOIN tb_diagnosa ON tb_user.kode_user = tb_diagnosa.kode_user WHERE tb_diagnosa.created_at = '$time'");

// Cetak header
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=hasil_diagnosa_" . date('Ymd_His') . ".xls");
?>

<h1>Hasil Diagnosa</h1>
<table border="1">
    <tr>
        <th>ID Pengguna</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Asal</th>
        <th>Jenis Kelamin</th>
        <th>Pekerjaan</th>
        <th>Tanggal Konsultasi</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->kode_user ?></td>
            <td><?= $user->user ?></td>
            <td><?= $user->tgl_lahir ?></td>
            <td><?= $user->kota_asal ?></td>
            <td><?= $user->jenis_kelamin ?></td>
            <td><?= $user->pekerjaan ?></td>
            <td><?= $user->created_at ?></td>
        </tr>
    <?php endforeach; ?>
</table>
