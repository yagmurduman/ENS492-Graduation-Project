<?php
include('config/db_connect.php');
include('config/config_cont.php');
session_start();
if (isset($_GET['logout'])) {
    unset($_SESSION["user"]);
}
$name = "";
$email    = "";
$subject = "";
$content = "";
$errors   = array();
$_SESSION['contact'] = false;


if (isset($_POST['send_message'])) {
    sendmessage();
}

function sendmessage()
{
    global $conn, $errors, $email, $subject, $content, $name;

    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $name = $_POST['name'];

    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($subject)){
        array_push($errors, "Subject is required");
    }
    if (empty($content)){
        array_push($errors, "Content is required");
    }
    if (empty($name)){
        array_push($errors, "Name is required");
    }

    if (count($errors) == 0) {
        $query = "INSERT INTO tblcontact (name, email, content, subject) VALUES ('$name', '$email', '$content', '$subject')";
        $results = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if($results){
            $_SESSION['success']  = "Message has been sent!!";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $company_name; ?></title>
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/styles.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <?php include('components/navbar.php'); ?>
<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>Contact</h2>
            </div>

            <div class="row" >

                <div class="col-lg-6">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-box">
                                <i class="bx bx-map"></i>
                                <h3>Our Address</h3>
                                <p><?php echo $address; ?></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="info-box mt-4">
                                <i class="bx bx-phone-call"></i>
                                <h3>Call Us</h3>
                                <p><p> <?php echo $phone; ?> </p></p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="php-email-form">
                        <div class="form-row">
                            <div class="col form-group">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" />
                            </div>
                            <div class="col form-group">
                                <input type="text" class="form-control" name="email" placeholder="Your Email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" placeholder="Subject"  />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="content" rows="5" placeholder="Message"></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="loading">Loading</div>
                            <?php if ($_SESSION['contact']): ?>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            <?php else: ?>
                                <div class="error-message"></div>
                            <?php endif ?>
                        </div>
                        <div class="text-center"><button type="submit" name="send_message">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->
    <?php include('components/footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="assets/vendor/counterup/counterup.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/js/main.js"></script>

</html>