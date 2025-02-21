<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "bbms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $message = "Connection failed: " . $conn->connect_error;
    $status  = "error";
} else {
    $message = "";
    $status  = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name         = $_POST['full_name'];
    $email        = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $age          = $_POST['age'];
    $gender       = $_POST['gender'];
    $b_group      = $_POST['b_group'];
    // Retrieve the geocoded address (optional) and coordinates
    $address      = $_POST['address'];
    $latitude     = $_POST['latitude'];
    $longitude    = $_POST['longitude'];
    $id           = NULL;

    if ($age >= 18) {
        // Make sure the SQL statement includes the new columns
        $stmt = $conn->prepare("INSERT INTO donor_details (id, name, email, contact, age, blood_group, address, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        // Note: "isssissddd" corresponds to: integer, string, string, string, integer, string, string, double, double
        $stmt->bind_param("isssissdd", $id, $name, $email, $phone_number, $age, $b_group, $address, $latitude, $longitude);

        if ($stmt->execute()) {
            $message = "Successfully added donor!";
            $status  = "success";
        } else {
            $message = "Error: " . $stmt->error;
            $status  = "error";
        }
        $stmt->close();
    } else {
        $message = "Age should be 18+.";
        $status  = "error";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BloodBank - Donate Blood</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <!-- Leaflet Geocoder CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <style>
    body { background-color: #f8f9fa; }
    .container { max-width: 600px; margin-top: 50px; }
    .form-control { border-radius: 0; }
    .form-label { font-weight: bold; }
    .btn-primary { background-color: #4CAF50; border: none; width: 100%; }
    .btn-primary:hover, .btn-primary:focus { background-color: #45a049; }
    /* Set the height of the map */
    #map { height: 300px; margin-bottom: 15px; }
  </style>
</head>
<body>
  <div class="header">
    <?php $active = "donate"; include('head.php'); ?>
  </div>

  <div class="container">
    <h1 class="text-center mb-4">Donate Blood</h1>
    <?php if (!empty($message)) : ?>
      <div class="alert alert-<?php echo $status == 'success' ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
        <?php echo $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <form method="post">
      <!-- Other form fields (name, email, phone, age, gender, blood group) go here -->
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
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" required>
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

      <!-- Map container and geocoder -->
      <div class="form-group">
        <label class="form-label">Search & Select Your Location</label>
        <div id="map"></div>
      </div>

      <!-- Hidden inputs to store address and coordinates -->
      <input type="hidden" id="latitude" name="latitude" required>
      <input type="hidden" id="longitude" name="longitude" required>
      <!-- Optional: store the address string if you want -->
      <input type="hidden" id="address" name="address">

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <br /><br /><br />
  <?php include('footer.php'); ?>

  <!-- jQuery and Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <!-- Leaflet Control Geocoder JS -->
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
  <script>
    // Initialize the map centered at a default location (e.g., India)
    var map = L.map('map').setView([20.5937, 78.9629], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    // Initialize the geocoder control and add it to the map
    var geocoder = L.Control.geocoder({
      defaultMarkGeocode: false
    })
    .on('markgeocode', function(e) {
      var center = e.geocode.center;
      // Zoom the map to the result
      map.setView(center, 15);

      // Place (or move) the marker to the selected location
      if (marker) {
        marker.setLatLng(center);
      } else {
        marker = L.marker(center).addTo(map);
      }
      // Update the hidden fields with latitude and longitude
      document.getElementById('latitude').value = center.lat;
      document.getElementById('longitude').value = center.lng;
      // Optionally update the address field with the geocoded name
      document.getElementById('address').value = e.geocode.name;
    })
    .addTo(map);

    // Additionally, allow users to click on the map to select a location
    map.on('click', function(e) {
      if (marker) {
        marker.setLatLng(e.latlng);
      } else {
        marker = L.marker(e.latlng).addTo(map);
      }
      document.getElementById('latitude').value = e.latlng.lat;
      document.getElementById('longitude').value = e.latlng.lng;
      // You might also use a reverse geocoding service here to update the address field.
    });
  </script>
</body>
</html>
