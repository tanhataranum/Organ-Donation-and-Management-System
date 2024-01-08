<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 180vh;
            margin: 100;
            color: #fff;
        }

        .popup {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            width: 100%;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: blue;
        }
    </style>
</head>

<body>
<!-- Privacy Policy Popup -->
<div class="popup-container" id="privacyPopup">
    <div class="popup-content">
        <span class="close-btn" onclick="closePrivacyPopup()">X</span>
        <h2>Privacy Policy</h2>

<p>This Privacy Policy outlines the practices and procedures of [Your Organ Donation Company] regarding the collection, use, and disclosure of personal information when you use our services or interact with our website.</p>

<h3>1. Information We Collect</h3>

<p>We may collect personal information, including but not limited to:</p>

<ul>
    <li>Contact information (name, email address, phone number)</li>
    <li>Medical history and organ donation preferences</li>
    <li>Emergency contact details</li>
    <li>Other information voluntarily provided by the user</li>
</ul>

<h3>2. Use of Information</h3>

<p>We use the collected information for the following purposes:</p>

<ul>
    <li>Facilitate organ donation registration and matching</li>
    <li>Communicate with donors, potential recipients, and their emergency contacts</li>
    <li>Ensure proper medical assessment for compatibility</li>
    <li>Improve our services and website</li>
    <li>Comply with legal and regulatory requirements</li>
</ul>

<h3>3. Information Sharing</h3>

<p>We do not sell, trade, or otherwise transfer your personal information to outside parties. However, we may share information with medical professionals, emergency contacts, and regulatory authorities as required for organ donation processes.</p>

<h3>4. Security</h3>

<p>We implement security measures to protect the confidentiality and integrity of your personal information. However, no method of transmission over the internet or electronic storage is completely secure, and we cannot guarantee absolute security.</p>

<h3>5. Your Choices</h3>

<p>You have the right to:</p>

<ul>
    <li>Review and update your personal information</li>
    <li>Opt-out of communication from us</li>
    <li>Withdraw consent for organ donation at any time</li>
</ul>

<h3>6. Changes to the Privacy Policy</h3>

<p>We reserve the right to update our Privacy Policy. Any changes will be reflected on this page, and users will be notified via email or our website.</p>

<h3>7. Contact Us</h3>

<p>If you have any questions or concerns about our Privacy Policy, please contact us at [contact@email.com].</p>

</p>

        <!-- Close button -->
        <button onclick="closePrivacyPopup()">Close</button>
    </div>
</div>

<script>
    function openPrivacyPopup() {
        document.getElementById("privacyPopup").style.display = "flex";
        document.body.classList.add("popup-open");
    }

    function closePrivacyPopup() {
        document.getElementById("privacyPopup").style.display = "none";
        document.body.classList.remove("popup-open");
        window.location.href = "home.php"; // Redirect to the home page
    }
</script>

<!-- Your existing footer content -->

</html>
