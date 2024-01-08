<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "idp_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errorMessage = "";
$successMessage = "";

// Handle hospital update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $updateID = mysqli_real_escape_string($conn, $_POST['update_id']);
    $hospitalName = mysqli_real_escape_string($conn, $_POST['hospital_name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    $updateSql = "UPDATE hospital SET hospital_name = '$hospitalName', location = '$location' WHERE hospital_id = '$updateID'";

    if ($conn->query($updateSql) === TRUE) {
        $successMessage = "Hospital details updated successfully!";
    } else {
        $errorMessage = "Error updating hospital details: " . $conn->error;
    }
}

// Process form submission for adding a hospital
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_hospital'])) {
    $hospitalName = mysqli_real_escape_string($conn, $_POST["hospital_name"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);

    $sql = "INSERT INTO hospital (hospital_name, location) VALUES ('$hospitalName', '$location')";

    if ($conn->query($sql) === TRUE) {
        $lastInsertedID = $conn->insert_id;
        $successMessage = "Hospital added successfully! Hospital ID: $lastInsertedID";
    } else {
        $errorMessage = "Error adding hospital: " . $conn->error;
    }
}

// Process hospital deletion
if (isset($_GET['delete_id'])) {
    $deleteID = mysqli_real_escape_string($conn, $_GET['delete_id']);
    $deleteSql = "DELETE FROM hospital WHERE hospital_id = '$deleteID'";

    if ($conn->query($deleteSql) === TRUE) {
        $successMessage = "Hospital deleted successfully!";
    } else {
        $errorMessage = "Error deleting hospital: " . $conn->error;
    }
}

// Fetch hospital list
$sql = "SELECT hospital_id, hospital_name, location FROM hospital";
$result = $conn->query($sql);

// Fetch selected hospital details for editing
$editHospital = null;
if (isset($_GET['edit_id'])) {
    $editID = mysqli_real_escape_string($conn, $_GET['edit_id']);
    $editSql = "SELECT hospital_name, location FROM hospital WHERE hospital_id = '$editID'";
    $editResult = $conn->query($editSql);

    if ($editResult->num_rows > 0) {
        $editHospital = $editResult->fetch_assoc();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
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
            color: #fff;
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
            margin-top: 20px;
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

        #hospital-list {
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
                <li><a href="doctor.php">Doctors</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div style="display: flex; align-items: flex-start;">
        <div class="container">
            <h2>Add Hospital</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="hospital_name">Hospital Name:</label>
                <input type="text" name="hospital_name" value="<?php echo isset($editHospital['hospital_name']) ? $editHospital['hospital_name'] : ''; ?>" required>

                <label for="location">Location:</label>
                <input type="text" name="location" value="<?php echo isset($editHospital['location']) ? $editHospital['location'] : ''; ?>" required>

                <?php if (isset($editHospital)): ?>
                    <input type="hidden" name="update_id" value="<?php echo $editID; ?>">
                    <button type="submit">Update Hospital</button>
                <?php else: ?>
                    <button type="submit" name="add_hospital">Add Hospital</button>
                <?php endif; ?>
            </form>

            <?php
            echo "<p class='error'>$errorMessage</p>";
            echo "<p class='success'>$successMessage</p>";
            ?>
        </div>

        <div id="hospital-list">
            <h2>Hospital List</h2>
            <table>
                <tr>
                    <th>Hospital ID</th>
                    <th>Hospital Name</th>
                    <th>Location</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['hospital_id'] . "</td>";
                    echo "<td>" . $row['hospital_name'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?edit_id=" . $row['hospital_id'] . "' style='background-color: #4e2a87; color: #fff; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; text-decoration: none;'>Edit</a></td>";
                    echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?delete_id=" . $row['hospital_id'] . "' style='background-color: #dc3545; color: #fff; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; text-decoration: none;'>Delete</a></td>";
                }
                ?>
            </table>
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
</body>
</html>

<?php
$conn->close();
?>
