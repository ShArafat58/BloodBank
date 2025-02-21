<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$signup_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        header("Location: donate.php");
        exit();
    } else {
        $signup_error = "Username or email already exists";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - BloodBank</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5" style="max-width: 400px;">
        <h2 class="text-center mb-4">Sign Up</h2>
        <?php if (!empty($signup_error)): ?>
            <div class="alert alert-danger"><?php echo $signup_error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
            <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>