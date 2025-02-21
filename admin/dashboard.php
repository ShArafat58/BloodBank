<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- jQuery, Popper, Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    #sidebar {
      position: relative;
      margin-top: -20px;
    }
    #content {
      position: relative;
      margin-left: 210px;
    }
    @media screen and (max-width: 600px) {
      #content {
        position: relative;
        margin-left: auto;
        margin-right: auto;
      }
    }
    .block-anchor {
      color: red;
      cursor: pointer;
    }
  </style>
</head>

<body style="color:black;">
  <?php
    include 'conn.php';
    include 'session.php';

    // Check if user is logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  ?>

  <!-- HEADER -->
  <div id="header">
    <?php include 'header.php'; ?>
  </div>

  <!-- SIDEBAR -->
  <div id="sidebar">
    <?php
      // Set the active link to "dashboard"
      $active = "dashboard";
      include 'sidebar.php'; 
    ?>
  </div>

  <!-- MAIN CONTENT -->
  <div id="content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Page Title -->
        <div class="row">
          <div class="col-md-12 lg-12 sm-12">
            <h1 class="page-title">Dashboard</h1>
          </div>
        </div>
        <hr>

        <!-- Example Panel: Blood Donors Available -->
        <div class="row">
          <div class="col-md-3">
            <div class="panel panel-default panel-info" style="border-radius:50px;">
              <div class="panel-body panel-info bk-primary text-light" style="background-color:#D6EAF8; border-radius:50px">
                <div class="stat-panel text-center">
                  <?php
                    // Query donor_details to count donors
                    $sql = "SELECT * FROM donor_details";
                    $result = mysqli_query($conn, $sql) or die("Query failed.");
                    $row = mysqli_num_rows($result);
                  ?>
                  <div class="stat-panel-number h1">
                    <?php echo $row; ?>
                  </div>
                  <div class="stat-panel-title text-uppercase">
                    BLOOD DONORS AVAILABLE
                  </div>
                  <br>
                  <button class="btn btn-danger" onclick="window.location.href = 'donor_list.php';">
                    Full Detail <i class="fa fa-arrow-right"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- You can add more panels here if needed -->
        </div>

        <!-- 
          If you previously had a "Message" button on the dashboard,
          remove it so the only place to access "Message" is via the sidebar.
        -->
        <!--
        <div class="row" style="margin-top:20px;">
          <div class="col-md-3">
            <button class="btn btn-primary btn-block" onclick="window.location.href='message.php';">
              Message
            </button>
          </div>
        </div>
        -->

      </div> <!-- container-fluid -->
    </div> <!-- content-wrapper -->
  </div> <!-- #content -->

  <?php
    // If user is NOT logged in:
    } else {
      echo '<div class="alert alert-danger"><b>Please Login First To Access Admin Portal.</b></div>';
  ?>
      <form method="post" action="login.php" class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-8 col-sm-offset-4" style="float:left">
            <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
          </div>
        </div>
      </form>
  <?php
    }
  ?>
</body>
</html>
