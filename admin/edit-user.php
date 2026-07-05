<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

include '../connection.php';

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}

$id_admin = intval($_GET['id']);
$query = mysqli_query($connection, "SELECT * FROM admin WHERE id_admin = $id_admin");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: users.php");
    exit();
}

if (isset($_POST['save'])) {
    $username = mysqli_real_escape_string($connection, trim($_POST['username']));
    $password = trim($_POST['password']);

    if (!empty($username)) {
        // Check for duplicate username (excluding self)
        $check = mysqli_query($connection, "SELECT * FROM admin WHERE username = '$username' AND id_admin != $id_admin");
        if (mysqli_num_rows($check) > 0) {
            echo "<script>alert('Username already registered! Use another username.'); window.history.back();</script>";
            exit();
        }

        if (!empty($password)) {
            // Update both username and password (hashed)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE admin SET username = '$username', password = '$hashed_password' WHERE id_admin = $id_admin";
        } else {
            // Update username only
            $sql = "UPDATE admin SET username = '$username' WHERE id_admin = $id_admin";
        }

        $query_update = mysqli_query($connection, $sql);
        if ($query_update) {
            // If the logged in admin edited their own account, update username session
            if ($_SESSION['username'] == $data['username']) {
                $_SESSION['username'] = $username;
            }
            
            echo "<script>
                    alert('Admin data updated successfully!');
                    window.location.href = 'users.php';
                  </script>";
        } else {
            echo "<script>alert('Failed to update admin data: " . mysqli_error($connection) . "');</script>";
        }
    } else {
        echo "<script>alert('Username cannot be empty!'); window.history.back();</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Get Coffee</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>

<div class="admin-box" style="max-width: 500px;">
    <h2>Edit User - Get Coffee</h2>
    <a href="users.php" class="btn-back">← Back to User List</a>

    <form action="" method="POST">
        <table class="form-table">
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo htmlspecialchars($data['username']); ?>" required></td>
            </tr>
            <tr>
                <td>New Password</td>
                <td>
                    <input type="password" name="password" placeholder="Enter new password...">
                    <small style="color: var(--text-muted); display: block; margin-top: 5px;">* Leave blank to keep current password.</small>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-top: 15px;">
                    <button type="submit" name="save" class="btn-action">Save Changes</button>
                    <a href="users.php" class="btn-secondary" style="margin-left: 10px;">Cancel</a>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
