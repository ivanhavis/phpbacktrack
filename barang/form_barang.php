<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location:index.php");
}
?>
<html>
<head>
    <title>:: BARANG ::</title>
    <link rel="stylesheet" href="../assets/css/fbarang.css">
</head>
<body>
<center>
    <h2 align="center">INPUT DATA BARANG</h2>
    <h5><?= $_SESSION['username']; ?></h5>

    <script
  src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.6.2/dist/dotlottie-wc.js"
  type="module"
></script>
    <lottie-player src="https://assets10.lottiefiles.com/packages/1f20_7k8jk8vi.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
<dotlottie-wc
  src="https://lottie.host/20560b1b-2a09-4dce-9613-3294bde7c386/lSk2QQyXoI.lottie"
  style="width: 300px;height: 300px"
  speed="1"
  autoplay
  loop
></dotlottie-wc>
    <div class="glass">
        <form method="POST" action="input_barang.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Nama Barang</td>
                    <td>: <input type="text" name="namabrg" size="30" required></td>
                    <td>Brand</td>
                    <td>: <input type="text" name="brand" size="15" required></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td colspan="3">:
                        <select name="kategori" required>
                            <option value="">- Pilih Kategori -</option>
                            <?php
                            include "../config/koneksi.php";
                            $tampil = mysqli_query($konek, "SELECT * FROM kategori ORDER BY nama_kategori");
                            while ($r = mysqli_fetch_array($tampil)) {
                                echo "<option value=\"$r[nama_kategori]\">$r[nama_kategori]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>: <input type="number" name="jumlah" size="15" required></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>: <input type="number" name="harga" size="15" required></td>
                </tr>
                <tr>
                    <td>Gambar</td>
                    <td>: <input type="file" name="gambar" accept="image/*" size="40" required></td>
                </tr>
                <tr>
                    <td colspan="4" align="right">
                        <input id="simpan" type="submit" name="submit" value="Simpan">
                    </td>
                </tr>
            </table>
        </form>

        <br>
        <form method="POST" action="menu.php">
            <button>Menu Utama</button>
        </form>
    </div>
</center>
</body>
</html>
