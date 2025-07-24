<?php
session_start();

include '../../config/koneksi.php';

if (!$koneksi) {
    die("Database connection failed.");
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$username = trim($username);
$password = trim($password);

$stmt = $koneksi->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    $_SESSION['username'] = $data['username'];
    $_SESSION['status'] = "login";
    $_SESSION['id'] = $data['id'];
    $_SESSION['level'] = $data['level'];
    $_SESSION['pesan'] = "Berhasil Login";

    switch ($data['level']) {
        case 'admin':
        case 'user':
        default:
            header("Location: menu.php");
            break;
    }

    exit(); // always exit after redirect
} else {
    // Login failed
    header("Location: ../index.php?pesan=gagal");
    exit();
}
?>
