<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

include '../connection.php';

$sql = "SELECT * FROM admin ORDER BY id_admin DESC";
$query = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Get Coffee</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>

<div class="admin-box" style="max-width: 750px;">
    <h2>Manage Users - Admin Hub</h2>
    <div style="margin-bottom: 20px;">
        <a href="dashboard.php" class="btn-back" style="margin-bottom: 0;">← Back to Dashboard</a> 
        <span style="color: var(--glass-border); margin: 0 10px;">|</span>
        <a href="add-user.php" class="btn-action" style="padding: 6px 12px; font-size: 13px;">+ Add New Admin</a>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 80px;">No</th>
                    <th>Username</th>
                    <th style="width: 200px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(mysqli_num_rows($query) > 0) {
                    $no = 1;
                    while($result = mysqli_fetch_assoc($query)){
                ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td style="font-weight: 600; color: var(--accent-coffee);"><?php echo htmlspecialchars($result['username']); ?></td>
                            <td style="text-align: center;">
                                <a href="edit-user.php?id=<?php echo $result['id_admin']; ?>" class="btn-secondary" style="padding: 5px 10px; font-size: 12px; margin-right: 5px;">Edit</a>
                                <a href="delete-user.php?id=<?php echo $result['id_admin']; ?>" class="btn-danger" style="padding: 5px 10px; font-size: 12px;" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                <?php 
                    }
                } else {
                    echo '<tr><td colspan="3" style="text-align:center; color: var(--text-muted);">No admin users found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
