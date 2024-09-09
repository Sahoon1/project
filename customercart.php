<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .container {
            background-color: pink;
            padding: 20px;
            border-radius: 8px;
        }
        .form-control {
            border-radius: 4px;
        }
        .btn-warning {
            background-color: red;
            border-color: red;
            color: white;
        }
        .btn-warning:hover {
            background-color: darkred;
            border-color: darkred;
        }
        .alert {
            display: none;
        }
        .border-bottom-custom {
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <form class="form-horizontal" action="" method="post" id="contact_form">
        <fieldset>
            <legend>Personal Details</legend>

            <!-- Text input -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label">First Name</label>
                <div class="col-md-8">
                    <input name="first_name" placeholder="First Name" class="form-control" type="text" required>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Last Name</label>
                <div class="col-md-8">
                    <input name="last_name" placeholder="Last Name" class="form-control" type="text" required>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label">E-Mail</label>
                <div class="col-md-8">
                    <input name="email" placeholder="E-Mail Address" class="form-control" type="email" required>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Phone #</label>
                <div class="col-md-8">
                    <input name="phone" placeholder="Enter Your Number" class="form-control" type="tel" required>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Address</label>
                <div class="col-md-8">
                    <input name="address" placeholder="Address" class="form-control" type="text" required>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label">City</label>
                <div class="col-md-8">
                    <input name="city" placeholder="City" class="form-control" type="text" required>
                </div>
            </div>

            <h1 class="border-bottom-custom">Product Details</h1>

            <!-- Text input -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Product Color</label>
                <div class="col-md-8">
                    <input name="product_color" placeholder="Product Color" class="form-control" type="text" required>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Product Qty</label>
                <div class="col-md-8">
                    <input name="product_qty" placeholder="Product Qty" class="form-control" type="number" required>
                </div>
            </div>

            <!-- Success message -->
            <div class="alert alert-success" role="alert" id="success_message">
                Success! Thanks for contacting us, we will get back to you shortly.
            </div>

            <!-- Button -->
            <div class="form-group row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-warning" name="send">
                        Send <span class="glyphicon glyphicon-send"></span>
                    </button>
                </div>
            </div>
        </fieldset>
    </form>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Show the success message using JavaScript
    <?php if (isset($_POST['send'])): ?>
    document.getElementById('success_message').style.display = 'block';
    <?php endif; ?>
</script>
</body>
</html>

<?php
if (isset($_POST['send'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "costomer";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO costomer (first_name, last_name, email, phone, address, city, product_color, product_qty) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $phone, $address, $city, $product_color, $product_qty);

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $product_color = $_POST['product_color'];
    $product_qty = $_POST['product_qty'];

    if ($stmt->execute()) {
        echo "<script>document.getElementById('success_message').style.display = 'block';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?> 
