<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #ffffff;
            color: #4e2a87;
        }

        header {
            background-color: #4e2a87;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }

        .container {
            flex: 1;
        }

        /* Footer Styles */
        footer {
            background-color: #4e2a87;
            color: #fff;
            text-align: center;
            padding: 2rem;
        }

        footer ul {
            list-style: none;
        }

        footer ul li {
            display: inline;
            margin-right: 20px;
        }
    </style>

    <title>Organ Donation Form</title>
</head>

<body>
    <header>
        <h1>Organ Request Form</h1>
    </header>
    

    <div class="container">
        <!-- Step 1: Blood Donation Condition -->
        <section id="blood-donation-condition">
        <h2>Terms and Conditions for Organ Transplantation</h2>
            <p>
            <ol>
        <li><strong>Accurate Medical History:</strong> Provide accurate medical history for proper matching during the organ transplantation process.</li>

        <li><strong>Priority Based on Urgency and Compatibility:</strong> Organ allocation will be prioritized based on both urgency and compatibility to ensure the best possible match.</li>

        <li><strong>Transparent Allocation:</strong> Allocation procedures are transparent, fair, and void of bias. There will be no discrimination, and equal opportunity will be provided for all individuals in need of organ transplantation.</li>

        <li><strong>Compliance with Medical Advice:</strong> Comply with medical advice and post-transplant care. Maintain regular communication with healthcare providers for a successful and healthy recovery.</li>

        <li><strong>Emergency Contact Details:</strong> Keep current emergency contact details to ensure accessibility for potential organ matches. Stay reachable at all times.</li>

        <li><strong>Active Engagement:</strong> Stay actively engaged in the transplant journey. Promptly update the transplant center on any changes in health or personal information.</li>

        <li><strong>Commitment to Medications and Treatment:</strong> Commit to prescribed medications and treatment plans. Attend follow-up appointments religiously to monitor progress and address any concerns.</li>

        <li><strong>Understanding Transplantation Risks and Benefits:</strong> Understand and consent to transplantation risks and benefits. Informed consent is essential for a shared and informed journey throughout the transplantation process.</li>

        <li><strong>Adherence to Legal and Regulatory Requirements:</strong> Adhere to all legal and regulatory requirements. Compliance with center policies is imperative for a smooth and ethical organ transplantation process.</li>
    </ol>
            </p>
            <button class="btn btn-primary" onclick="showPrivacyPolicy()">Next</button>
        </section>

        <!-- Step 2: Privacy Policy -->
        <section id="privacy-policy" style="display: none;">
            <p>
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
            <button class="btn btn-primary" onclick="showOrganDonationForm()">Next</button>
        </section>

        <!-- Step 3: Organ Donation Form -->
        <section id="organ-donation-form" style="display: none;">
            <h2>Organ Donation Form</h2>
            <form method="POST" action="requestcon.php" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="seeker_name">Seeker Name</label>
                    <input type="text" class="form-control" id="seeker_name" name="seeker_name" required>
                </div>

                <!-- Added labels for Address, Contact, and Email -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>

                <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="tel" class="form-control" id="contact" name="contact" required>
                </div>
                <?php if (!empty($error_message)) : ?>
    <div class="alert alert-danger">
        <?php echo $error_message; ?>
    </div>
<?php endif; ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <!-- Modified Blood Group to be a dropdown -->
                <div class="form-group">
                    <label for="blood_group">Seeker Blood Group</label>
                    <select class="form-control" id="blood_group" name="blood_group" required>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>

                <!-- Added label for organ_name before the consentLetter -->
                <div class="form-group">
                    <label for="organ_name">Organ Name</label>
                    <input type="text" class="form-control" id="organ_name" name="organ_name" required>
                </div>

                <div class="form-group">
                    <label for="relation_with_seeker">Relation With Seeker</label>
                    <input type="text" class="form-control" id="relation_with_seeker" name="relation_with_seeker" required>
                </div>

                <div class="form-group">
                    <label for="consentLetter">Consent Letter (PDF)</label>
                    <input type="file" class="form-control-file" id="consentLetter" name="consentLetter" accept=".pdf"
                        required>
                </div>

                <div class="form-group">
                    <label for="donor_signature">Signature (Image)</label>
                    <input type="file" class="form-control-file" id="donor_signature" name="donor_signature"
                        accept="image/*" required>
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </section>
        <section id="organ-donation-form" style="display: none;">
            <h2>Organ Donation Form</h2>
            <form method="POST" action="requestcon.php" enctype="multipart/form-data">
                <!-- Form fields go here -->
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </section>
    </div>

    <footer>
        <div class="footer-container">
            <ul>
                <li><a href="#" style="color: #fff; font-weight: bold;">Privacy Policy</a></li>
                <li><a href="#" style="color: #fff; font-weight: bold;">Terms of Service</a></li>
                <li><a href="#" style="color: #fff; font-weight: bold;">Social Media</a></li>
            </ul>
            <p>&copy; 2023 Organ Donation Management System</p>
        </div>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpb"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrB3Y"></script>

    <script>
        function showPrivacyPolicy() {
            document.getElementById("blood-donation-condition").style.display = "none";
            document.getElementById("privacy-policy").style.display = "block";
        }

        function showOrganDonationForm() {
            document.getElementById("privacy-policy").style.display = "none";
            document.getElementById("organ-donation-form").style.display = "block";
        }
    </script>
</body>

</html>








