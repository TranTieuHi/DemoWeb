<?php
    // Include the connection file
    include("connection.php");

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if form fields are set
        if (isset($_POST['itemName'], $_POST['itemCategory'], $_POST['itemRating'], $_POST['itemPrice'])) {
            // Get form data and sanitize inputs
            $itemName = mysqli_real_escape_string($conn, $_POST['itemName']);
            $itemCategory = mysqli_real_escape_string($conn, $_POST['itemCategory']);
            $itemCategory= strtolower($itemCategory);
            $itemRating = (float)$_POST['itemRating']; // Type cast to float
            $itemPrice = (float)$_POST['itemPrice']; // Type cast to float

            // File upload handling
            $targetDirectory = "img/{$itemCategory}/"; // Specify the directory to store uploaded files
            $targetFile = $targetDirectory . basename($_FILES["itemImage"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["itemImage"]["tmp_name"]);
            if ($check !== false) {
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "<script>alert('Sorry jpg, png, jpeg, gif allowed');</script>";;
                    $uploadOk = 0;
                }
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            
            // Check if item name already exists
            $checkQuery = "SELECT * FROM Dish WHERE name = ?";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bind_param("s", $itemName);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            
            if ($checkResult->num_rows > 0) {
                echo "<script>alert('Item name already exists. Please choose a different name.');</script>";
            } else {
                // Insert data into database
                $sql = "INSERT INTO Dish (name, rating, price, img, Catogries) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssdss", $itemName,  $itemRating, $itemPrice, $targetFile, $itemCategory); 

                if ($stmt->execute() === TRUE) {
                    echo "<script>alert('add item successfully.');</script>";
                    include("food_write.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $stmt->close();
            }
        } else {
            echo "Please fill all the required fields.";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin.css">
    <title>Admin</title>
    <style>
        /* Your existing CSS styles */

        /* Additional styles for the form */
        .add-item-form {
            margin-top: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
        }

        .add-item-form label {
            display: block;
            margin-bottom: 10px;
        }

        .add-item-form input[type="text"],
        .add-item-form input[type="number"],
        .add-item-form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    
        <!-- Sidebar -->
        <div class="sidebar">
            <ul class="side-menu">
                    <li><a href="admin.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
                    <li><a href="#"><i class='bx bx-group'></i>Users</a></li>
                    <li><a href="dish_admin.php"><i class='bx bx-group'></i>Dish</a></li>
                </ul>
                <ul class="side-menu">
                    <li>
                        <a href="login.php" class="logout">
                            <i class='bx bx-log-out-circle'></i>
                            Logout
                        </a>
                    </li>
                </ul>
        </div>
        <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
                    <form action="#">
                        <div class="form-input">
                            <input type="search" placeholder="Search...">
                            <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                        </div>
                    </form>
                    <input type="checkbox" id="theme-toggle" hidden>
                    <label for="theme-toggle" class="theme-toggle"></label>
                    <a href="#" class="notif">
                        <i class='bx bx-bell'></i>
                        <span class="count">12</span>
                    </a>
                    <a href="#" class="profile">
                        <img src="images/logo.png">
        </nav>
        <!-- End of Navbar -->

        <!-- Buttons -->
        <div>
            <button onclick="toggleDeleteCheckboxes()" class="button">Delete items</button>
            <a href="add_items.php" class="button">Add item</a>
        </div>
        <!-- End of Buttons -->

        <!-- Add Item Form -->
        <div class="add-item-form">
            <h2>Add New Item</h2>
            <form id="addItemForm" enctype="multipart/form-data" action="add_items.php" method="post">
                <label for="itemName">Name:</label>
                <input type="text" id="itemName" name="itemName" required>

                <label for="itemCategory">Category:</label>
                <input type="text" id="itemCategory" name="itemCategory" required>

                <label for="itemRating">Rating:</label>
                <input type="number" id="itemRating" name="itemRating" min="0" max="5" step="0.1" required>

                <label for="itemPrice">Price:</label>
                <input type="number" id="itemPrice" name="itemPrice" min="0" step="0.01" required>

                <label for="itemImage">Image:</label>
                <input type="file" id="itemImage" name="itemImage" accept="image/*" required>

                <button type="submit">Add Item</button>
            </form>
        </div>
        <!-- End of Add Item Form -->
    </div>

</body>

</html>
