<?php
// variable declaration
session_start();
include('config/db_connect.php');
$email    = "";
$errors   = array();

// call the register() function if register_btn is clicked
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
        mysqli_query($conn, $query) or die(mysqli_error($conn));
        $_SESSION['success']  = "New subscription successfully created!!";
    }
}

?>