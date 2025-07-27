<?php
session_start();
if (empty($_SESSION['username']))
{
header("location:index.php");
}
require '../config/koneksi.php';
$barang = query("SELECT * FROM barang");
if(isset($_POST["cari"])){
$barang = cari($_POST["keyword"]);
}
?>
<html>
<head>
<title>Inventory Gudang</title>
<link rel="stylesheet" href="../assets/css/tbarang.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<body>
<h2 align=center>CAR</h2>
<center>
<table>
<form method=POST action=form_barang.php>
<button>Tambah Barang</button>
</form>
<form method=POST action=menu.php>
<button>Menu Utama</button>
</form>
<form method=POST action=logout.php>
<button>LogOut</button>
</form>
</table>
<br>
<form action="" method="post">
<input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">
</form>
<div id="container">
<table class="styled-table" border=0 >
<tr class="judul ">
<th>No</th>
<th>Nama Barang</th>
<th>Brand</th>
<th>Kategori</th>
<th>Jumlah</th>
<th>Harga</th>
<th>Gambar</th>
<th>Action</th>
</tr>
<?php $i = 1; ?>
<?php foreach($barang as $row){ ?>
<tr class="isi">
<td align=center><?= $i; ?></td>
<td align=center><?= $row["namabrg"] ?></td>
<td align=center><?= $row["brand"] ?></td>
<td align=center><?= $row["kategori"] ?></td>
<td align=center><?= $row["jumlah"] ?></td>
<td align=center>Rp. <?= $row["harga"] ?></td>
<td align=center><img src="../gambar/<?= htmlspecialchars($row["gambar"]); ?>" width="70" height="70"></td>
<td align=center><a style="text-decoration: none" href=edit_barang.php?id=<?php echo $row['idbarang']; ?>>Edit</a>
<br><br>
<a style="text-decoration: none" href="hapus_barang.php?id=<?php echo $row['idbarang']; ?>" onclick="return confirm('yakin ingin meghapus data ini ? )">Hapus</a>
</td>
</tr>
<?php $i++;
} ?>
</table>
</div>
</center>
<script src="assets/js/cari.js"></script>
</body>
</html>