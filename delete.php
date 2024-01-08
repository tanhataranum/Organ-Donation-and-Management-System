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

// Check if the type and ID parameters are set in the URL
if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    // Determine the table based on the type
    $table = ($type === 'donor') ? 'donor_info' : 'seeker_info';

    // SQL query to delete the record
    $deleteSql = "DELETE FROM $table WHERE {$type}_id = $id";

    // Perform the query
    if ($conn->query($deleteSql) === TRUE) {
        echo "Record deleted successfully";

        // Redirect back to the manage_users.php page
        header("Location: manage_user.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid parameters";
}

// Close the database connection
$conn->close();
?>
