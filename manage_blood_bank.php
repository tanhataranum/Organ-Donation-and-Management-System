<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">

    <title>Manage Blood Bank</title>
</head>

<body>
    <header>
        <h1>Manage Blood Bank</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="donor.php">Donors</a></li>
                <li><a href="seeker.php">Seekers</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <section>
            <div class="row">
                <!-- Available Blood Form -->
                <div class="col-md-6">
                    <h2>Available Blood Form</h2>
                    <form action="process_blood_form.php" method="post">
                        <!-- Add your form fields here -->
                        <div class="form-group">
                            <label for="blood_type">Blood Type</label>
                            <select class="form-control" id="blood_type" name="blood_type" required>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity (ml)</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Blood</button>
                    </form>
                </div>

                <!-- List of Available Blood -->
                <div class="col-md-6">
                    <h2>List of Available Blood</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Blood Type</th>
                                <th>Quantity (ml)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Connect to the database and fetch data
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "idp_project";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Assuming available_blood table has columns: id, blood_type, quantity
                            $sql = "SELECT * FROM available_blood";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["blood_type"] . "</td>";
                                    echo "<td>" . $row["quantity"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No available blood entries</td></tr>";
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-row">
                <ul style="text-align: center; text-decoration: underline;">
                    <li><a href="privacy_policy.php" onclick="openPopup(); return false;"
                            style="color: #fff; font-weight: bold;">Privacy Policy</a></li>
                    <li><a href="terms.php" onclick="openPopup(); return false;"
                            style="color: #fff; font-weight: bold;"> Terms of Service</a></li>
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
</body>

</html>
