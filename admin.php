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
} else {
    // Redirect to login page if not logged in
    header("Location: adminlogin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>
        /* Your existing styles here */

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa; /* Light gray background */
        }

        header {
            background-color: #4e2a87;
            color: #fff;
            padding: 20px;
            text-align: center;
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
            display: inline-block;
        }

        section {
            width: 25%;
            float: left;
            padding: 20px;
            box-sizing: border-box;
            margin-top: 50px; /* Add margin to elevate the sections */
            text-align: center;
        }

        section a {
            display: block;
            text-decoration: none;
            color: #4e2a87;
            font-weight: bold;
            margin-bottom: 10px;
        }

        h2 {
            color: #4e2a87;
        }

        footer {
            background-color: #4e2a87;
            color: #fff;
            text-align: center;
            padding: 10px;
            clear: both;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        footer {
            background-color: #4e2a87;
            color: #f8f9fa;
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
            color: #fff; /* Set link color to white */
            font-weight: bold; /* Make links bold */
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
                <li><a href="admin.php">Admin</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li>
                    <form method="post" action="">
                        <input type="hidden" name="logout">
                        <a href="admin_logout.php">Logout</a>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <section>
        <a href="manage_doctor.php">
            <img src="doctor.jpg" alt="Manage Doctor">
            <h2>Manage Doctor</h2>
        </a>
    </section>

    <section>
        <a href="manage_user.php">
            <img src="user.jpg" alt="Manage User">
            <h2>Manage User</h2>
        </a>
    </section>

    <section>
        <a href="manage_hospital.php">
            <img src="hospital1.jpg" alt="Manage Hospital">
            <h2>Manage Hospital</h2>
        </a>
    </section>

    <section>
        <a href="manage_blood_bank.php">
            <img src="blood1.jpg" alt="Manage Blood Bank">
            <h2>Manage Blood Bank</h2>
        </a>
    </section>

    <footer>
        <div class="footer-container">
            <ul>
                <li><a href="#" style="color: #fff; font-weight: bold;">Privacy Policy</a></li>
                <li><a href="#" style="color: #fff; font-weight: bold;">Terms of Service</a></li>
                <li><a href="#" style="color: #fff; font-weight: bold;">Social Media</a></li>
            </ul>
            <p>&copy; 2023 Organ Donation Management System</p>
        </div>
    </footer>
</body>
</html>
