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
<b>MENU UTAMA</b></p>
<?php
echo"<h5>";
echo $_SESSION['username'];
?>
<div id="xxx1">
<form method=POST action=form_barang.php>
<button>Tambah Barang</button>
</form>
<form method=POST action=tampil_barang.php>
<button>Tampil Barang</button>
</form>
<form method=POST action=logout.php>
<button>Logout</button>
</form>
</div>
</body>
</html>