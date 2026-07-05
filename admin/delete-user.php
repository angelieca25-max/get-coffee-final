<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

include '../connection.php';

if (isset($_GET['id'])) {
    $id_admin = intval($_GET['id']);

    // Check if admin is trying to delete their own account
    $query_self = mysqli_query($connection, "SELECT username FROM admin WHERE id_admin = $id_admin");
    $admin_data = mysqli_fetch_assoc($query_self);

    if ($admin_data && $admin_data['username'] === $_SESSION['username']) {
        echo "<script>
                alert('You cannot delete your own active account!');
                window.location.href = 'users.php';
              </script>";
        exit();
    }

    // Check total admin count to avoid zero admins
    $query_total = mysqli_query($connection, "SELECT COUNT(*) as total FROM admin");
    $total_data = mysqli_fetch_assoc($query_total);

    if ($total_data['total'] <= 1) {
        echo "<script>
                alert('Delete failed! The system must have at least 1 active admin.');
                window.location.href = 'users.php';
              </script>";
        exit();
    }

    // Delete admin
    $sql = "DELETE FROM admin WHERE id_admin = $id_admin";
    $query = mysqli_query($connection, $sql);

    if ($query) {
        echo "<script>
                alert('Admin deleted successfully!');
                window.location.href = 'users.php';
              </script>";
    } else {
        echo "<script>
                alert('Failed to delete admin: " . mysqli_error($connection) . "');
                window.location.href = 'users.php';
              </script>";
    }
} else {
    header("Location: users.php");
    exit();
}
?>
