<?php
$selected = (array) ($_POST['selected'] ?? []);
$rows = $db->get_results("SELECT kode_gejala, nama_gejala FROM tb_gejala WHERE kode_gejala IN ('" . implode("','", $selected) . "')");
$gejala_pilih = json_encode($selected);
$time = $_POST['time'] ?? date('Y-m-d H:i:s'); // Pastikan time selalu ada

$start_time = microtime(true); // Tambahkan inisialisasi variabel

?>

<sub>Tabel dapat digeser kiri-kanan <span class="glyphicon glyphicon-resize-horizontal"></span></sub>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gejala Terpilih</h3>
    </div>
    <table class="table table-bordered table-hover table-striped color-white">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Gejala</th>
            </tr>
        </thead>
        <?php
        $no = 1;
        $gejala = [];
        foreach ($rows as $row) {
            $gejala[$row->kode_gejala] = $row->nama_gejala;
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row->nama_gejala) ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
$rows = $db->get_results("SELECT * FROM tb_penyakit ORDER BY kode_penyakit");
$penyakit = [];
foreach ($rows as $row) {
    $penyakit[$row->kode_penyakit] = $row;
}

$data = get_data($selected);

$b = new Bayes($selected, $penyakit, $data);

$end_time = microtime(true);

$execution_time = $end_time - $start_time;
$exec = number_format($execution_time, 5);
?>

<div class="panel-footer text-justify">
    <h3>Hasil</h3>
    <p class="color-white">
        <?php
        arsort($b->persen);
        $kode_penyakit = key($b->persen);
        $total_bobot = round(($b->persen[$kode_penyakit] ?? 0) * 100, 2);
        
        if (!empty($kode_penyakit)) {
            $db->query("INSERT INTO tb_diagnosa (kode_user, kode_penyakit, total_bobot, gejala_pilih, created_at) 
                        VALUES ('" . ($_SESSION['login'] ?? 'guest') . "', '$kode_penyakit', '$total_bobot', '$gejala_pilih', '$time')");
        ?>
            Berdasarkan perhitungan sistem, kemungkinan penyakit yang diderita adalah 
            <strong style="color: #00bc8c;"><?= htmlspecialchars($penyakit[$kode_penyakit]->nama_penyakit ?? 'Tidak Diketahui') ?></strong>
            dengan hasil <strong style="color: #00bc8c;"><?= $total_bobot ?>%</strong>
        <?php } else { ?>
            <strong style="color: red;">Tidak ada hasil diagnosa.</strong>
        <?php } ?>
    </p>
    <h3>Keterangan</h3>
    <p class="color-white"><?= htmlspecialchars($penyakit[$kode_penyakit]->keterangan ?? 'Tidak ada keterangan.') ?></p>
    
    <div>
        <a class="btn btn-primary" href="https://forms.gle/a7izEmGV89uUsGJGA" target="_blank"> Survey </a>
        <hr>
        <a class="btn btn-secondary" href="?m=konsultasi"><span class="glyphicon glyphicon-refresh"></span> Konsultasi Lagi</a>
        <a class="btn btn-default" href="cetak.php?m=hasil&<?= http_build_query(['selected' => $selected, 'time' => $time]) ?>" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
    </div>
</div>
<a class="btn btn-danger" href="?"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
