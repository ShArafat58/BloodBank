<?php
include 'header.php';

$query = "SELECT * FROM donor_details";
$result = mysqli_query($conn, $query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $b_group = $_POST['b_group'];

    if( $b_group == "All") {
        $query = "SELECT * FROM donor_details";
    } else {
        $query = "SELECT * FROM donor_details WHERE blood_group = '$b_group'";
    }

    $result = mysqli_query($conn, $query);

}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Donor List</title>
    <style>
        .form-container {
            height: 20vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #sidebar{position:relative;margin-top:-20px}
#content{position:relative;margin-left:210px; color: #000}
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
$active="list";
include 'sidebar.php'; ?>

</div>
<div id="content">
    <div class="container mt-5">
        <h3 class="text-center mb-4">Available Donors</h3>

        <div class="container form-container">
        <form method="post" class="row g-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputGroup" class="form-label">Select Blood Group</label>
                    <select class="form-control" id="exampleInputGroup" name="b_group" required>
                        <option value="All">All</option>
                        <option value="A+">A+</option>
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
            <div class="col-md-3 d-flex align-items-end">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg mt-6">Search Donors</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </form>
    </div>


        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Blood Group</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Age</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <th scope="row"><?php echo $row['id']; ?></th>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['blood_group']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td>
                            <form method="POST" action="delete.php" 
                            onsubmit="return confirm('Are you sure you want to delete this donor?');">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>

</body>

</html>