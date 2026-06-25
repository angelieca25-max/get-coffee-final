<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "get-coffee");

if (isset($_GET['id'])) {
    $id_menu = $_GET['id'];

    $sql = "DELETE FROM menu WHERE id_menu = '$id_menu'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>
                alert('Data menu berhasil dihapus!');
                window.location.href = 'menu.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data!');
                window.location.href = 'menu.php';
              </script>";
    }
} else {
    header("Location: menu.php");
    exit;
}
?>
