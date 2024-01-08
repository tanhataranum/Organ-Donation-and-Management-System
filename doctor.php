<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
        
    <title>Organ Donation Management System</title>
</head>
<body> 
    <header>
        <h1>Welcome to Organ Donation Management System</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="donor.php">Donors</a></li>
                <li><a href="seeker.php">Seekers</a></li>
                <li><a href="doctor.php">Doctor</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php
                    if (isset($_SESSION['username'])) {
                        echo '<li><a href="logout.php">Logout</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>

    <div class="row">
        <div class="col">
            <section>
                <h2>Search for Donors and Seekers</h2>
                <form class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter search query">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Search</button>
                        </div>
                    </div>
                </form>
            </section>

            <section>
                <h2>About Us</h2>
                <p>
                    <b>Welcome to the Organ Donation Management System—a platform driven by a shared commitment to saving lives. Our mission is simple: to facilitate and streamline organ donation, making a tangible impact on individuals awaiting life-changing transplants.</b>
                
                    <br><h3>Our Work:</h3>
                    <b>We provide a seamless process for donors and seekers, ensuring transparency and efficiency. From user-friendly registrations to leveraging Google Forms for consent letters, our approach combines innovation with compassion. Join us in creating a community dedicated to making a difference—one organ donation at a time</b>
                </p>
            </section>

            <?php
                if (!isset($_SESSION['username'])) {
                    echo '<section class="registration-login-section">
                        <h2>Login or Register</h2>
                        <p>If you are not registered, you can register using the registration button. If you are already registered, you can log in using the login button.</p>
                        <a href="registration1.php" class="btn btn-primary">Register</a>
                        <a href="login.php" class="btn btn-success">Login</a>
                    </section>';
                }
            ?>

            <section>
                <h2>Testimonials</h2>
                <!-- Testimonials content goes here -->
            </section>

            <section class="contact-section">
                <h2>Contact Us</h2>
                <p>If you have any questions or need assistance, feel free to contact us.</p>
                <a href="contact.html" class="btn btn-info">Contact Information</a>
            </section>
        </div>

        <div class="col" id="right-col">
            <section class="picture-section">
                <h2>Hospital Image</h2>
                <div class="image-container">
                    <a href="hospital.php">
                        <img src="hospital.jpg" alt="Hospital" width="600" height="300">
                    </a>
                    <p>You can see available hospitals in our system</p>
                </div>
            </section>

            <section class="picture-section">
                <h2>Blood Bank Image</h2>
                <div class="image-container">
                    <a href="blood.php">
                        <img src="blood.jpg" alt="Blood Bank" width="300" height="200">
                    </a>
                    <p>Blood Bank. You can see the available blood here.</p>
                </div>
            </section>
        </div>
    </div>
    
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

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpb"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrB3Y"></script>
</body>
</html>
