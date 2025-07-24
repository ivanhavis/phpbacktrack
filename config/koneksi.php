<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "konterku";

$konek = mysqli_connect($server, $username, $password) or die ("Koneksi Gagall");
mysqli_select_db($konek, $database) or die ("Database tidak bisa dibuka");

function query($sql) {
    global $konek;
    $result = mysqli_query($konek, $sql);

    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function hapus($id) {
    global $konek;
    mysqli_query($konek, "DELETE FROM barang WHERE idbarang ='$id'");
    return mysqli_affected_rows($konek);
}

function cari($keyword){
    $query = "SELECT FROM barang
 WHERE
 namabrg LIKE '%$keyword%' OR
 brand LIKE '%$keyword%' OR
 kategori LIKE '%$keyword%' OR
 jumlah LIKE '%$keyword%' OR
 harga LIKE '%$keyword%'
 ";
    return query($query);
}
?>