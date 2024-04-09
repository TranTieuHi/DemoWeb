<?php 
    include("connection.php");
    session_start(); 

    if(isset($_POST['submit_login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']); 
        $password = mysqli_real_escape_string($conn, $_POST['password']); 

        $sql ="SELECT * FROM user_login WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->num_rows;

        if($email == 'admin@gmail.com' && $password == '123') {
            $_SESSION['admin'] = true;
            header("Location: admin.php"); 
            exit(); 
        } elseif($count == 1) {
            $row = $result->fetch_assoc();
            $username = $row['Username'];
            $_SESSION['Username'] = $username;
            header("Location: logined.php"); 
            exit(); 
        } else {
            $_SESSION['error'] = "Invalid password or email";
            header("Location: login.php?error=1"); 
            exit(); 
        }
    }
?>
