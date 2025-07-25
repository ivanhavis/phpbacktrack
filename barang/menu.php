<?php
session_start();
// Cek Login
if (empty($_SESSION['username']))
{
header("location:index.php");
}
?>
<html>
<head>
<title>:: Menu Utama :: </title>
<link rel="stylesheet" href="../assets/css/menu.css">
</head>
<body>
<font size="128px"><b>MENU UTAMA</b></font></p>
<?php
echo"<h5>";
echo $_SESSION['username'];
?>
<form method=POST action=form_barang.php>
<button>Tambah Barang</button>
</form>
<form method=POST action=tampil_barang.php>
<button>Tampil Barang</button>
</form>
<form method=POST action=logout.php>
<button>Logout</button>
</form>
</body>
</html>