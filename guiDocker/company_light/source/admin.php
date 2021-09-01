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
<html lang="en-US">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Log In</title>
    <link rel='stylesheet' id='dashicons-css' href='wp-includes/css/dashicons.min.css?ver=5b0068cdc760022ab9b0ea08a7d62c8d' type='text/css' media='all' />
    <link rel='stylesheet' id='buttons-css' href='wp-includes/css/buttons.min.css?ver=5b0068cdc760022ab9b0ea08a7d62c8d' type='text/css' media='all' />
    <link rel='stylesheet' id='forms-css' href='wp-admin/css/forms.min.css?ver=5b0068cdc760022ab9b0ea08a7d62c8d' type='text/css' media='all' />
    <link rel='stylesheet' id='l10n-css' href='wp-admin/css/l10n.min.css?ver=5b0068cdc760022ab9b0ea08a7d62c8d' type='text/css' media='all' />
    <link rel='stylesheet' id='login-css' href='wp-admin/css/login.min.css?ver=5b0068cdc760022ab9b0ea08a7d62c8d' type='text/css' media='all' />
    <meta name='robots' content='noindex,noarchive' />
    <meta name='referrer' content='strict-origin-when-cross-origin' />
    <meta name="viewport" content="width=device-width" />
</head>

<body class="login js login-action-login wp-core-ui  locale-en-us" data-new-gr-c-s-check-loaded="14.988.0" data-gr-ext-installed="">
    <script type="text/javascript">
        document.body.className = document.body.className.replace('no-js', 'js');
    </script>
    <div id="login">
        <h1><a href="https://wordpress.org/">Powered by WordPress</a></h1>

        <form name="loginform" id="loginform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <p>
                <label for="user_login">Username or Email Address</label>
                <input type="text" name="username" id="user_login" class="input" value="" size="20" autocapitalize="off">
            </p>

            <div class="user-pass-wrap">
                <label for="user_pass">Password</label>
                <div class="wp-pwd">
                    <input type="password" name="password" id="user_pass" class="input password-input" value="" size="20">
                    <button name="submit" type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="Show password">
                        <span class="dashicons dashicons-visibility" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            <p class="submit">
                <input type="submit" name="submit" id="wp-submit" class="button button-primary button-large" value="Log In">
            </p>
        </form>

        <p id="backtoblog"><a href="index.php">
                ← Back to Home </a></p>
    </div>

</body>