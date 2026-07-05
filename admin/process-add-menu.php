<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

include '../connection.php'; 

if (isset($_POST['save'])) {
    $menu_name   = mysqli_real_escape_string($connection, $_POST['menu_name']);
    $id_category = intval($_POST['id_category']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $price       = intval($_POST['price']);

    // Handle Image Upload
    $image = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $tmp_file = $_FILES['image']['tmp_name'];
        
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'jfif'];
        $x = explode('.', $file_name);
        $extension = strtolower(end($x));
        
        if (in_array($extension, $allowed_extensions)) {
            if ($file_size < 2097152) { // Max 2MB
                $image = time() . '_' . $file_name;
                $target_dir = "../uploads/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                if (move_uploaded_file($tmp_file, $target_dir . $image)) {
                    // Upload success
                } else {
                    echo "<script>alert('Failed to upload image to destination folder!'); window.history.back();</script>";
                    exit;
                }
            } else {
                echo "<script>alert('File size is too large! Maximum 2MB.'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Invalid image format! (JPG/JPEG/PNG/WEBP/GIF/JFIF)'); window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('Please select an image first!'); window.history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO menu (id_category, menu_name, price, description, image) 
            VALUES ('$id_category', '$menu_name', '$price', '$description', '$image')";
    $query = mysqli_query($connection, $sql);

    if ($query) {
        echo "<script>
                alert('New menu successfully added!');
                window.location.href='menu.php';
              </script>";
    } else {
        echo "Failed to add menu: " . mysqli_error($connection);
    }
} else {
    header("Location: menu.php");
}
?>
