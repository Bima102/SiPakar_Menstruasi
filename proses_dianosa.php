<?php
session_start();
include 'functions.php';

$selected = (array) ($_POST['selected'] ?? []);
$gejala_pilih = json_encode($selected);
$time = $_POST['time'] ?? date('Y-m-d H:i:s');

// Pastikan gejala dipilih
if (empty($selected)) {
    die("Harap pilih setidaknya satu gejala.");
}

// Ambil data gejala dari database
$rows = $db->get_results("SELECT kode_gejala, nama_gejala FROM tb_gejala WHERE kode_gejala IN ('" . implode("','", $selected) . "')");
$gejala_nama = [];
foreach ($rows as $row) {
    $gejala_nama[] = $row->nama_gejala;
}

// Ambil data penyakit dan probabilitas
$rows = $db->get_results("SELECT * FROM tb_penyakit ORDER BY kode_penyakit");
$penyakit = [];
foreach ($rows as $row) {
    $penyakit[$row->kode_penyakit] = $row;
}

$data = get_data($selected);
$b = new Bayes($selected, $penyakit, $data);

arsort($b->persen);
$kode_penyakit = key($b->persen);
$total_bobot = round(($b->persen[$kode_penyakit] ?? 0) * 100, 2);

// Simpan hasil diagnosa ke database
$db->query("INSERT INTO tb_diagnosa (kode_user, kode_penyakit, total_bobot, gejala_pilih, created_at) 
            VALUES ('" . ($_SESSION['login'] ?? 'guest') . "', '$kode_penyakit', '$total_bobot', '$gejala_pilih', '$time')");

// Redirect ke hasil diagnosa
header("Location: hasil_diagnosa.php?hasil=" . urlencode(json_encode([
    'nama' => $_SESSION['username'] ?? 'Guest',
    'gejala' => implode(", ", $gejala_nama),
    'diagnosa' => $penyakit[$kode_penyakit]->nama_penyakit ?? 'Tidak Diketahui',
    'tanggal' => $time
])));
exit;
?>
