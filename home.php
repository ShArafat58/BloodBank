<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .hero-banner {
            background-image: url('https://images.unsplash.com/photo-1621525466547-4ac135e85f59?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            height: 600px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .hero-banner h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .hero-banner p {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .hero-banner button {
            font-size: 1.2rem;
            padding: 10px 20px;
        }
        .content-section {
            padding: 50px 20px;
        }
        .content-section h2 {
            margin-bottom: 20px;
        }
        .section-title {
            padding: 10px;
            color: white;
            text-align: center;
        }
        .about-title {
            color: #28a745; /* Green */
        }
        .why-donate-title {
            color: #dc3545; /* Red */
        }
        .need-for-blood-title {
            background-color: #17a2b8; /* Cyan */
        }
        .blood-tips-title {
            background-color: #ffc107; /* Yellow */
            color: black;
        }
        .who-help-title {
            background-color: #6f42c1; /* Purple */
        }
    </style>
</head>

<body>
    <div class="header">
        <?php $active="home"; include('head.php'); ?>
    </div>

    <!-- Hero Banner Section -->
    <div class="hero-banner">
        <h1>Welcome to Our Blood Donation Website</h1>
        <p>Your donation can make a difference. Donate Blood, Save Lives</p>
        <button class="btn btn-primary" onclick="location.href='donate.php'">Donate Blood</button>
    </div>

    <!-- About Us Section -->
    <div class="content-section bg-light">
        <div class="container">
            <h2 class="about-title">About Us</h2>
            <p>We are a non-profit organization dedicated to ensuring a safe and adequate blood supply for patients in need. Our mission is to connect blood donors with patients, facilitate donations, and provide education and resources about the importance of blood donation.</p>
        </div>
    </div>

    <!-- Why Donate Blood Section -->
    <div class="content-section">
        <div class="container">
            <h2 class="why-donate-title">Why Donate Blood?</h2>
            <p>Donating blood is a simple and selfless act that can save lives. Blood donations are crucial for surgeries, cancer treatments, chronic illnesses, and traumatic injuries. By donating blood, you are helping to ensure that patients in need receive the vital transfusions they require.</p>
        </div>
    </div>

    <!-- Three Sections in One Row -->
    <div class="content-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="section-title need-for-blood-title">The Need for Blood</div>
                    <p>Every two seconds, someone in the U.S. needs blood. Blood is essential for surgeries, cancer treatment, chronic illnesses, and traumatic injuries. One donation can save up to three lives.</p>
                </div>
                <div class="col-md-4">
                    <div class="section-title blood-tips-title">Blood Tips</div>
                    <p>Eat iron-rich foods, stay hydrated, and avoid fatty foods before donating blood. These tips help ensure a successful donation and can make you feel better afterward.</p>
                </div>
                <div class="col-md-4">
                    <div class="section-title who-help-title">Who Could You Help?</div>
                    <p>Your blood donation can help a wide range of patients, including accident and burn victims, heart surgery and organ transplant patients, and those battling cancer.</p>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>
