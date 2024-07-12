<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Blood Bank & Management - Admin Login</title>
  
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  
  <style>
    body {
      background-image: url('admin_image/blood-cells.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
    }
    .card {
      background-image: url('admin_image/glossy1.jpg');
      background-size: cover;
      background-position: center;
      border: none;
      box-shadow: 0px 0px 20px rgba(0,0,0,0.2);
    }
    .card-header {
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      text-align: center;
      padding: 10px;
    }
    .card-body {
      padding: 30px;
    }
    .form-control {
      border-radius: 25px;
    }
    .btn-primary {
      border-radius: 25px;
      padding: 12px 30px;
      font-size: 18px;
      font-weight: bold;
      background-color: #D2F015;
      border-color: #D2F015;
    }
    .btn-primary:hover {
      background-color: #C0E106;
      border-color: #C0E106;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-lg-6 col-md-8">
      <div class="card">
        <div class="card-header">
          <h1 class="mt-4 mb-3">Blood Bank & Management</h1>
          <h4 class="mb-4">Admin Login Portal</h4>
        </div>
        <div class="card-body">
          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
              <label for="username">Username <span style="color: red;">*</span></label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
              <label for="password">Password <span style="color: red;">*</span></label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="form-group text-center">
              <button type="submit" name="login" class="btn btn-primary">LOGIN</button>
            </div>
          </form>
          <?php
            include 'conn.php';
            if(isset($_POST["login"])){
              $username=mysqli_real_escape_string($conn,$_POST["username"]);
              $password=mysqli_real_escape_string($conn,$_POST["password"]);
              $sql="SELECT * from admin_info where admin_username='$username' and admin_password='$password'";
              $result=mysqli_query($conn,$sql) or die("Query failed.");
              if(mysqli_num_rows($result)>0) {
                while($row=mysqli_fetch_assoc($result)){
                  session_start();
                  $_SESSION['loggedin'] = true;
                  $_SESSION["username"]=$username;
                  header("Location: dashboard.php");
                }
              } else {
                echo '<div class="alert alert-danger" role="alert" style="font-weight: bold;"> Username and Password do not match!</div>';
              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
