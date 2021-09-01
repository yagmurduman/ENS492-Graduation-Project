<?php
    // cconnect to database
    $company_name = "helpIT";
    $address = "78432 Franecki Mews Swaniawskishire Netherlands, NL  Europe";
    $phone = "+31 63 250 1418";

    $host = 'db';
    $user = 'root';
    $pass = 'test';
    $conn = mysqli_connect($host, $user, $pass);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    mysqli_select_db($conn,'multi_login');

    $query_file = 'config/tables.txt';
   
    $fp = fopen($query_file, 'r');
    $sql = fread($fp, filesize($query_file));
    fclose($fp); 
    
    $retval = mysqli_multi_query($conn, $sql);
    while(mysqli_next_result($conn)){;}
   
    if(! $retval ) {
        die('Could not create table: ' . mysqli_error($conn));
    }
    
?>