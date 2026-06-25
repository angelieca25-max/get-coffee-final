<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "get-coffee";

$koneksi = mysqli_connect('localhost', 'root', "", 'get-coffee');

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
