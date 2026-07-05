<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

include '../connection.php'; 
include '../functions.php';

$query = get_all_menus_with_categories($connection, "menu.id_menu DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menus - Get Coffee</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>

<div class="admin-box" style="max-width: 950px;">
    <h2>Manage Menus - Admin Hub</h2>
    <div style="margin-bottom: 20px;">
        <a href="dashboard.php" class="btn-back" style="margin-bottom: 0;">← Back to Dashboard</a> 
        <span style="color: var(--glass-border); margin: 0 10px;">|</span>
        <a href="add-menu.php" class="btn-action" style="padding: 6px 12px; font-size: 13px;">+ Add New Menu</a>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 80px; text-align: center;">Image</th>
                    <th>Menu Name</th>
                    <th>Category</th>
                    <th>Description / Variant</th>
                    <th style="width: 100px;">Price</th>
                    <th style="width: 150px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(mysqli_num_rows($query) > 0) {
                    $no = 1;
                    while($result = mysqli_fetch_array($query)){
                        $id_menu = isset($result['id_menu']) ? $result['id_menu'] : (isset($result['id']) ? $result['id'] : '');
                        $menu_name = $result['menu_name']; 
                        $category_name = !empty($result['category_name']) ? $result['category_name'] : 'Uncategorized';
                        $description = isset($result['description']) ? $result['description'] : '';
                        $price = $result['price']; 
                        $image = isset($result['image']) ? $result['image'] : '';
                ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td style="text-align: center;">
                                <?php 
                                $image_src = '';
                                if (!empty($image)) {
                                    if (file_exists('../uploads/' . $image)) {
                                        $image_src = '../uploads/' . $image;
                                    } elseif (file_exists('../images/Menu/' . $image)) {
                                        $image_src = '../images/Menu/' . $image;
                                    } elseif (file_exists('../images/' . $image)) {
                                        $image_src = '../images/' . $image;
                                    }
                                }
                                if (!empty($image_src)): 
                                ?>
                                    <img src="<?php echo htmlspecialchars($image_src); ?>" alt="Menu" style="width: 45px; height: 45px; object-fit: cover; border-radius: 6px; border: 1px solid var(--glass-border);">
                                <?php else: ?>
                                    <span style="color: var(--text-muted); font-size: 11px; font-style: italic;">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-weight: 600; color: var(--accent-coffee);"><?php echo htmlspecialchars($menu_name); ?></td>
                            <td><?php echo htmlspecialchars($category_name); ?></td>
                            <td style="color: var(--text-muted); font-size: 13px; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?php echo htmlspecialchars($description); ?>
                            </td>
                            <td>Rp <?php echo number_format($price, 0, ',', '.'); ?></td>
                            <td style="text-align: center;">
                                <a href="edit-menu.php?id=<?php echo $id_menu; ?>" class="btn-secondary" style="padding: 5px 10px; font-size: 12px; margin-right: 5px;">Edit</a>
                                <a href="delete-menu.php?id=<?php echo $id_menu; ?>" class="btn-danger" style="padding: 5px 10px; font-size: 12px;" onclick="return confirm('Are you sure you want to delete this menu?')">Delete</a>
                            </td>
                        </tr>
                <?php 
                    }
                } else {
                    echo '<tr><td colspan="7" style="text-align:center; color: var(--text-muted);">No menu data available.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
