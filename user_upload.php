<?php
    
    function capitalize_word($str) {
        return ucfirst(strtolower(preg_replace('/[^a-zA-z]/','',$str)));
    }
    
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

    $allowed =  array('csv');
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    
    if(!in_array($ext,$allowed) ) {
        echo "Please Upload Files With .CSV Extenion Only!";
    }
    else {
        if(file_exists($file_name)) {
            //Open the csv file for reading
            $file = fopen($file_name, "r");     
        
            //Read the first line(header) and ignore it
            fgets($file);

            $deleterecords = "TRUNCATE TABLE users"; //empty the table of its current records
            mysqli_query($mysqli, $deleterecords);

            while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {
                
                $name = $data[0];  
                $sur_name = $data[1];
                $email = $data[2];
                $validate_email ="";

                //Validation for name and surname
                $validate_name = capitalize_word($name);
                $validate_surname = capitalize_word($sur_name);            

                //Validation for email format
                if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $validate_email = $email;
                }               

                $sql = "INSERT into users(name,surname,email) values('$validate_name','$validate_surname','$validate_email')";
                mysqli_query($mysqli, $sql);
            }
        }
        else {
            echo "File is not existing in the main project";
        }
    }
        

?>