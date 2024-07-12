<?php

include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    
    $query = "DELETE FROM donor_details WHERE id = ?";
    
    
    $stmt = $conn->prepare($query);
    
   
    $stmt->bind_param('i', $id);
    
    
    if ($stmt->execute()) {
     
        header('Location: donor_list.php');
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    
    
    $stmt->close();
    $conn->close();
}
?>
