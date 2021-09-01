<?php
include('config/db_connect.php');
session_start();

// variable declaration
$username = "";
$password = "";
$errors   = array();

if (isset($_POST['submit'])) {
	login();
}

// LOGIN USER
function login()
{
	global $conn, $username, $errors;

	// grap form values
	$username = $_POST['username'];
	$password = $_POST['password'];

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form 
	if (empty($errors)) {

		$query = "SELECT * FROM users WHERE username='$username' " . 
			"and password='$password'";
		$results = mysqli_query($conn, $query) or die(mysqli_error($conn));

		if (mysqli_num_rows($results) > 0) { // user found
			$logged_in_user = mysqli_fetch_array($results);
			$_SESSION['user'] = $logged_in_user;
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');
		} else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="css/util.css">
	<link rel="stylesheet" href="css/main.css">
	<!--===============================================================================================-->

</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-color: #FFFFFF;">
			<div class="wrap-login100 p-t-50 p-b-90" style="background-color: #FFFFFF;">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="login100-form flex-sb flex-w">
					<span class="login100-form-title p-b-51">
						Account Login
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username" value="<?php echo $username ?>">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button name="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center">
						<span class="txt1">
							Don't have an account?
						</span>

						<a href="register.php" class="txt2 hov3">
							Sign up
						</a>
					</div>
					<div class="text-center">
						<a href="index.php" class="txt2 hov3">
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
	<script src="js/main.js"></script>

</body>

</html>
