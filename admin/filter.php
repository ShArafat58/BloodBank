<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $message = "Connection failed: " . $conn->connect_error;
} else {
    $message = "";
    $donors = [];
    $no_donors = false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $b_group = $_POST['b_group'];

    $query = "SELECT * FROM donor_details WHERE blood_group = '$b_group'";
    $result = mysqli_query($conn, $query);

    header('Location: donor_list.php');

}
?>