<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {
    $fullname = $_POST['fullname'];
    $contactno = $_POST['contactno'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // You can add code here to save the message to the database or send it via email

    $message_sent = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact Us - BloodBank</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .gradient-text {
            color: #ff7e5f; /* Adjust color as needed */
            font-weight: bold;
        }
        .section-title {
            color: #00695c; /* Adjust color as needed */
            font-weight: bold;
        }
        .contact-info {
            background-color: #f8f9fa; /* Light gray background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .contact-info h2 {
            color: #00695c; /* Dark green */
            font-weight: bold;
            margin-bottom: 15px;
        }
        .contact-info h4 {
            color: #343a40; /* Dark gray */
            font-weight: bold;
        }
        .contact-info a {
            color: #007bff; /* Blue */
            text-decoration: none;
        }
        .contact-info a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php $active = "contact"; include('head.php'); ?>
    </div>

    <div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;">
        <div class="container">
            <div id="content-wrap" style="padding-bottom:50px;">
                <h1 class="mt-4 mb-3 gradient-text">Contact</h1>
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <h3 class="section-title">Send us a Message</h3>
                        <form method="post">
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Full Name:</label>
                                    <input type="text" class="form-control" id="name" name="fullname" required>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Phone Number:</label>
                                    <input type="tel" class="form-control" id="phone" name="contactno" required>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Email Address:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Message:</label>
                                    <textarea rows="4" cols="100" class="form-control" id="message" name="message" required maxlength="999" style="resize:none"></textarea>
                                </div>
                            </div>
                            <button type="submit" name="send" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="contact-info">
                            <h2 class="section-title">Contact Details</h2>
                            <br>
                            <p>
                                <h4><strong>Address:</strong> Siddeshwari, Dhaka</h4>
                            </p>
                            <p>
                                <h4><strong>Contact Number:</strong> +880-12345678</h4>
                            </p>
                            <p>
                                <h4><strong>Email:</strong> <a href="mailto:shahriararafat20@gmail.com">shahriarhossain20@gmail.com</a></h4>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="success-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                Message sent successfully!
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>


    <script>
        $(document).ready(function() {
            <?php if (isset($message_sent) && $message_sent): ?>
            var toast = new bootstrap.Toast(document.getElementById('success-toast'));
            toast.show();
            <?php endif; ?>
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>
