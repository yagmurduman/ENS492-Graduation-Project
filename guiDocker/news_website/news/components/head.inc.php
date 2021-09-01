<?php

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == 1)
{
}
else{
    $_SESSION["type"] = 2;
    $_SESSION["loggedin"]=0;
}
if(!isset($_SESSION)) 
{session_start();} 

if (isset($_POST['logout'])) {
  // Destroy the session.
  session_destroy();
  $_SESSION["type"] = 2;
  $_SESSION["loggedin"] = 0;
  // Redirect to login page
  header('location: index.php');
}
if (isset($_POST['profile'])) {
  if($_SESSION["type"]==0){
    header("location: admin.php"); }
  elseif($_SESSION["type"]==1){
    $uid= $_SESSION["id"];
    header("location: profile.php?uid=$uid");
      }
    }
    if (isset($_POST['login'])) {
      // Destroy the session.
      header('location: login.php');
    }?>
<?php include('config.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet" />
        <meta name="viewport" content="width=device-width" />   
        <title><?php echo $webtitle ?></title>
        <link rel="icon" href="img/icon.png">
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">-->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
     
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style> @import "styles.css";</style>


  </head>
  
  <body style="overflow: auto;background:<?php echo $body_backround ?> !important;">
    
