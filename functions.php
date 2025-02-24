<?php
$host = "localhost"; // Sesuaikan dengan kebutuhan
$user = "root"; // User database
$password = ""; // Kosongkan jika tidak ada password
$database = "sipakar"; // Nama database

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mulai session hanya jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_regenerate_id(true);

function getUserByEmail($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if (!$stmt) {
        die("Query error: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Email dan Password harus diisi!";
        header("Location: login.php");
        exit();
    }

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user = getUserByEmail($email);

    if (!$user) {
        $_SESSION['error'] = "Email tidak ditemukan!";
        header("Location: login.php");
        exit();
    }

    // Debugging: Cek apakah password benar-benar sama
    if ($password !== $user['password']) {
        var_dump(bin2hex($password), bin2hex($user['password']));
        exit();
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_role'] = $user['role'];

    header("Location: dashboard.php");
    exit();
}
function countUsers() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as total FROM users");
    $data = $result->fetch_assoc();
    return $data['total'];
}
function countDiagnoses() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as total FROM diagnosa");
    
    if (!$result) {
        die("Error Query: " . $conn->error);
    }
    
    $data = $result->fetch_assoc();
    return $data['total'];
}
function countPenyakit() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as total FROM penyakit");

    if (!$result) {
        die("Error Query: " . $conn->error);
    }

    $data = $result->fetch_assoc();
    return $data['total'];
}

function countGejala() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as total FROM gejala");

    if (!$result) {
        die("Error Query: " . $conn->error);
    }

    $data = $result->fetch_assoc();
    return $data['total'];
}

function countAturan() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as total FROM aturan");

    if (!$result) {
        die("Error Query: " . $conn->error);
    }

    $data = $result->fetch_assoc();
    return $data['total'];
}
function hitungNaiveBayes($selected, $conn) {
    $query = "SELECT p.kode_penyakit, p.nama_penyakit, SUM(a.nilai) AS total_nilai
              FROM tb_aturan a
              JOIN tb_penyakit p ON a.kode_penyakit = p.kode_penyakit
              WHERE a.kode_gejala IN ('" . implode("','", $selected) . "')
              GROUP BY a.kode_penyakit
              ORDER BY total_nilai DESC
              LIMIT 1";

    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['nama_penyakit'] ?? "Tidak Diketahui";
}

function get_data($selected, $conn) {
    $data = [];

    foreach ($selected as $kodeGejala) {
        $query = "SELECT kode_penyakit, nilai FROM aturan WHERE kode_gejala='$kodeGejala'";
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
            $data[$row['kode_penyakit']][$kodeGejala] = $row['nilai'];
        }
    }

    return $data;
}

?>
