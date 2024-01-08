<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $blood_type = $_POST["blood_type"];
    $quantity = $_POST["quantity"];

    // Validate the presence of values (you can add more validation if needed)
    if (empty($blood_type) || empty($quantity)) {
        // Handle validation errors (redirect or display an error message)
        header("Location: manage_blood_bank.php?error=1");
        exit();
    }

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "idp_project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the available_blood table
    $sql = "INSERT INTO available_blood (blood_type, quantity) VALUES ('$blood_type', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        // Data successfully inserted, redirect to the manage_blood_bank.php page
        header("Location: manage_blood_bank.php");
        exit();
    } else {
        // Handle database insertion error (redirect or display an error message)
        header("Location: manage_blood_bank.php?error=2");
        exit();
    }


} else {
    // If the form is not submitted, redirect to the manage_blood_bank.php page
    header("Location: manage_blood_bank.php");
    exit();
}
?>
