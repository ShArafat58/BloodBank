<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "bbms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $message = "Connection failed: " . $conn->connect_error;
    $donors  = [];
} else {
    $message = "";
    $donors  = [];
    $no_donors = false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $b_group     = $_POST['b_group'];
    // Get the search location coordinates from the hidden inputs.
    $search_lat  = $_POST['latitude'];
    $search_long = $_POST['longitude'];
    // Set the search radius (in kilometers)
    $radius = 20;
    
    // SQL query using the Haversine formula to calculate distance.
    $sql = "SELECT name, contact, address, latitude, longitude,
            (6371 * acos( cos( radians(?) ) * cos( radians(latitude) ) 
            * cos( radians(longitude) - radians(?) ) + sin( radians(?) ) 
            * sin( radians(latitude) ) )) AS distance
            FROM donor_details
            WHERE blood_group = ?
            HAVING distance < ?
            ORDER BY distance ASC";

    $stmt = $conn->prepare($sql);
    // Bind parameters: two occurrences of search_lat, search_long, blood group, and radius.
    $stmt->bind_param("dddsd", $search_lat, $search_long, $search_lat, $b_group, $radius);

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
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <!-- Leaflet Geocoder CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
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
    /* Map styling */
    #map {
      height: 300px;
      margin-bottom: 15px;
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
        <!-- Removed the Reason for Blood Need field -->
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">Search Your Location</label>
            <!-- The map will let the user pick a location -->
            <div id="map"></div>
          </div>
        </div>
      </div>
      <!-- Hidden inputs to store the search location coordinates -->
      <input type="hidden" id="latitude" name="latitude" required>
      <input type="hidden" id="longitude" name="longitude" required>
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
            <th scope="col">Distance (km)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($donors as $index => $donor): ?>
            <tr>
              <th scope="row"><?php echo $index + 1; ?></th>
              <td><?php echo htmlspecialchars($donor['name']); ?></td>
              <td><?php echo htmlspecialchars($donor['contact']); ?></td>
              <td><?php echo htmlspecialchars($donor['address']); ?></td>
              <td><?php echo round($donor['distance'], 2); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

  <?php if (isset($no_donors) && $no_donors): ?>
    <div class="container mt-5">
      <div class="alert alert-warning text-center" role="alert">
        No donors found for the selected blood group in your area.
      </div>
    </div>
  <?php endif; ?>

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
    // Initialize the map centered at a default location (for example, India)
    var map = L.map('map').setView([20.5937, 78.9629], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    // Initialize the geocoder control
    var geocoder = L.Control.geocoder({
      defaultMarkGeocode: false
    })
    .on('markgeocode', function(e) {
      var center = e.geocode.center;
      // Zoom into the selected location
      map.setView(center, 15);
      // Place or move the marker to the selected location
      if (marker) {
        marker.setLatLng(center);
      } else {
        marker = L.marker(center).addTo(map);
      }
      // Update the hidden latitude and longitude fields
      document.getElementById('latitude').value = center.lat;
      document.getElementById('longitude').value = center.lng;
    })
    .addTo(map);

    // Also allow users to click on the map
    map.on('click', function(e) {
      if (marker) {
        marker.setLatLng(e.latlng);
      } else {
        marker = L.marker(e.latlng).addTo(map);
      }
      document.getElementById('latitude').value = e.latlng.lat;
      document.getElementById('longitude').value = e.latlng.lng;
    });
  </script>
</body>
</html>
