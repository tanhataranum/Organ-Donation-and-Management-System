<?php
// Establish a connection to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "idp_project";
$consent_file = "consentLetter"; // Use the correct form field names
$signature_file = "donor_signature"; // Use the correct form field names

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
        if ($_FILES[$consent_file]["error"] == 0 && $_FILES[$signature_file]["error"] == 0) {
            // Move uploaded files to a designated folder (adjust path as needed)
            $uploadsDirectory = "uploads/";
            if (!file_exists($uploadsDirectory)) {
                mkdir($uploadsDirectory, 0777, true);
            }

            $consent_path = $uploadsDirectory . basename($_FILES[$consent_file]["name"]);
            $signature_path = $uploadsDirectory . basename($_FILES[$signature_file]["name"]);

            if (move_uploaded_file($_FILES[$consent_file]["tmp_name"], $consent_path) && move_uploaded_file($_FILES[$signature_file]["tmp_name"], $signature_path)) {
                // SQL query to insert data into the database with file paths
                $sql = "INSERT INTO donor_info (donor_name, dob, gender, organ_name, blood_group, email, contact, address, consent, donor_signature) 
                        VALUES ('$donor_name', '$dob', '$gender', '$organ_name', '$blood_group', '$email', '$contact', '$address', '$consent_path', '$signature_path')";

                // Perform the query
                if ($conn->query($sql) === TRUE) {
                    echo "Record added successfully";
                    
                    // Redirect to the donor page
                    header("Location: donor.php");
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