<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
     <title>Hospitals</title>
     <style>#hospital-list {
            flex: 1;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4e2a87;
            color: #fff;
        }
</style>
</head>
<body>
    <header>
        <h1>Hospitals in our System</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="login.php">Donors</a></li>
                <li><a href="login.php">Seekers</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <section>
            <h2>Description</h2>
            <p>
                Welcome to the section where you can explore the hospitals in our system. Each hospital plays a crucial role in organ donation, providing a platform for donors and seekers to connect. Below is a list of hospitals actively participating in our organ donation management system.
            </p>
        </section>

        <section>
        <div id="hospital-list">
        <h2>Hospital List</h2>
        <table>
            <tr>
                <th>Hospital ID</th>
                <th>Hospital Name</th>
                <th>Location</th>
            </tr>
            <!-- Replace the following PHP code with your actual hospital data retrieval -->
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "idp_project";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT hospital_id, hospital_name, location FROM hospital";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['hospital_id'] . "</td>";
                    echo "<td>" . $row['hospital_name'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "</tr>";
                }

                $conn->close();
            ?>
        </table>
    </div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpb"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrB3Y"></script>
</body>
</html>
