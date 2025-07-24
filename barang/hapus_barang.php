<?php
session_start();
if (empty($_SESSION['username']))
{
header("location:index.php");
}
include "config/koneksi.php";
$id = $_GET['id'];
if (hapus($id)) {
?>
<script>
alert('data berhasil dihapus');
document.location.href = 'tampil_barang.php';
</script>
<?php
} else {
?>
<script>
alert('data gagal dihapus');
document.location.href = 'tampil_barang.php';
</script>
<?php
}
?>