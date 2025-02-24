<?php
include 'config.php';

if (!isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
    header("Location: aturan.php");
    exit();
}

$ID = intval($_GET['ID']);
$conn->query("DELETE FROM aturan WHERE ID='$ID'");

header("Location: aturan.php");
exit();
?>
