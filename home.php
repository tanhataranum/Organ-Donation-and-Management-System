<?php
    session_start();

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "idp_project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $searchResults = array();

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['organName'])) {
        // Retrieve the search query
        $organName = $_GET['organName'];

        // Modify your SQL query to filter donors by organ name
        $sql = "SELECT donor_id, donor_name, dob, gender, organ_name, blood_group, email, contact, address, consent, donor_signature
                FROM donor_info
                WHERE organ_name LIKE '%$organName%'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Store the search results in an array
            while ($row = $result->fetch_assoc()) {
                $searchResults[] = $row;
            }
        }

    }


    // Close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
        
    <title>Organ Donation Management System</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4e2a87;
            color: #fff;
        }

        form {
            margin-top: 20px;
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
                <h2>Search Donors</h2>
                <!-- Search form -->
                <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="organName">Organ Name:</label>
                        <input type="text" class="form-control" id="organName" name="organName" placeholder="Enter organ name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </section>

            <section>
                <div id="donor-list">
                    <?php
                        // Display the search results in a table
                        if (!empty($searchResults)) {
                            echo "<h2>Search Results</h2>";
                            echo "<table class='table'>";
                            echo "<tr>
                                    <th>Donor ID</th>
                                    <th>Name</th>
                                    <th>Organ Name</th>
                                    <th>Action</th>
                                  </tr>";

                            foreach ($searchResults as $row) {
                                echo "<tr>
                                        <td>{$row['donor_id']}</td>
                                        <td>{$row['donor_name']}</td>
                                        <td>{$row['organ_name']}</td>
                       <td>
                <form action='login.php' method='post'>
                    <input type='hidden' name='donor_id' value='{$row['donor_id']}' />
                    <input type='hidden' name='donor_name' value='{$row['donor_name']}' />
                    <input type='hidden' name='organ_name' value='{$row['organ_name']}' />
                    <button type='submit' name='request_button'' style='background-color: #4e2a87; color: #fff; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; text-decoration: none;'>Request</button>
                </form>
            </td>        
                                      </tr>";
                            }

                            echo "</table>";
                        } else {
                            echo "<p>No donors found</p>";
                        }
                    ?>
                </div>
            </section>

            <section>
                <h2>About Us</h2>
                <p>
                    Welcome to the Organ Donation Management System—a platform driven by a shared commitment to saving lives. Our mission is simple: to facilitate and streamline organ donation, making a tangible impact on individuals awaiting life-changing transplants.
                
                    <h3>Our Work:</h3>
                    We provide a seamless process for donors and seekers, ensuring transparency and efficiency. From user-friendly registrations to leveraging Google Forms for consent letters, our approach combines innovation with compassion. Join us in creating a community dedicated to making a difference—one organ donation at a time
                </p>
            </section>


            <section>
                <h2>Testimonials</h2>
               
    <h2>What Our Donors and Recipients Say</h2>

<div>
    <blockquote>
        <p>"I am grateful to [Organ Donation Office] for guiding me through the organ donation process. Their compassionate team provided excellent support, making a difficult decision more manageable. Knowing that my choice can make a difference gives me a profound sense of purpose."</p>
        <footer>- [Mr. Sahiduzzam]</footer>
    </blockquote>

    <blockquote>
        <p>"As a recipient, I can't express enough gratitude to the amazing people at [Organ Donation Office]. Their commitment to transparency and fairness in organ allocation gave me a second chance at life. The care and dedication of the entire team are truly remarkable."</p>
        <footer>- [Md. Kawser Hossain]</footer>
    </blockquote>

    <blockquote>
        <p>"The staff at [Organ Donation Office] made the organ donation registration process simple and supportive. They answered all my questions and ensured that my preferences were recorded accurately. It's comforting to know that my decision can bring hope to someone in need."</p>
        <footer>- [Farhad Ahamed]</footer>
    </blockquote>

    <blockquote>
        <p>provides an essential service with utmost professionalism. Their commitment to privacy, security, and ethical practices sets them apart. I appreciate their dedication to making organ donation a positive experience for all involved."</p>
        <footer>- [Organ Donation System]</footer>
    </blockquote>
</div>
            </section>


        </div>
        

        <div class="col" id="right-col">
            
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

            <section class="picture-section">
                <h2>Available Doctor</h2>
                <div class="image-container">
                    <a href="doctorlist.php">
                        <img src="doctor.jpg" alt="Hospital" width="300" height="200">
                    </a>
                    <p>Doctotr. You can see the available Doctor here.</p>
                </div>
            </section>

            <section class="contact-section">
                <h2>Contact Us</h2>
                <p>If you have any questions or need assistance, feel free to contact us.</p>
                <a href="contact.php" class="btn btn-info">Contact Information</a>
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
