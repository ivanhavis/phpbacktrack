<?php
session_start();
if (empty($_SESSION['username']))
{
header("location:index.php");
}
include "config/koneksi.php";
$edit = mysqli_query($konek, "SELECT * FROM barang WHERE idbarang = '$_GET[id]'");
$row = mysqli_fetch_array($edit);
?>
<html>
<head>
<title>:: BARANG ::</title>
<link rel="stylesheet" href="../assets/css/ebarang.css">
</head>
<body>
<center>Edit Barang</center>
<?php
echo"<h5>Login Sebagai : ";
echo $_SESSION['username'];
?>
<div class="glass">
<form method=POST enctype='multipart/form-data' name='update' action='update_barang.php'>
<?php echo "<input type=hidden name=id value=$row[idbarang]>"; ?>
<table align=center border=0 id=table1>
<tr><td valign=top>Nama Barang</td>
<td>: <input type=text name=barang size=30 value=$row[namabrg]></td>
</tr>
<tr><td>Kategori</td><td><select name=kategori>
<?php
$tampil=mysqli_query($konek, "SELECT * FROM kategori ORDER BY nama_kategori");
while($r=mysqli_fetch_array($tampil)){
if ($row['id_kategori'] == $r['id_kategori']){
echo "<option value=$r[id_kategori] selected>$r[nama_kategori]</option>";
}else{
echo "<option value=$r[nama_kategori]>$r[nama_kategori]</option>";
}
}
?>
</select></td></tr>
<tr><td>Jumlah</td><td><input type=text value='<?= $row['jumlah'] ?>' name=jumlah size=15></td></tr>
<tr><td>Brand</td><td><input type=text value='<?= $row['brand'] ?>' name=brand size=15></td></tr>
<tr><td>Harga</td><td><input type=text value='<?= $row['harga'] ?>' name=harga size=15></td></tr>
<tr><td>Gambar</td><td><img src="gambar/<?=$row['gambar']?>" width=200 height=200></td></tr>
<tr><td>Ganti Gambar</td><td><input type=file name=fupload></td></tr>
<tr><td colspan=2>#Jika tidak ingin mengubah gambar silahkan abaikan saja</td></tr>
<tr><td colspan=2 align='center'><input id=update type=submit Value=Perbarui></td></tr>
</table>
</form>
<table align=center>
<form method=POST action=menu.php>
<button>Menu Utama</button>
</form>
<form method=POST action=tampil_barang.php>
<button>Tampil Barang</button>
</form>