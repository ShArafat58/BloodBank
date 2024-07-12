<?php
include 'header.php';

$query = "SELECT * FROM user_queries";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Queries</title>
</head>
<body>
    <h2>User Queries</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['query_id']; ?></td>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['user_email']; ?></td>
            <td><?php echo $row['user_message']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="mark_resolved.php?id=<?php echo $row['query_id']; ?>">Mark as Resolved</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
