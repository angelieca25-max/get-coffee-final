<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

include '../connection.php';

if (isset($_POST['save'])) {
    $username = mysqli_real_escape_string($connection, trim($_POST['username']));
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Check for duplicate username
        $check = mysqli_query($connection, "SELECT * FROM admin WHERE username = '$username'");
        if (mysqli_num_rows($check) > 0) {
            echo "<script>alert('Username already registered! Use another username.'); window.history.back();</script>";
            exit();
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$hashed_password')";
        $query = mysqli_query($connection, $sql);

        if ($query) {
            echo "<script>
                    alert('New admin added successfully!');
                    window.location.href = 'users.php';
                  </script>";
        } else {
            echo "<script>alert('Failed to add admin: " . mysqli_error($connection) . "');</script>";
        }
    } else {
        echo "<script>alert('All fields are required!'); window.history.back();</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Admin - Get Coffee</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>

<div class="admin-box" style="max-width: 500px;">
    <h1>ADD NEW ADMIN</h1>
    <a href="users.php" class="btn-back">← Back to User List</a>

    <form action="" method="POST">
        <table class="form-table">
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" required placeholder="Enter username..."></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" required placeholder="Enter password..."></td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-top: 15px;">
                    <button type="submit" name="save" class="btn-action">Save Admin</button>
                    <button type="reset" class="btn-secondary" style="margin-left: 10px;">Reset</button>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
