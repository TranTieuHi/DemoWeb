<?php

    $severname = "localhost";
    $username = "root";
    $db_name = "database1";
    $conn = new mysqli($severname, $username, "", $db_name);
    if( $conn->connect_error) {
        die("Connection failed" .$conn -> connect_error);
    }
    
?>