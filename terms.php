<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 50;
            color: #333;
        }

        .popup {
            background-color: #fff;
            padding: 700px;
            border-radius: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            width: 100%;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: green;
        }
    </style>
</head>

<body>
    <!-- Terms and Conditions Popup -->
    <div class="popup-container" id="termsPopup">
        <div class="popup-content">
            <span class="close-btn" onclick="closeTermsPopup()">X</span>
            <h2>Terms and Conditions</h2>
            <p>Welcome to the Organ Donation Management System. By using our services, you agree to comply with the following terms and conditions:</p>

            <h3>1. User Accounts</h3>
            <p>To access certain features of the system, you may be required to register for an account. You are responsible for maintaining the confidentiality of your account information.</p>

            <h3>2. Organ Donation Process</h3>
            <p>The system facilitates organ donation processes by connecting donors and recipients. Users must provide accurate and truthful information during the registration process.</p>

            <h3>3. Privacy and Security</h3>
            <p>We prioritize the privacy and security of user information. Users are encouraged to review our Privacy Policy for details on how we collect, use, and protect personal data.</p>

            <h3>4. Code of Conduct</h3>
            <p>Users are expected to engage respectfully and responsibly within the system. Any misuse, harassment, or violation of these terms may result in the suspension or termination of your account.</p>

            <h3>5. Modifications</h3>
            <p>We reserve the right to modify these terms and conditions at any time. Users will be notified of any changes, and continued use of the system implies acceptance of the modified terms.</p>

        </div>
    </div>

    <script>
        function openTermsPopup() {
            document.getElementById("termsPopup").style.display = "flex";
            document.body.classList.add("popup-open");
        }

        function closeTermsPopup() {
            document.getElementById("termsPopup").style.display = "none";
            document.body.classList.remove("popup-open");
            window.location.href = "home.php"; // Redirect to the home page
        }
    </script>
</body>

</html>
