<?php
include("connection.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $username = mysqli_real_escape_string($conn, $_POST['Username']);
    $password = mysqli_real_escape_string($conn, $_POST['Password']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $SDT = mysqli_real_escape_string($conn, $_POST['SDT']);
    
    // SQL query to update user profile
    $sql = "UPDATE user_login SET Username = '$username', Password = '$password', SDT = '$SDT' WHERE Email = '$email'";

    // Execute the query and handle errors
    if (mysqli_query($conn, $sql)) {
        
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
