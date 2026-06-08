<?php

$conn = mysqli_connect("localhost", "root", "", "db_getcoffee"); 

if (isset($_POST['simpan'])) {
    
    $nama_menu = $_POST['nama_menu'];
    $deskripsi = $_POST['deskripsi'];
    $harga     = $_POST['harga'];

    $sql = "INSERT INTO menu (nama_menu, deskripsi, harga) VALUES ('$nama_menu', '$deskripsi', '$harga')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
       
        echo "<script>
                alert('Menu baru berhasil ditambahkan!');
                window.location.href='menu.php';
              </script>";
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($conn);
    }
} else {
    header("Location: menu.php");
}
?>
