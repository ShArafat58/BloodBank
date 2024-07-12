<?php
include 'header.php';
include 'conn.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $blood_group = $_POST['blood_group'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $id = NULL;

    $query = 'INSERT INTO donor_details (id, name, age, blood_group, email, contact, address) 
          VALUES (?, ?, ?, ?, ?, ?, ?)';

    $stmt = $conn->prepare($query);

    $stmt->bind_param('isissss', $id, $name, $age, $blood_group, $email, $contact, $address);

    if ($stmt->execute()) {
        $message = "Successfully added donor!";
        $status = "success";
    } else {
        $message = "Error: " . mysqli_error($conn);
        $status = "error";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Add Donor</title>
    <style>
        .toast-container {
            z-index: 9999;
            width: 25rem;
            margin-top: 1rem;
        }

        .toast-body {
            padding: 2rem;
            background-color: #4CAF50;
            color: #fff;
            font-weight: bold;
        }
    </style>
    <style>

#sidebar{position:relative;margin-top:-20px}
#content{position:relative;margin-left:210px}
@media screen and (max-width: 600px) {
  #content {
    position:relative;margin-left:auto;margin-right:auto;
  }
}
</style>
</head>

<body>

<div id="sidebar">
<?php
$active="add";
include 'sidebar.php'; ?>

</div>
<div id="content">
    <div class="container">
        <h2>Add Donor</h2>
        <form method="post">
            <div class="form-group">
                <label for="name" style="color: #000;">Full Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="blood_group" style="color: #000;">Blood Group:</label>
                <input type="text" class="form-control" id="blood_group" name="blood_group" required>
            </div>
            <div class="form-group">
                <label for="contact" style="color: #000;">Mobile Number:</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
            </div>
            <div class="form-group">
                <label for="email" style="color: #000;">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address" style="color: #000;">Address:</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            <div class="form-group">
                <label for="age" style="color: #000;">Age:</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>




            <button type="submit" class="btn btn-primary" name="submit">Add Donor</button>
        </form>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                <?php echo $message; ?>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function() {
            <?php if (!empty($message)) : ?>
                var toast = new bootstrap.Toast(document.getElementById('toast'));
                toast.show();
            <?php endif; ?>
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>