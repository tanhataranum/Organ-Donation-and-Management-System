<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "idp_project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch donor data from the database
$donorSql = "SELECT donor_id, donor_name, dob, gender, organ_name, blood_group, email, contact, address, consent, donor_signature FROM donor_info";
$donorResult = $conn->query($donorSql);

// Fetch seeker data from the database
$seekerSql = "SELECT seeker_id, seeker_name, dob, gender, organ_name, blood_group, relation_with_seeker, email, contact, address, consent, seeker_signature FROM seeker_info";
$seekerResult = $conn->query($seekerSql);

// Define an error variable
$error_message = '';

// Process the form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $donor_name = $_POST['donor_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $organ_name = $_POST['organ_name'];
    $blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : ''; // Initialize the variable

    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Error: Invalid email format.";
    } else {
        // Check if files are uploaded successfully
        if ($_FILES['consentLetter']["error"] == 0 && $_FILES['donor_signature']["error"] == 0) {
            // Move uploaded files to a designated folder (adjust path as needed)
            $uploadsDirectory = "uploads/";
            if (!file_exists($uploadsDirectory)) {
                mkdir($uploadsDirectory, 0777, true);
            }

            $consent_path = $uploadsDirectory . basename($_FILES['consentLetter']["name"]);
            $signature_path = $uploadsDirectory . basename($_FILES['donor_signature']["name"]);

            if (move_uploaded_file($_FILES['consentLetter']["tmp_name"], $consent_path) && move_uploaded_file($_FILES['donor_signature']["tmp_name"], $signature_path)) {
                // SQL query to insert data into the database with file paths
                $sql = "INSERT INTO donor_info (donor_name, dob, gender, organ_name, blood_group, email, contact, address, consent, donor_signature) 
                        VALUES ('$donor_name', '$dob', '$gender', '$organ_name', '$blood_group', '$email', '$contact', '$address', '$consent_path', '$signature_path')";

                // Perform the query
                if ($conn->query($sql) === TRUE) {
                    echo "Record added successfully";
                    
                    // Redirect to the donor page
                    header("Location: manage_users.php");
                    exit;
                } else {
                    $error_message = "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                $error_message = "Error moving uploaded files.";
            }
        } else {
            $error_message = "Error uploading files. Check if files are selected and not exceeding upload limits.";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">

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
    </style>

    <title>Manage Users</title>
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
            </ul>
        </nav>
    </header>

    <!-- Display error message if it exists -->
    <?php if (!empty($error_message)) : ?>
        <div class="alert alert-danger">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <section>
        <h2>Donor Information</h2>
        <!-- Display donor data in a table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Donor ID</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Organ Name</th>
                    <th>Blood Group</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Consent</th>
                    <th>Donor Signature</th>
                    <th>Action</th>
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
                        echo "<td>" . $row["dob"] . "</td>";
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "<td>" . $row["organ_name"] . "</td>";
                        echo "<td>" . $row["blood_group"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["contact"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td><a href='" . $row["consent"] . "' target='_blank'>Download Consent</a></td>";
                        echo "<td><a href='" . $row["donor_signature"] . "' target='_blank'>Download Signature</a></td>";
                        echo "<td><a href='delete.php?type=donor&id=" . $row["donor_id"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No donors found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Seeker Information</h2>
        <!-- Display seeker data in a table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Seeker ID</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Organ Name</th>
                    <th>Blood Group</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Consent</th>
                    <th>Seeker Signature</th>
                    <th>Action</th>
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
                        echo "<td>" . $row["dob"] . "</td>";
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "<td>" . $row["organ_name"] . "</td>";
                        echo "<td>" . $row["blood_group"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["contact"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td><a href='" . $row["consent"] . "' target='_blank'>Download Consent</a></td>";
                        echo "<td><a href='" . $row["seeker_signature"] . "' target='_blank'>Download Signature</a></td>";
                        echo "<td><a href='delete.php?type=seeker&id=" . $row["seeker_id"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\") '>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>No seekers found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpb"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrB3Y"></script>
</body>

</html>
