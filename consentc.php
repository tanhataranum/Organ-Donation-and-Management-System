<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "idp_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission

    // Sanitize and validate input data
    $donorName = mysqli_real_escape_string($conn, $_POST["donorName"]);
    $contactNumber = mysqli_real_escape_string($conn, $_POST["contactNumber"]);

    // Handle file uploads
    $consentLetter = isset($_FILES["consentLetter"]) ? $_FILES["consentLetter"]["name"] : null;
    $signature = isset($_FILES["signature"]) ? $_FILES["signature"]["name"] : null;

    // Check if files were uploaded
    if ($consentLetter !== null && $signature !== null) {
        // Move uploaded files to a desired directory
        $uploadDirectory = "upload_directory/";

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        $consentLetterPath = $uploadDirectory . $consentLetter;
        $signaturePath = $uploadDirectory . $signature;

        if (move_uploaded_file($_FILES["consentLetter"]["tmp_name"], $consentLetterPath) &&
            move_uploaded_file($_FILES["signature"]["tmp_name"], $signaturePath)) {

            // Insert data into the database
            $sql = "INSERT INTO consent (name, contact_number, consent_letter, signature) 
                    VALUES ('$donorName', '$contactNumber', '$consentLetter', '$signature')";

            if ($conn->query($sql) === TRUE) {
                echo "Record added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Failed to move uploaded files. Debug info: " . print_r(error_get_last(), true);
        }
    } else {
        echo "Error: Files not uploaded.";
    }
}

// Close the database connection
$conn->close();
?>
