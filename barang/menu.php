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
<center>
<p align="center"><font size="12"><b>MENU UTAMA</b></font></p>
<?php
echo"<h5>Login Sebagai : ";
echo $_SESSION['username'];
?>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets9.lottiefiles.com/packages/1f20_1pxqjqps.json"
background="transparent" speed="1" style="width: 400; height: 400px;"
loop autoplay></lottie-player>
<form method=POST action=form_barang.php>
<button>Tambah Barang</button>
</form>
<form method=POST action=tampil_barang.php>
<button>Tampil Barang</button>
</form>
<form method=POST action=logout.php>
<button>Logout</button>
</form>
</center>
</body>
</html>