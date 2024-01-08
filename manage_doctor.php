<?php
session_start();

// Include database connection details (adapt these based on your setup)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "idp_project";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to hold form data
$doctorName = $specialist = $email = $contact = $hospital = "";
$errorMessage = "";
$successMessage = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $doctorName = mysqli_real_escape_string($conn, $_POST["doctor_name"]);
    $specialist = mysqli_real_escape_string($conn, $_POST["specialist"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $contact = mysqli_real_escape_string($conn, $_POST["contact"]);
    $hospital = mysqli_real_escape_string($conn, $_POST["hospital"]);

    // Check if an update ID is provided
    if (isset($_POST['update_id'])) {
        // Update existing doctor
        $updateID = mysqli_real_escape_string($conn, $_POST['update_id']);
        $updateSql = "UPDATE doctor SET doctor_name = '$doctorName', specialist = '$specialist', email = '$email', contact = '$contact', hospital = '$hospital' WHERE doctor_id = '$updateID'";

        if ($conn->query($updateSql) === TRUE) {
            $successMessage = "Doctor details updated successfully!";
        } else {
            $errorMessage = "Error updating doctor details: " . $conn->error;
        }
    } else {
        // Insert new doctor
        $sql = "INSERT INTO doctor (doctor_name, specialist, email, contact, hospital) VALUES ('$doctorName', '$specialist', '$email', '$contact', '$hospital')";

        if ($conn->query($sql) === TRUE) {
            $lastInsertedID = $conn->insert_id; // Get the auto-generated ID
            $successMessage = "Doctor added successfully! Doctor ID: $lastInsertedID";
            // Use JavaScript to show a pop-up and then redirect
            echo '<script>alert("' . $successMessage . '"); window.location.href="manage_doctor.php";</script>';
            exit;
        } else {
            $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Fetch list of doctors
$sql = "SELECT * FROM doctor";
$result = $conn->query($sql);

// Fetch selected doctor details for editing
$editDoctor = null;
if (isset($_GET['edit_id'])) {
    $editID = mysqli_real_escape_string($conn, $_GET['edit_id']);
    $editSql = "SELECT doctor_name, specialist, email, contact, hospital FROM doctor WHERE doctor_id = '$editID'";
    $editResult = $conn->query($editSql);

    if ($editResult->num_rows > 0) {
        $editDoctor = $editResult->fetch_assoc();
    }
}

// Handle doctor deletion
if (isset($_GET['delete_id'])) {
    $deleteID = mysqli_real_escape_string($conn, $_GET['delete_id']);
    $deleteSql = "DELETE FROM doctor WHERE doctor_id = '$deleteID'";

    if ($conn->query($deleteSql) === TRUE) {
        $successMessage = "Doctor deleted successfully!";
    } else {
        $errorMessage = "Error deleting doctor: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Styles -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            /* Light gray background */
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

        .container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4e2a87;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2a1547;
        }

        #doctor-list {
            flex: 1;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
        }

        table {
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
    <!-- Header -->
    <header>
        <h1>Welcome to Organ Donation Management System</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="donor.php">Donors</a></li>
                <li><a href="seeker.php">Seekers</a></li>
                <li><a href="doctor.php">Doctors</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Content -->
    <div style="display: flex; align-items: flex-start;">
        <div class="container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="doctor_name">Doctor Name:</label>
                <input type="text" name="doctor_name" value="<?php echo isset($editDoctor['doctor_name']) ? $editDoctor['doctor_name'] : ''; ?>" required>

                <label for="specialist">Specialist:</label>
                <input type="text" name="specialist" value="<?php echo isset($editDoctor['specialist']) ? $editDoctor['specialist'] : ''; ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo isset($editDoctor['email']) ? $editDoctor['email'] : ''; ?>" required>

                <label for="contact">Contact:</label>
                <input type="text" name="contact" value="<?php echo isset($editDoctor['contact']) ? $editDoctor['contact'] : ''; ?>" required>

                <label for="hospital">Hospital:</label>
                <input type="text" name="hospital" value="<?php echo isset($editDoctor['hospital']) ? $editDoctor['hospital'] : ''; ?>" required>

                <?php if (isset($editDoctor)): ?>
                    <input type="hidden" name="update_id" value="<?php echo $editID; ?>">
                    <button type="submit">Update Doctor</button>
                <?php else: ?>
                    <button type="submit">Add Doctor</button>
                <?php endif; ?>
            </form>

            <?php
                // Display error message if any
                echo "<p class='error'>$errorMessage</p>";
            ?>
        </div>

        <div id="doctor-list">
            <h2>Doctor List</h2>
            <table>
                <tr>
                <th>Doctor ID</th>
                    <th>Doctor Name</th>
                    <th>Specialist</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Hospital</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                    // Display doctors in the table
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['doctor_id'] . "</td>";
                        echo "<td>" . $row['doctor_name'] . "</td>";
                        echo "<td>" . $row['specialist'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['contact'] . "</td>";
                        echo "<td>" . $row['hospital'] . "</td>";
                        echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?edit_id=" . $row['doctor_id'] . "' style='background-color: #4e2a87; color: #fff; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; text-decoration: none;'>Edit</a></td>";
                        echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?delete_id=" . $row['doctor_id'] . "' style='background-color: #dc3545; color: #fff; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; text-decoration: none;'>Delete</a></td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </div>

    <!-- Footer -->
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
