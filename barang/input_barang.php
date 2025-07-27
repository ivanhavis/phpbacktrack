<link rel="stylesheet" href="assets/css/ibarang.css">
<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (empty($_SESSION['username'])) {
    header("location:index.php");
    exit(); 
}

require '../config/koneksi.php'; 

if (isset($_POST['submit'])) {
    $namabrg = htmlspecialchars($_POST['namabrg']);
    $brand = htmlspecialchars($_POST['brand']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $jumlah = htmlspecialchars($_POST['jumlah']);
    $harga = htmlspecialchars($_POST['harga']);

    $new_gambar_name = null;



    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $gambar_name = $_FILES['gambar']['name'];
        $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
        $gambar_size = $_FILES['gambar']['size'];
        $gambar_type = $_FILES['gambar']['type'];




        $upload_dir = __DIR__ . '/../gambar/'; 


        $gambar_ext = strtolower(pathinfo($gambar_name, PATHINFO_EXTENSION));


        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];


        if (!in_array($gambar_ext, $allowed_extensions)) {
            echo "<script>alert('Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.'); window.location='form_barang.php';</script>";
            exit();
        }


        $max_file_size = 2 * 1024 * 1024; // 2 MB
        if ($gambar_size > $max_file_size) {
            echo "<script>alert('Ukuran file melebihi batas 2MB.'); window.location='form_barang.php';</script>";
            exit();
        }


        $new_gambar_name = uniqid('img_', true) . '.' . $gambar_ext;
        $destination_path = $upload_dir . $new_gambar_name;


        if (move_uploaded_file($gambar_tmp_name, $destination_path)) {

            $query = "INSERT INTO barang (namabrg, brand, kategori, jumlah, harga, gambar) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($konek, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssiss", $namabrg, $brand, $kategori, $jumlah, $harga, $new_gambar_name);
                
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Data barang berhasil ditambahkan!'); window.location='tbarang.php';</script>";
                } else {

                    unlink($destination_path); 
                    echo "<script>alert('Gagal menambahkan data barang: " . mysqli_error($konek) . "'); window.location='form_barang.php';</script>";
                }
                mysqli_stmt_close($stmt);
            } else {

                unlink($destination_path);
                echo "<script>alert('Gagal menyiapkan statement: " . mysqli_error($konek) . "'); window.location='form_barang.php';</script>";
            }
        } else {

            echo "<script>alert('Gagal mengunggah gambar. Pastikan folder 'gambar' ada dan dapat ditulis oleh server. Error: " . error_get_last()['message'] . "'); window.location='form_barang.php';</script>";
        }
    } else {

        $error_message = 'Tidak ada gambar yang diunggah atau terjadi kesalahan awal saat upload.';
        if (isset($_FILES['gambar'])) {
            $error_message .= ' (Error Code: ' . $_FILES['gambar']['error'] . ')';
        }
        echo "<script>alert('" . $error_message . "'); window.location='form_barang.php';</script>";
    }
} else {

    header("location:form_barang.php");
    exit();
}
?>

<html>
<head>
    <title>:: Menu Utama :: </title>
    <link rel="stylesheet" href="../assets/css/ibarang.css">
</head>
<body>
    <center>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <lottie-player src="https://assets9.lottiefiles.com/packages/1f20_qlwqp9xi.json" background="transparent" speed="1" style="width: 428px; height: 420px;" loop autoplay></lottie-player>
    </center>
</body>
</html>