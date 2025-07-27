<?php
session_start();


if (empty($_SESSION['username'])) {
    header("location:index.php");
    exit(); 
}


include "../config/koneksi.php"; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $idbarang = htmlspecialchars($_POST['id']);
    $namabrg = htmlspecialchars($_POST['barang']); 
    $brand = htmlspecialchars($_POST['brand']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $jumlah = htmlspecialchars($_POST['jumlah']);
    $harga = htmlspecialchars($_POST['harga']);

    $old_gambar_name = null; 
    $new_gambar_name = null; 

    
    
    $upload_dir = __DIR__ . '/../gambar/';

       
    
    $get_old_image_stmt = mysqli_prepare($konek, "SELECT gambar FROM barang WHERE idbarang = ?");
    if ($get_old_image_stmt) {
        mysqli_stmt_bind_param($get_old_image_stmt, "i", $idbarang);
        mysqli_stmt_execute($get_old_image_stmt);
        $result = mysqli_stmt_get_result($get_old_image_stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $old_gambar_name = $row['gambar'];
        }
        mysqli_stmt_close($get_old_image_stmt);
    } else {
        
        echo "<script>alert('Gagal mengambil data gambar lama: " . mysqli_error($konek) . "'); window.location='edit_barang.php?id=$idbarang';</script>";
        exit();
    }

    
    
    if (isset($_FILES['fupload']) && $_FILES['fupload']['error'] === UPLOAD_ERR_OK) {
        $gambar_name = $_FILES['fupload']['name'];
        $gambar_tmp_name = $_FILES['fupload']['tmp_name'];
        $gambar_size = $_FILES['fupload']['size'];
        $gambar_type = $_FILES['fupload']['type'];

        
        $gambar_ext = strtolower(pathinfo($gambar_name, PATHINFO_EXTENSION));

        
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        
        if (!in_array($gambar_ext, $allowed_extensions)) {
            echo "<script>alert('Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan untuk gambar baru.'); window.location='edit_barang.php?id=$idbarang';</script>";
            exit();
        }

        
        $max_file_size = 2 * 1024 * 1024; 
        if ($gambar_size > $max_file_size) {
            echo "<script>alert('Ukuran file gambar baru melebihi batas 2MB.'); window.location='edit_barang.php?id=$idbarang';</script>";
            exit();
        }

        
        $new_gambar_name = uniqid('img_', true) . '.' . $gambar_ext;
        $destination_path = $upload_dir . $new_gambar_name;

        
        if (!move_uploaded_file($gambar_tmp_name, $destination_path)) {
            echo "<script>alert('Gagal mengunggah gambar baru. Pastikan folder 'gambar' ada dan dapat ditulis oleh server.'); window.location='edit_barang.php?id=$idbarang';</script>";
            exit(); 
        }

        
        if ($old_gambar_name && file_exists($upload_dir . $old_gambar_name)) {
            unlink($upload_dir . $old_gambar_name); 
        }

    } else {
        
        
        $new_gambar_name = $old_gambar_name;
    }

    
    
    $query = "UPDATE barang SET namabrg = ?, brand = ?, kategori = ?, jumlah = ?, harga = ?, gambar = ? WHERE idbarang = ?";
    $stmt = mysqli_prepare($konek, $query);

    if ($stmt) {
        
        
        
        
        
        
        
        
        mysqli_stmt_bind_param($stmt, "sssissi", $namabrg, $brand, $kategori, $jumlah, $harga, $new_gambar_name, $idbarang);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data barang berhasil diperbarui!'); window.location='tampil_barang.php';</script>";
            exit(); 
        } else {
            
            if (isset($destination_path) && file_exists($destination_path) && $_FILES['fupload']['error'] === UPLOAD_ERR_OK) {
                unlink($destination_path); 
            }
            echo "<script>alert('Gagal memperbarui data barang: " . mysqli_error($konek) . "'); window.location='edit_barang.php?id=$idbarang';</script>";
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        
        if (isset($destination_path) && file_exists($destination_path) && $_FILES['fupload']['error'] === UPLOAD_ERR_OK) {
            unlink($destination_path);
        }
        echo "<script>alert('Gagal menyiapkan statement: " . mysqli_error($konek) . "'); window.location='edit_barang.php?id=$idbarang';</script>";
        exit();
    }

} else {
    
    header("location:tampil_barang.php");
    exit();
}
?>