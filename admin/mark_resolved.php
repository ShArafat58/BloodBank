<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $query_id = $_GET['id'];
    $query = "UPDATE user_queries SET status='resolved' WHERE query_id='$query_id'";
    if (mysqli_query($conn, $query)) {
        echo "Query marked as resolved!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

header('Location: queries.php');
exit;
?>
