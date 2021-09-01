<?php
include('config/db_connect.php');
include('config/config_cont.php');
session_start();
if (isset($_GET['logout'])) {
    unset($_SESSION["user"]);
}
global $company_name, $address, $phone;

$email    = "";
$errors   = array();

if (isset($_POST['submit'])) {
  subscribe();
}

function subscribe()
{
  global $conn, $errors, $email;

  // receive all input values from the form. Call the e() function
  // defined below to escape form values
  $email = $_POST['subs-email'];
  if (empty($email)) {
    array_push($errors, "Email is required");
  }

  if (count($errors) == 0) {
    $query = "INSERT INTO subscription (email) VALUES('$email')";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if($result){
        $_SESSION['success']  = "New subscription successfully created!!";
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />

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
    <header class="masthead" style="background-image: url('<?php echo $img1_path; ?>')">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                            <h1> We are here to help
                            </h1>
                            <span class="subheading"></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section id="services" class="features-icons bg-light text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="icon-screen-desktop m-auto text-primary"></i></div>
                            <h3><?php echo $bullet_1; ?></h3>
                            <p class="lead mb-0"><?php echo $sent_1; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="icon-layers m-auto text-primary"></i></div>
                            <h3><?php echo $bullet_2; ?></h3>
                            <p class="lead mb-0"><?php echo $sent_2; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="icon-check m-auto text-primary"></i></div>
                            <h3><?php echo $bullet_3; ?></h3>
                            <p class="lead mb-0"><?php echo $sent_3; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="showcase">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('<?php echo $img2_path; ?>')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2><?php echo $title_1; ?></h2>
                        <p class="lead mb-0"><?php echo $sent_4; ?></p>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-6 text-white showcase-img" style="background-image: url('<?php echo $img3_path; ?>')"></div>
                    <div class="col-lg-6 my-auto showcase-text">
                        <h2><?php echo $title_2; ?></h2>
                        <p class="lead mb-0"><?php echo $sent_5; ?></p>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('<?php echo $img4_path; ?>')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2><?php echo $title_3; ?></h2>
                        <p class="lead mb-0"><?php echo $sent_6; ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="call-to-action text-white text-center">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto"><h2 class="mb-4" style="color: black">Join Our Newsletter</h2><p style="color: black">We will never share your adress with anyone.</p></div>
                    <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-row">
                                <div class="col-12 col-md-9 mb-2 mb-md-0"><input name="subs-email" class="form-control form-control-lg" type="text" value="<?php echo $email ?>" placeholder="Enter your email..." /></div>
                                <div class="col-12 col-md-3"><button class="btn btn-block btn-lg btn-success" name="submit" type="submit">Subscribe</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    

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