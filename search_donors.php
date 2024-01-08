<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "idp_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['organName'])) {
    // Retrieve the search query
    $organName = $_GET['organName'];

    // Modify your SQL query to filter donors by organ name
    $sql = "SELECT donor_id, donor_name, dob, gender, organ_name, blood_group, email, contact, address, consent, donor_signature
            FROM donor_info
            WHERE organ_name LIKE '%$organName%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row in a table
        echo "<h2>Search Results</h2>";
        echo "<table class='table'>";
        echo "<tr>
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
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['donor_id']}</td>
                    <td>{$row['donor_name']}</td>
                    <td>{$row['dob']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['organ_name']}</td>
                    <td>{$row['blood_group']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['contact']}</td>
                    <td>{$row['address']}</td>
                    <td><a href='{$row['consent']}' target='_blank'>Download Consent</a></td>
                    <td><a href='{$row['donor_signature']}' target='_blank'>Download Signature</a></td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No donors found for the organ: $organName</p>";
    }
}

// Close the database connection
$conn->close();
?>
