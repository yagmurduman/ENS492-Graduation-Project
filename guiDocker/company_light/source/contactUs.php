<?php
    // variable declaration
    session_start();
    include('config/db_connect.php');
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
            $query = "INSERT INTO tblcontact (name, email, content, subject) 
                        VALUES ('$name', '$email', '$subject', '$content')";
            $results = mysqli_query($conn, $query) or die(mysqli_error($conn));
            $_SESSION['contact']  = true;
        }
        else{
            $_SESSION['contact'] = false;
        }
        header('location: contact.php');
    }
    
?>