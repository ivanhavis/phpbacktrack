<?php
session_start();
if (empty($_SESSION['username']))
{
header("location:index.php");
}
include "config/koneksi.php";
$lokasi_file = $_FILES['fupload']['tmp_name'];
$nama_file = $_FILES['fupload']['name'];
if(empty($lokasi_file)){
mysqli_query($konek, "UPDATE barang SET namabrg = '$_POST[barang]',
brand = '$_POST[brand]',
kategori = '$_POST[kategori]',
jumlah = '$_POST[jumlah]',
harga = '$_POST[harga]'
WHERE idbarang = '$_POST[id]'");
}else{
move_uploaded_file($lokasi_file, "gambar/$nama_file");
mysqli_query($konek, "UPDATE barang SET namabrg = '$_POST[barang]',
brand = '$_POST[brand]',
kategori = '$_POST[kategori]',
jumlah = '$_POST[jumlah]',
harga = '$_POST[harga]',
gambar = '$nama_file'
WHERE idbarang = '$_POST[id]'");
}
header('location:tampil_barang.php');
?>