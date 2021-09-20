<?php
    
    //Database connection 
    $host_name = readline('Enter Host Name: ');
    $db_user = readline('Enter Database User: ');
    $db_password = readline('Enter Database Password: ');
    $db_name = readline('Enter Database Name: ');
    $file_name = readline('Enter File Name: ');

    $mysqli = new mysqli($host_name,$db_user,$db_password,$db_name);

    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    
    

?>