<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodBank</title>
    <link rel="stylesheet" href="head.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar-custom {
            background-color: #61bd4f; /* Greenish color */
        }
        .navbar-brand {
            background: linear-gradient(90deg, #ff7e5f, #feb47b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            font-size: 1.5rem; /* Increase the font size */
        }
        .nav-link {
            color: white !important;
        }
        .nav-link.active {
            font-weight: bold;
        }
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        .navbar-nav {
            margin-left: auto; /* Align the nav items to the right */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">
      BloodBank
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0"> <!-- Changed 'me-auto' to 'ms-auto' for right alignment -->
        <li class="nav-item">
          <a <?php if($active=='home') echo "class='nav-link active'"; else echo "class='nav-link'"; ?> href="home.php">Home</a>
        </li>  
        <li class="nav-item">
          <a <?php if($active=='donate') echo "class='nav-link active'"; else echo "class='nav-link'"; ?> href="donate.php">Donate Blood</a>
        </li>
        <li class="nav-item">
          <a <?php if($active=='need') echo "class='nav-link active'"; else echo "class='nav-link'"; ?> href="need.php">Need Blood</a>
        </li>
        <li class="nav-item">
          <a <?php if($active=='contact') echo "class='nav-link active'"; else echo "class='nav-link'"; ?> href="contact.php">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>
