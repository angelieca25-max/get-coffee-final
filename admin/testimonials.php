<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}

include '../connection.php';

$sql = "SELECT * FROM testimonials ORDER BY id_testimonial DESC";
$query = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Testimonials - Get Coffee</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>

<div class="admin-box" style="max-width: 900px;">
    <h2>Manage Customer Testimonials - Admin Hub</h2>
    <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 180px;">Customer Name</th>
                    <th>Comment / Message</th>
                    <th style="width: 150px;">Date</th>
                    <th style="width: 100px; text-align: center;">Action</th>
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
                            <td style="font-weight: 600; color: var(--accent-coffee);"><?php echo htmlspecialchars($result['customer_name']); ?></td>
                            <td style="color: var(--text-light);"><?php echo htmlspecialchars($result['comment']); ?></td>
                            <td style="color: var(--text-muted); font-size: 13px;"><?php echo date('d-m-Y H:i', strtotime($result['date'])); ?></td>
                            <td style="text-align: center;">
                                <a href="delete-testimonial.php?id=<?php echo $result['id_testimonial']; ?>" class="btn-danger" style="padding: 5px 10px; font-size: 12px;" onclick="return confirm('Are you sure you want to delete this testimonial/comment?')">Delete</a>
                            </td>
                        </tr>
                <?php 
                    }
                } else {
                    echo '<tr><td colspan="5" style="text-align:center; color: var(--text-muted);">No testimonials received yet.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
