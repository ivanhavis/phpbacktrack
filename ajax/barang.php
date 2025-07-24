<?php
require_once '../config/koneksi.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM barang
WHERE
namabrg LIKE '%$keyword%' OR
brand LIKE '%$keyword%' OR
kategori LIKE '%$keyword%' OR
jumlah LIKE '%$keyword%' OR
harga LIKE '%$keyword%'
";
$barang = query($query);
?>
<table class="styled-table" border=0 >
<tr class="judul">
<th>No</th>
<th>Nama Barang</th>
<th>Brand</th>
<th>Kategori</th>
<th>Jumlah</th>
<th>Harga</th>
<th>Gambar</th>
<th>Action</th>
</tr>
<?php if(empty($barang)) : ?>
<tr>
<td colspan="8" align="center" style="font-size: 20px;">Data Tidak Ditemukan</td>
</tr>
<?php endif; ?>
<?php $i = 1; ?>
<?php foreach($barang as $row) : ?>
<tr class="isi">
<td align="center"><?= $i; ?></td>
<td align="left"><?= $row["namabrg"] ?></td>
<td align="left"><?= $row["brand"] ?></td>
<td align="left"><?= $row["kategori"] ?></td>
<td align="center"><?= $row["jumlah"] ?></td>
<td align="left">Rp. <?= $row["harga"] ?></td>
<td align="center"><img src="gambar/<?= $row["gambar"]; ?>" width="70" height="70"></td>
<td align="center"><a style="text-decoration: none" href="edit_barang.php?id=<?php echo $row['idbarang']; ?>">Edit</a>
<br><br>
<a style="text-decoration: none" href="hapus_barang.php?id=<?php echo $row['idbarang']; ?>" onclick="return confirm('yakin ingin meghapus data ini ?')">Hapus</a>
</td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table>