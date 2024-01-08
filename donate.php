<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">

    <title>Organ Donation Form</title>
</head>

<body>
    <header>
        <h1>Organ Donation Form</h1>
    </header>

    <div class="container">
        <!-- Step 1: Blood Donation Condition -->
        <section id="blood-donation-condition">
        <h2>Terms and Conditions for Organ Donation</h2>
            <p>
           

<ol>
    <li><strong>Minimum Age for Registering as a Donor:</strong> Individuals must meet the minimum age requirement for organ donation registration.</li>

    <li><strong>Age Requirement:</strong> All individuals over the age of 18 can register themselves as organ, eye, or tissue donors. During registration, donors can specify their willingness to donate.</li>

    <li><strong>Registration for Individuals Under 18:</strong> Individuals under the age of 18 can register as organ donors, but final consent for donation will be determined by their parents or legal guardian(s) in the event of organ donation before the age of 18.</li>

    <li><strong>Donation Eligibility Despite Illness:</strong> Even in the presence of illness, organ donation after death is possible, subject to medical evaluation. While registering as a donor is encouraged, certain conditions may disqualify living donors.</li>

    <li><strong>Informed Consent:</strong> Donors or their legal representatives must provide informed consent for organ donation. This consent is crucial for the donation process.</li>

    <li><strong>Discussion with Family:</strong> It is recommended to inform and discuss organ donation wishes with family members to ensure understanding and support for the donor's decision.</li>

    <li><strong>Confidentiality:</strong> Donor information is handled with utmost confidentiality, adhering to privacy laws and ethical standards. Privacy and confidentiality are paramount in the organ donation process.</li>

    <li><strong>Transparent Allocation Procedures:</strong> Allocation of organs follows transparent procedures, considering factors such as urgency and compatibility to ensure fair and ethical distribution.</li>
</ol>

            </p>
            <button class="btn btn-primary" onclick="showPrivacyPolicy()">Next</button>
        </section>

        <!-- Step 2: Privacy Policy -->
        <section id="privacy-policy" style="display: none;">
            <h2>Privacy Policy</h2>
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
            <button class="btn btn-primary" onclick="showDonationForm()">Next</button>
        </section>

        <!-- Step 3: Organ Donation Form -->
        <section id="organ-donation-form" style="display: none;">
            <h2>Organ Donation Form</h2>
            <form method="POST" action="process_form.php" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="donor_name">Name</label>
                    <input type="text" class="form-control" id="donor_name" name="donor_name" required>
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
                    <label for="blood_group">Blood Group</label>
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

        function showDonationForm() {
            document.getElementById("privacy-policy").style.display = "none";
            document.getElementById("organ-donation-form").style.display = "block";
        }
    </script>
</body>

</html>
