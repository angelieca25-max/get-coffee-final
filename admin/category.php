<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

include '../connection.php'; 

// Handle Add New Category
if (isset($_POST['save'])) {
    $category_name = mysqli_real_escape_string($connection, trim($_POST['category_name']));
    
    if (!empty($category_name)) {
        $insert = mysqli_query($connection, "INSERT INTO categories (category_name) VALUES ('$category_name')");
        if ($insert) {
            header("Location: category.php");
            exit();
        }
    }
}

// Handle Delete Category
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($connection, "DELETE FROM categories WHERE id_category = $id");
    header("Location: category.php");
    exit();
}

// Fetch categories for layout table
$categories_query = mysqli_query($connection, "SELECT * FROM categories ORDER BY id_category DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - Get Coffee</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>

<div class="admin-box">
    <h2>Manage Menu Categories</h2>
    <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>

    <form action="" method="POST" class="form-add-compact">
        <input type="text" name="category_name" placeholder="Enter new category name (e.g., Mocktails)..." required>
        <button type="submit" name="save">Add</button>
    </form>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 80px;">No</th>
                    <th>Category Name</th>
                    <th style="width: 100px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while($row = mysqli_fetch_assoc($categories_query)) { 
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td style="font-weight: 500; color: var(--accent-coffee);"><?php echo htmlspecialchars($row['category_name']); ?></td>
                    <td style="text-align: center;">
                        <a href="category.php?delete=<?php echo $row['id_category']; ?>" class="btn-danger" style="padding: 5px 10px; font-size: 12px;" onclick="return confirm('Deleting a category will impact menu relations. Are you sure you want to delete?')">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
