<?php
if ($_SESSION['akses'] == '0') {
    $rows = $db->get_results("SELECT tb_user.kode_user, tb_user.user, tb_penyakit.nama_penyakit, tb_diagnosa.total_bobot, tb_diagnosa.gejala_pilih, tb_diagnosa.created_at FROM tb_diagnosa
    INNER JOIN tb_user ON tb_diagnosa.kode_user = tb_user.kode_user
    INNER JOIN tb_penyakit ON tb_diagnosa.kode_penyakit = tb_penyakit.kode_penyakit
    ");
} elseif ($_SESSION['akses'] == '1') {
    $rows = $db->get_results("SELECT tb_user.kode_user, tb_user.user, tb_penyakit.nama_penyakit, tb_diagnosa.total_bobot, tb_diagnosa.gejala_pilih, tb_diagnosa.created_at FROM tb_diagnosa
    INNER JOIN tb_user ON tb_diagnosa.kode_user = tb_user.kode_user
    INNER JOIN tb_penyakit ON tb_diagnosa.kode_penyakit = tb_penyakit.kode_penyakit
    WHERE tb_user.kode_user='$_SESSION[login]'
    ");
}
?>

<div class="page-header">
    <h1>History</h1>
</div>

<div class="panel panel-default">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped color-white">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Nama</th>
                    <th style="width: 15%;">Penyakit</th>
                    <th style="width: 10%;">Hasil Diagnosa</th>
                    <th style="width: 15%;">Waktu</th>
                    <th style="width: 40%;">Gejala</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($rows as $row) :
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row->user) ?></td>
                        <td><?= htmlspecialchars($row->nama_penyakit) ?></td>
                        <td class="text-center"><?= number_format($row->total_bobot, 2) ?></td>
                        <td><?= date("Y-m-d H:i:s", strtotime($row->created_at)) ?></td>
                        <td>
                            <ul style="padding-left: 15px; margin: 0;">
                                <?php
                                $gejala_pilih = json_decode($row->gejala_pilih, true);
                                if (!empty($gejala_pilih)) {
                                    $gejala_query = "SELECT kode_gejala, nama_gejala FROM tb_gejala 
                                    WHERE kode_gejala IN ('" . implode("','", array_map('addslashes', $gejala_pilih)) . "')";
                                    $gejala_rows = $db->get_results($gejala_query);

                                    foreach ($gejala_rows as $gejala) :
                                ?>
                                        <li><strong>(<?= htmlspecialchars($gejala->kode_gejala) ?>)</strong> <?= htmlspecialchars($gejala->nama_gejala) ?></li>
                                <?php
                                    endforeach;
                                } else {
                                    echo "<li><em>Tidak ada gejala</em></li>";
                                }
                                ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
