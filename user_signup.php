<?php
    include("connection.php");

    if(isset($_POST['submit_signup'])) {
        $username = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];


        $check_query = "SELECT * FROM user_login WHERE email = '$email'";
        $check_result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_result) > 0) {
            echo '<script>
                alert("Email already exists. Please choose another email.");
                window.location.href = "login.php";
            </script>';
        } else {
            $insert_query = "INSERT INTO user_login (username, email, password) VALUES ('$username', '$email', '$password')";
            if(mysqli_query($conn, $insert_query)) {
                    echo '<script>alert("Sign up successful. You can now login.");
                    window.location.href = "login.php";                
                </script>';
                
            } else {
                echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
            }
        }
    }
?>
