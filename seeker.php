<?php
// Start the session
session_start();

// Establish a connection to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "idp_project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchResults = array();

    // Check if the form is submitted and user is logged in
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['organName']) && isset($_SESSION['username'])) {
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
    } elseif (!isset($_SESSION['username'])) {
        // Redirect to login page if not logged in
        header("Location: login.php");
        exit();
    }
// Fetch donor data from the database
$donorSql = "SELECT donor_id, donor_name, dob, gender, organ_name, blood_group, email, contact, address FROM donor_info";
$donorResult = $conn->query($donorSql);

// Fetch seeker data from the database
$seekerSql = "SELECT seeker_id, seeker_name, dob, gender, organ_name, blood_group, relation_with_seeker, email, contact, address FROM seeker_info";
$seekerResult = $conn->query($seekerSql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">

    <title>Donor and Seeker Page</title>
    <style>table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4e2a87;
            color: #fff;
        }</style>
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

    <div class="container">
    <section class="registration-login-section">
            <h2>Organ Request</h2>
            <p>If you want to request for an organ, click the button below to fill out the donor information form.</p>
            <a href="request.php" class="btn btn-primary">Organ Request</a>
        </section>
        <section>
            <h2>Seeker List</h2>
            <!-- Display seeker data in a table -->
            <table border="1">
                <thead>
                    <tr>
                        <th>Seeker ID</th>
                        <th>Name</th>

                        <th>Gender</th>
                        <th>Organ Name</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are rows in the result set
                    if ($seekerResult->num_rows > 0) {
                        // Output data of each row
                        while ($row = $seekerResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["seeker_id"] . "</td>";
                            echo "<td>" . $row["seeker_name"] . "</td>";
                            
                            echo "<td>" . $row["gender"] . "</td>";
                            echo "<td>" . $row["organ_name"] . "</td>";
                            echo "<td>" . $row["address"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No seekers found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Donor List</h2>
            <!-- Display donor data in a table -->
            <table border="1">
                <thead>
                    <tr>
                        <th>Donor ID</th>
                        <th>Name</th>                     
                        <th>Gender</th>
                        <th>Organ Name</th>                       
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are rows in the result set
                    if ($donorResult->num_rows > 0) {
                        // Output data of each row
                        while ($row = $donorResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["donor_id"] . "</td>";
                            echo "<td>" . $row["donor_name"] . "</td>";
                            echo "<td>" . $row["gender"] . "</td>";
                            echo "<td>" . $row["organ_name"] . "</td>";
                            echo "<td>" . $row["address"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No donors found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

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

    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpb"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrB3Y"></script>
</body>

</html>

