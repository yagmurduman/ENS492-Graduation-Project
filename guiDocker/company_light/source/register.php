<?php
session_start();
include('config/db_connect.php');

// variable declaration
$username = "";
$email    = "";
$password = "";
$errors   = array();

// call the register() function if register_btn is clicked
if (isset($_POST['submit'])) {
    register();
}

// REGISTER USER
function register()
{
    // call these variables with the global keyword to make them available in function
    global $conn, $errors, $username, $email;

    // receive all input values from the form. Call the e() function
    // defined below to escape form values
    $username    =  $_POST['username'];
    $email       =  $_POST['email'];
    $password  =  $_POST['password'];

    // form validation: ensure that the form is correctly filled
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
        if (isset($_POST['user_type'])) {
            $user_type = $_POST['user_type'];
            $query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
            mysqli_query($conn, $query) or die(mysqli_error($conn));
            $_SESSION['success']  = "New user successfully created!!";
            header('location: index.php');
        } else {
            $query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
            mysqli_query($conn, $query) or die(mysqli_error($conn));

            // get id of the created user
            $logged_in_user_id = mysqli_insert_id($conn);

            $_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
            $_SESSION['success']  = "You are now logged in";
            header('location: index.php');
        }
    }
}

// return user array from their id
function getUserById($id)
{
    global $conn;
    $query = "SELECT * FROM users WHERE id=" . $id;
    $result = mysqli_query($conn, $query);

    $user = mysqli_fetch_assoc($result);
    return $user;
}

function display_error()
{
    global $errors;

    if (count($errors) > 0) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->

</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-color: #FFFFFF;">
            <div class="wrap-login100 p-t-50 p-b-90" style="background-color: #FFFFFF;">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="login100-form">
                    <span class="login100-form-title p-b-51">
                        Create Account
                    </span>

                    <div class="wrap-input100 m-b-16">
                        <input class="input100" type="text" name="email" placeholder="your@email.com" value="<?php echo $email ?>">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="wrap-input100 m-b-16">
                        <input class="input100" type="text" name="username" placeholder="username" value="<?php echo $username ?>">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="wrap-input100 m-b-16">
                        <input class="input100" type="password" name="password" placeholder="password" value="<?php echo $password ?>">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-17">
                        <button name="submit" class="login100-form-btn">
                            Sign up
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="index.php" class="txt2 hov1">
                            Back to Home
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <script src="js/main.js"></script>

</body>

</html>