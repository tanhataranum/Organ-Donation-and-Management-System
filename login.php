<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    // Redirect based on the user's role
    switch ($_SESSION['role']) {
        case 'seeker':
            header("Location: seeker.php");
            exit();
        case 'donor':
            header("Location: donor.php");
            exit();
        // Add more cases for other roles if needed
        default:
            header("Location: home.php");
            exit();
    }
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Collect form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = new mysqli('localhost', 'root', '', 'idp_project');
    $errors = array();

    // Check if the username and password match the information in the database
    $stmt = $conn->prepare("SELECT password, role FROM registration WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword, $role);
        $stmt->fetch();

        if ($password == $hashedPassword) {
            // Password is correct, set session variables
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            // Redirect based on the user's role
             // Redirect to the home page
             header("Location: home.php");
             exit();
         } else {
             $errors[] = "Incorrect password.";
         }
     } else {
         $errors[] = "Username not found.";
     }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <style>
        /* Apply styles to the body */
        body {
            background-color: ; /* Light gray background color */
            font-family: Arial, sans-serif;
        }

        /* Style the login container */
        .login-container {
            width: 400px; /* Set the width of the login container */
            margin: 20px auto; /* Center the container horizontally */
            padding: 20px;
            background-color: purple; /* Purple background color */
            border-radius: 20px; /* Add border radius for rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
        }

        /* Style the login form */
        .login-form {
            color: #fff; /* White text color */
        }

        /* Style form elements */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            margin-bottom: 5px;
            color: #fff; /* White text color for labels */
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        /* Style the login button */
        button {
            background-color: #f2f2f2; /* Green button color */
            color: black; /* White text color */
            padding: 8px 15px; /* Adjusted padding for a smaller button */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        /* Style links */
        a {
            color: #fff; /* White text color for links */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }


    </style>
    <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
    <!-- Login Page Header -->
    <header>
        <h1>Organ Donation Management System</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="donor.php">Donors</a></li>
                <li><a href="seeker.php">Seekers</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Login Page Content -->
        <div class="login-container">
            <div class="login-form">
                <h2>Login</h2>
                <form method="post" action=""> <!-- Added method and action attributes -->
                    <?php
                        // Your existing PHP code for error handling
                        if (!empty($errors)) {
                            echo '<div style="color: red;">';
                            foreach ($errors as $error) {
                                echo $error . "<br>";
                            }
                            echo '</div><br/>';
                        }
                    ?>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="role">Select Role:</label>
                        <select id="role" name="role">
                            <option value="donor">Donor</option>
                            <option value="seeker">Seeker</option>
                        </select>
                    </div>

                    <button type="submit" name="submit">Log In</button>
                </form>
                <p>Don't have an account? <a href="registration.php">Sign Up</a></p>
            </div>
        </div>


    <!-- Home Page Footer -->
    <footer>
    <div class="footer-container">
        <div class="footer-row">
            <ul style="text-align: center; text-decoration: underline;">
            <li><a href="privacy_policy.php" onclick="openPopup(); return false;" style="color: #fff; font-weight: bold;">Privacy Policy</a></li>
            <li><a href="terms.php" onclick="openPopup(); return false;" style="color: #fff; font-weight: bold;"> Terms of Service</a></li>
                <li><a href="contact.php" style="color: #fff; font-weight: bold;">Contact</a></li>
            </ul>
        </div>
        <div class="footer-row" style="text-align: center;">
            <p>&copy; 2023 Organ Donation Management System</p>
        </div>
    </div>
</footer>
</body>
</html>
