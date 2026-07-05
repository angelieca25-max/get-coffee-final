<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

include '../connection.php';

if (isset($_GET['id'])) {
    $id_menu = intval($_GET['id']);

    $sql = "DELETE FROM menu WHERE id_menu = $id_menu";
    $query = mysqli_query($connection, $sql);

    if ($query) {
        echo "<script>
                alert('Menu successfully deleted!');
                window.location.href = 'menu.php';
              </script>";
    } else {
        echo "<script>
                alert('Failed to delete menu!');
                window.location.href = 'menu.php';
              </script>";
    }
} else {
    header("Location: menu.php");
    exit();
}
?>
