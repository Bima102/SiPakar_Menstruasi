<?php
include 'config.php';

$id = $_GET['id'];
$query = "DELETE FROM gejala WHERE kode_gejala = '$id'";
if ($conn->query($query)) {
    header("Location: gejala.php");
}
?>
