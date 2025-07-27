<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location:index.php");
    exit(); // Always exit after a header redirect
}
include "../config/koneksi.php";

// Get the ID from the URL, sanitize it
$idbarang = $_GET['id'];

// Use a prepared statement to prevent SQL injection
$stmt = mysqli_prepare($konek, "SELECT * FROM barang WHERE idbarang = ?");
mysqli_stmt_bind_param($stmt, "i", $idbarang); // 'i' for integer
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);

if (!$row) {
    // Handle case where no item is found for the given ID
    echo "<script>alert('Barang tidak ditemukan!'); window.location='tbarang.php';</script>";
    exit();
}
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
<form method="POST" enctype="multipart/form-data" name="update" action="update_barang.php">
<?php echo "<input type=hidden name=id value=" . htmlspecialchars($row['idbarang']) . ">"; ?>
<table align=center border=0 id=table1>
<tr><td valign=top>Nama Barang</td>
<td>: <input type=text name=barang size=30 value="<?= htmlspecialchars($row['namabrg']) ?>"></td>
</tr>
<tr><td>Kategori</td><td><select name=kategori>
<?php
$tampil=mysqli_query($konek, "SELECT * FROM kategori ORDER BY nama_kategori");
while($r=mysqli_fetch_array($tampil)){
// Use htmlspecialchars for options as well
$selected = ($row['kategori'] == $r['nama_kategori']) ? 'selected' : ''; // Compare with nama_kategori, not id_kategori unless your barang table stores id_kategori
echo "<option value=\"" . htmlspecialchars($r['nama_kategori']) . "\" $selected>" . htmlspecialchars($r['nama_kategori']) . "</option>";
}
?>
</select></td></tr>
<tr><td>Jumlah</td><td><input type=text value='<?= htmlspecialchars($row['jumlah']) ?>' name=jumlah size=15></td></tr>
<tr><td>Brand</td><td><input type=text value='<?= htmlspecialchars($row['brand']) ?>' name=brand size=15></td></tr>
<tr><td>Harga</td><td><input type=text value='<?= htmlspecialchars($row['harga']) ?>' name=harga size=15></td></tr>
<tr><td>Gambar</td><td>
    <?php if (!empty($row['gambar'])): ?>
        <img src="gambar/<?= htmlspecialchars($row['gambar']) ?>" width="200" height="200">
    <?php else: ?>
        Tidak ada gambar
    <?php endif; ?>
</td></tr>
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