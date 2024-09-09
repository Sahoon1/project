<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Search for Customer</h1>
        <form method="post" action="">
            <div class="form-group">
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter id" name="id">
            </div>
            <button type="submit" class="btn btn-warning" name="search">Search</button>
        </form>

        <?php
        if (isset($_POST['search'])) {
            // Database credentials
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "costomer";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve the 'id' from the form
            $id = $conn->real_escape_string($_POST['id']);

            // SQL query to select the customer by id
            $select = "SELECT * FROM costomer WHERE id = '$id'";
            $result = $conn->query($select);

            // Check if any rows were returned
            if ($result->num_rows > 0) {
                // Display the result in a table
                echo "<table class='table table-striped table-danger mt-4'>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                        </tr>
                    </thead>
                    <tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row["first_name"]) . "</td>
                        <td>" . htmlspecialchars($row["last_name"]) . "</td>
                        <td>" . htmlspecialchars($row["email"]) . "</td>
                        <td>" . htmlspecialchars($row["phone"]) . "</td>
                        <td>" . htmlspecialchars($row["address"]) . "</td>
                        <td>" . htmlspecialchars($row["city"]) . "</td>
                    </tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "<p class='mt-4'>0 results</p>";
            }

            // Close the connection
            $conn->close();
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
