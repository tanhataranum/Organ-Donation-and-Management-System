<?php
// Establish a connection to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "idp_project";
$consent_file_key = "consentLetter"; // Updated to use dynamic keys
$signature_file_key = "donor_signature"; // Updated to use dynamic keys
$seeker_name_key = "seeker_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define an error variable
$error_message = '';

// Process the form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $seeker_name = $_POST[$seeker_name_key];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $organ_name = $_POST['organ_name'];
    $blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : ''; // Initialize the variable
    $relation_with_seeker = $_POST['relation_with_seeker'];

    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Error: Invalid email format.";
    } else {
        // Check if files are uploaded successfully
        if ($_FILES[$consent_file_key]["error"] == 0 && $_FILES[$signature_file_key]["error"] == 0) {
            // Move uploaded files to a designated folder (adjust path as needed)
            $uploadsDirectory = "uploads/";
            if (!file_exists($uploadsDirectory)) {
                mkdir($uploadsDirectory, 0777, true);
            }

            $consent_path = $uploadsDirectory . basename($_FILES[$consent_file_key]["name"]);
            $signature_path = $uploadsDirectory . basename($_FILES[$signature_file_key]["name"]);

            if (move_uploaded_file($_FILES[$consent_file_key]["tmp_name"], $consent_path) && move_uploaded_file($_FILES[$signature_file_key]["tmp_name"], $signature_path)) {
                // SQL query to insert data into the database with file paths
                $sql = "INSERT INTO seeker_info (seeker_name, dob, gender, organ_name, blood_group, relation_with_seeker, email, contact, address, consent, seeker_signature) 
                        VALUES ('$seeker_name', '$dob', '$gender', '$organ_name', '$blood_group', '$relation_with_seeker', '$email', '$contact', '$address', '$consent_path', '$signature_path')";

                // Perform the query
                if ($conn->query($sql) === TRUE) {
                    echo "Record added successfully";

                    // Redirect to the seeker page
                    header("Location: seeker.php");
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

<!-- Display error message if it exists -->
<?php if (!empty($error_message)) : ?>
    <div class="alert alert-danger">
        <?php echo $error_message; ?>
    </div>
<?php endif; ?>
