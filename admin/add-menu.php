<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

include '../connection.php';
include '../functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Menu - Get Coffee</title>
    <link rel="stylesheet" href="../css/admin-style.css?v=1.1">
</head>
<body>

<div class="admin-box" style="max-width: 650px;">
    <h2>ADD NEW MENU</h2>
    <a href="menu.php" class="btn-back">← Back to Manage Menus</a>

    <form action="process-add-menu.php" method="POST" enctype="multipart/form-data">
        <table class="form-table">
            <tr>
                <td>Menu Name</td>
                <td><input type="text" name="menu_name" required placeholder="Enter menu name..."></td>
            </tr>
            <tr>
                <td>Category</td>
                <td>
                    <select name="id_category" required>
                        <option value="">-- Select Category --</option>
                        <?php
                        $query_cat = get_all_categories($connection);
                        while($cat = mysqli_fetch_assoc($query_cat)) {
                            echo "<option value='".$cat['id_category']."'>".htmlspecialchars($cat['category_name'])."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name="description" rows="4" required placeholder="Enter description/variant..."></textarea></td>
            </tr>
            <tr>
                <td>Price (Rp)</td>
                <td><input type="number" name="price" required placeholder="e.g. 25000"></td>
            </tr>
            <tr>
                <td>Menu Image</td>
                <td>
                    <input type="file" name="image" required style="padding: 8px 0; border: none; background: transparent;">
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-top: 15px;">
                    <button type="submit" name="save" class="btn-action">Save Menu</button>
                    <button type="reset" class="btn-secondary" style="margin-left: 10px;">Reset</button>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
