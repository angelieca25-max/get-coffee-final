<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

include '../connection.php';

if (isset($_GET['id'])) {
    $id_testimonial = intval($_GET['id']);

    $sql = "DELETE FROM testimonials WHERE id_testimonial = $id_testimonial";
    $query = mysqli_query($connection, $sql);

    if ($query) {
        echo "<script>
                alert('Testimonial successfully deleted!');
                window.location.href = 'testimonials.php';
              </script>";
    } else {
        echo "<script>
                alert('Failed to delete testimonial: " . mysqli_error($connection) . "');
                window.location.href = 'testimonials.php';
              </script>";
    }
} else {
    header("Location: testimonials.php");
    exit();
}
?>
