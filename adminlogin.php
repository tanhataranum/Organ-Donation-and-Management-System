<?php
session_start();

// Check if the admin is already logged in
if (isset($_SESSION['admin'])) {
    // Logout option
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
        unset($_SESSION['admin']);
        header("Location: home.php");
        exit;
    }

    // Redirect to admin page if logged in
    header("Location: admin.php");
    exit;
}

// Check login credentials
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials (use secure authentication mechanisms in a real application)
    if ($username === 'admin' && $password === 'organ@donation') {
        $_SESSION['admin'] = $username;
        header("Location: admin.php");
        exit;
    } else {
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <style>
        /* Your CSS styles here */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Light gray background */
        }

        header {
            background-color: #4e2a87;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
            width: 100%;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        form {
            background-color: purple; /* Blue background color */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #fff; /* White text color for labels */
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #ffffff; /* White button color */
            color: #007bff; /* Blue text color */
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        h2 {
            text-align: center;
            color: #fff; /* White text color */
        }

        p {
            color: red;
        }

        footer {
            background-color: #4e2a87;
            color: #fff;
            text-align: center;
            padding: 2rem;
            width: 100%;
        }

        footer ul {
            list-style: none;
        }

        footer ul li {
            display: inline;
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to Organ Donation Management System</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="donor.php">Donors</a></li>
                <li><a href="seeker.php">Seekers</a></li>
                <?php if (isset($_SESSION['admin'])) : ?>
                    <!-- If admin is logged in, show logout option -->
                    <li>
                        <form method="post" action="">
                            <input type="hidden" name="logout">
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                <?php else : ?>
                    <!-- If not logged in, show login option -->
                    <li><a href="admin.php">Admin</a></li>
                    <li><a href="contact.php">Contact</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <h2>Login</h2>
        <?php if (isset($error_message)) : ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>

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
