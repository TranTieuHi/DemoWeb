<?php
        include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles\login.css">
    <title></title>
</head>

<body>
    <script>
        // JavaScript to display the pop-up message
        window.onload = function() {
            // Get the 'error' query parameter from the URL
            var urlParams = new URLSearchParams(window.location.search);
            var error = urlParams.get('error');

            // If 'error' parameter is present and set to 1, display the pop-up
            if(error === '1') {
                alert("Invalid password or email"); // Display the pop-up message
            }
        };
    </script>
    
    <div class="container" id="container">
        <div action= "" class="form-container sign-up">
            <form action="user_signup.php" method="POST"> <!-- Assuming signup.php is the PHP script to handle sign up -->
                <h1>Create Account</h1>
        
                <input type="text" name="name" placeholder="Name"> <!-- PHP added: name attribute -->
                <input type="email" name="email" placeholder="Email"> <!-- PHP added: name attribute -->
                <input type="password" name="password" placeholder="Password"> <!-- PHP added: name attribute -->
                <button type="submit" name = "submit_signup">Sign Up</button>
            </form>
        </div>
        <div  class="form-container sign-in">
            <form action="user_login.php" method="POST"> <!-- Assuming signin.php is the PHP script to handle sign in -->
                <h1>Sign In</h1>
                <input type="email" name="email" placeholder="Email"> <!-- PHP added: name attribute -->
                <input type="password" name="password" placeholder="Password"> <!-- PHP added: name attribute -->
                <button type="submit" name = "submit_login" >Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="login.js"></script>
</body>

</html>
