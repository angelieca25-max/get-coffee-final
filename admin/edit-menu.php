<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

include '../connection.php';
include '../functions.php';

if (!isset($_GET['id'])) {
    header("Location: menu.php");
    exit();
}

$id_menu = intval($_GET['id']);

$sql = "SELECT * FROM menu WHERE id_menu = $id_menu";
$query = mysqli_query($connection, $sql);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: menu.php");
    exit();
}

if (isset($_POST['save'])) {
    $menu_name   = mysqli_real_escape_string($connection, $_POST['menu_name']);
    $id_category = intval($_POST['id_category']);
    $price       = intval($_POST['price']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    $image = $data['image']; // Default to old image

    // Handle Upload New Image (If Provided)
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $tmp_file = $_FILES['image']['tmp_name'];
        
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'jfif'];
        $x = explode('.', $file_name);
        $extension = strtolower(end($x));
        
        if (in_array($extension, $allowed_extensions)) {
            if ($file_size < 2097152) { // Max 2MB
                $new_image = time() . '_' . $file_name;
                $target_dir = "../uploads/";
                
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                if (move_uploaded_file($tmp_file, $target_dir . $new_image)) {
                    // Delete old image file if it exists
                    if (!empty($image) && file_exists($target_dir . $image)) {
                        @unlink($target_dir . $image);
                    }
                    $image = $new_image;
                } else {
                    echo "<script>alert('Failed to upload new image to destination folder!'); window.history.back();</script>";
                    exit();
                }
            } else {
                echo "<script>alert('New file size is too large! Maximum 2MB.'); window.history.back();</script>";
                exit();
            }
        } else {
            echo "<script>alert('Invalid new image format! (JPG/JPEG/PNG/WEBP/GIF/JFIF)'); window.history.back();</script>";
            exit();
        }
    }

    $sql_update = "UPDATE menu SET 
                    menu_name = '$menu_name', 
                    id_category = '$id_category', 
                    price = '$price', 
                    description = '$description',
                    image = '$image'
                   WHERE id_menu = $id_menu";
                   
    $query_update = mysqli_query($connection, $sql_update);

    if ($query_update) {
        echo "<script>
                alert('Menu updated successfully!');
                window.location.href = 'menu.php';
              </script>";
    } else {
        echo "<script>
                alert('Failed to update menu: " . mysqli_error($connection) . "');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu - Get Coffee</title>
    <link rel="stylesheet" href="../css/admin-style.css?v=1.1">
</head>
<body>

<div class="admin-box" style="max-width: 650px;">
    <h2>Edit Menu - Get Coffee</h2>
    <a href="menu.php" class="btn-back">← Back to Manage Menus</a>

    <form action="" method="POST" enctype="multipart/form-data">
        <table class="form-table">
            <tr>
                <td>Menu Name:</td>
                <td><input type="text" name="menu_name" value="<?php echo htmlspecialchars($data['menu_name']); ?>" required></td>
            </tr>
            <tr>
                <td>Category:</td>
                <td>
                    <select name="id_category" required>
                        <?php
                        $query_cat = get_all_categories($connection);
                        while($cat = mysqli_fetch_assoc($query_cat)) {
                            $selected = ($cat['id_category'] == $data['id_category']) ? 'selected' : '';
                            echo "<option value='".$cat['id_category']."' $selected>".htmlspecialchars($cat['category_name'])."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Price (Rp):</td>
                <td><input type="number" name="price" value="<?php echo $data['price']; ?>" required></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><textarea name="description" rows="4"><?php echo htmlspecialchars($data['description']); ?></textarea></td>
            </tr>
            <tr>
                <td>Menu Image:</td>
                <td>
                    <?php if (!empty($data['image']) && file_exists("../uploads/" . $data['image'])): ?>
                        <img src="../uploads/<?php echo $data['image']; ?>" alt="Menu" style="max-width: 150px; display: block; border-radius: 8px; border: 1px solid var(--glass-border); margin-bottom: 12px;">
                    <?php else: ?>
                        <p style="color: var(--text-muted); font-style: italic; margin: 0 0 12px 0;">No image uploaded yet.</p>
                    <?php endif; ?>
                    <input type="file" name="image" style="padding: 8px 0; border: none; background: transparent;">
                    <small style="color: var(--text-muted); display: block; margin-top: 5px;">* Leave blank if you do not want to replace the current image.</small>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-top: 15px;">
                    <button type="submit" name="save" class="btn-action">Save Changes</button>
                    <a href="menu.php" class="btn-secondary" style="margin-left: 10px;">Cancel</a>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
