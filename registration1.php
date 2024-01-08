<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    
    // Collect form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];
    $role = $_POST["role"];

    $conn = new mysqli('localhost', 'root', '', 'idp_project');

    // Validate form data
    $errors = array();

    // Check if passwords match
    if ($password != $confirmPassword) {
        $errors[] = "Password and Confirm Password do not match.";
    }

    // Check password length
    if (strlen($password) < 8) {
        $errors[] = "Password should have a minimum length of 8 characters.";
    }

    // Check for special characters and numbers in the password
    if (!preg_match('/[0-9]/', $password) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        $errors[] = "Password should contain at least one special character and one number.";
    }

    // If there are errors, display them above the form fields
    if (empty($errors)) {
        $insert = "INSERT INTO registration(username, password, confirmpassword, role) VALUES('$username','$password','$confirmPassword','$role')";
        mysqli_query($conn, $insert);
        @header('location:login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="registration.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
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
    <br/><br/><br/>
    <div class="login-container">
        <div class="login-form">
            <h2>Registration</h2>
             
            <form method="post" action=""> <!-- Added method and action attributes -->
                <?php
                    if (!empty($errors)) {
                        echo '<div style="color: red;">';
                        foreach ($errors as $error) {
                            echo $error . "<br>";
                        }
                        echo '</div>';
                    }
                ?>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
                
                <label for="role">Select Role:</label>
                <select id="role" name="role">
                    <option value="donor">Donor</option>
                    <option value="seeker">Seeker</option>
                </select>
                
                <input type="submit" name="submit" value="Register">
            </form>
            <p>Already have an account? <a href="login.php">Log In</a></p>
        </div>
    </div>
    <br/><br/><br/>

    <!-- Footer from Home Page -->
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
