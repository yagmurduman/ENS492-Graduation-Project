
<?php require('components/head.inc.php'); ?>
<?php include('dbconfig.php'); ?>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Login Form -->
    <form method="POST">
      <input type="text" id="email" class="inputarea" name="email" placeholder="Email">
      <input type="text" id="password"  name="password" class="inputarea" placeholder="Password">
      <input type="submit" name="lg" id="lg" class="buttonstyle" value="Sign In">
    </form>


<?php


// variable declaration
$username = "";
$password = "";
$errors   = array();

if (isset($_POST['lg'])) {
  
    login();
   
}

// LOGIN USER
function login()
{

    global $conn, $username, $errors;
    global $userid;
    $password = $_POST['password'];
     $username = $_POST['email'];
  
    // make sure form is filled properly
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  

    // attempt login if no errors on form
    // try' -- 
    if (empty($errors)) {
      
        $query = "SELECT * FROM users WHERE email='$username' and pass='$password'";

        $results = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if ($results && mysqli_num_rows($results) == 1) { // user found
            session_start(); 
            $logged_in_user = mysqli_fetch_array($results);
            $_SESSION['username'] = $logged_in_user['username'];
            $_SESSION["id"] =  $logged_in_user['uid'];
            $_SESSION["type"] = $logged_in_user['type'];
            $_SESSION["loggedin"] = 1;
            // Store data in session variables
            
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>
 

  </div>
</div>
<?php require('components/footer.inc.php'); ?>
 