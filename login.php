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

$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: donate.php");
            exit();
        } else {
            $login_error = "Invalid username or password";
        }
    } else {
        $login_error = "Invalid username or password";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - BloodBank</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5" style="max-width: 400px;">
        <h2 class="text-center mb-4">Login</h2>
        <?php if (!empty($login_error)): ?>
            <div class="alert alert-danger"><?php echo $login_error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <p class="text-center mt-3">Don't have an account? <a href="signup.php">Sign Up</a></p>
        </form>
    </div>
</body>
</html>