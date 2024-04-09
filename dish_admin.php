<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/admin.css">
    <title>Admin</title>
    <style>
        .food-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .food-img {
            margin-right: 20px;
            flex: 0 0 200px;
        }

        .food-img img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }

        .food-details {
            flex: 1;
        }

        .food-details h2 {
            margin: 0;
            margin-bottom: 10px;
        }

        .food-details p {
            margin: 0;
            margin-bottom: 5px;
        }

        /* Style for checkboxes */
        .checkbox {
            margin-right: 10px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; /* Button background color */
            color: #fff; /* Button text color */
            text-decoration: none; /* Remove underline */
            border: none; /* Remove border */
            border-radius: 4px; /* Add border radius */
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* Hidden by default */
        .delete-checkbox {
            display: none;
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
            </a>
        </nav>
        <!-- End of Navbar -->

        <!-- Buttons -->
        <div>
            <button onclick="toggleDeleteCheckboxes()" class="button">Delete items</button>
            <a href="add_items.php" class="button">Add item</a>
        </div>
        <!-- End of Buttons -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                </div>
            </div>
            <!-- Items Container -->
            <div id="item-container">
                <!-- JavaScript data will be dynamically inserted here -->
            </div>
            <!-- End of Items Container -->
        </main>
    </div>

    <script type="module">
        import { foodItem } from "./scripts/food.js";

        // Function to display items
        function displayItems(items) {
            var container = document.getElementById("item-container");
            items.forEach(function (item) {
                var itemDiv = document.createElement("div");
                itemDiv.classList.add("food-item");
                itemDiv.innerHTML = `
                    <div class="food-img">
                        <img src="${item.img}" alt="${item.name}">
                    </div>
                    <div class="food-details">
                        <input type="checkbox" class="checkbox" name="delete-checkbox" value="${item.id}">
                        <h2>${item.name}</h2>
                        <p>ID: ${item.id}, Category: ${item.category}, Rating: ${item.rating}, Price: $${item.price}</p>
                        <p>Quantity: ${item.quantity}</p>
                    </div>
                `;
                container.appendChild(itemDiv);
            });
        }

        displayItems(foodItem);

        function toggleDeleteCheckboxes() {
            var deleteCheckboxes = document.querySelectorAll(".delete-checkbox");
            deleteCheckboxes.forEach(function (checkbox) {
                checkbox.style.display = checkbox.style.display === "none" ? "block" : "none";
            });
        }
    </script>
    <script src="admin.js"></script>
</body>

</html>
