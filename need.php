<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodbank";

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
    $reason = $_POST['reason'];

    $stmt = $conn->prepare("SELECT name, phone, address FROM donors WHERE blood_group = ?");
    $stmt->bind_param("s", $b_group);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $donors[] = $row;
        }
        if (empty($donors)) {
            $no_donors = true;
        }
        $stmt->close();
    } else {
        $message = "Error: " . $stmt->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Need Blood - BloodBank</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa; 
        }
        .container {
            max-width: 800px; 
            margin-top: 50px; 
        }
        .form-control {
            border-radius: 0; 
        }
        .form-label {
            font-weight: bold; 
        }
        .btn-primary {
            background-color: #DC3545; 
            border: none;
            width: 100%;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: #C82333; 
        }
        .toast-container {
            z-index: 9999; 
        }
        .toast-body {
            background-color: #DC3545;
            color: #fff;
            font-weight: bold;
        }
        .table {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php $active = "need"; include('head.php'); ?>
    </div>

    <div class="container text-center pt-5">
        <h1 class="text-danger">Need Blood</h1>
        <form method="post">
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputGroup" class="form-label">Select Blood Group</label>
                        <select class="form-control" id="exampleInputGroup" name="b_group" required>
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
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputReason" class="form-label">Reason for Blood Need</label>
                        <textarea class="form-control" name="reason" id="exampleInputReason" rows="3" required></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg mt-3">Search Donors</button>
                </div>
            </div>
        </form>
    </div>

    <?php if (!empty($donors)): ?>
        <div class="container mt-5">
            <h3 class="text-center mb-4">Available Donors</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($donors as $index => $donor): ?>
                        <tr>
                            <th scope="row"><?php echo $index + 1; ?></th>
                            <td><?php echo htmlspecialchars($donor['name']); ?></td>
                            <td><?php echo htmlspecialchars($donor['phone']); ?></td>
                            <td><?php echo htmlspecialchars($donor['address']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <?php if ($no_donors): ?>
        <div class="container mt-5">
            <div class="alert alert-warning text-center" role="alert">
                No donors found for the selected blood group.
            </div>
        </div>
    <?php endif; ?>

    <br />
<br />
<br />
    <?php include('footer.php'); ?>
    


    <script>
        $(document).ready(function(){
            <?php if ($no_donors): ?>
                var toast = new bootstrap.Toast(document.getElementById('no-donors-toast'));
                toast.show();
            <?php endif; ?>
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>
