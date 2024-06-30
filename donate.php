<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodbank";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $message = "Connection failed: " . $conn->connect_error;
    $status = "error";
} else {
    $message = "";
    $status = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $b_group = $_POST['b_group'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("INSERT INTO donors (name, email, phone, age, gender, blood_group, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $phone_number, $age, $gender, $b_group, $address);

    if ($stmt->execute()) {
        $message = "Successfully added donor!";
        $status = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $status = "error";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BloodBank - Donate Blood</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
        }
        .container {
            max-width: 600px; /* Limit width for better readability */
            margin-top: 50px; /* Add some top margin */
        }
        .form-control {
            border-radius: 0; /* Remove default border-radius */
        }
        .form-label {
            font-weight: bold; /* Make form labels bold */
        }
        .btn-primary {
            background-color: #4CAF50; /* Greenish color for submit button */
            border: none;
            width: 100%;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: #45a049; /* Darker shade on hover/focus */
        }
        .toast-container {
            z-index: 9999; /* Ensure toast appears above other content */
        }
        .toast-body {
            background-color: #4CAF50;
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="header">
    <?php $active = "donate";
    include('head.php'); ?>
</div>

<div class="container">
    <h1 class="text-center mb-4">Donate Blood</h1>
    <form method="post">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="exampleInputName" name="full_name" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputPhone" class="form-label">Phone Number</label>
                    <input type="tel" name="phone_number" class="form-control" id="exampleInputPhone" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputAge" class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" id="exampleInputAge" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputGender" class="form-label">Gender</label>
            <select class="form-control" id="exampleInputGender" name="gender" required>
                <option value="Male" selected>Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputGroup" class="form-label">Blood Group</label>
            <select class="form-control" name="b_group" id="exampleInputGroup" required>
                <option value="A+" selected>A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputAddress" class="form-label">Address</label>
            <textarea class="form-control" name="address" id="exampleInputAddress" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            <?php echo $message; ?>
        </div>
    </div>
</div>

<br />
<br />
<br />
<?php include('footer.php'); ?>



<script>
    $(document).ready(function() {
        <?php if (!empty($message)) : ?>
            var toast = new bootstrap.Toast(document.getElementById('toast'))
            toast.show();
        <?php endif; ?>
    });

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


</body>
</html>
