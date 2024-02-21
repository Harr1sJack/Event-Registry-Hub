<?php
include_once('includes/dbconnection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $venueName = htmlspecialchars($_POST['venue_name']);
    $venueCapacity = intval($_POST['venue_capacity']); // Assuming venue_capacity is an integer
    $venueLocation = htmlspecialchars($_POST['venue_location']);
    $venuePrice = floatval($_POST['venue_price']); // Assuming venue_price is a decimal/float
    $venueDescription = htmlspecialchars($_POST['venue_description']);


    $insertQuery = "INSERT INTO venues (venue_name, venue_capacity, venue_location, venue_price, venue_description) 
                    VALUES ('$venueName', $venueCapacity, '$venueLocation', $venuePrice, '$venueDescription')";

    if ($conn->query($insertQuery) === TRUE) {
        echo "Venue created successfully!";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Venue</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #e6f7ff;
    }

    header {
        background-color: #007bff;
        color: #fff;
        padding: 15px 0;
        text-align: center;
    }

    h1 {
        text-align: center;
        margin-top: 20px;
    }

    form {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input, textarea {
        width: 95%;
        padding: 10px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    button {
        padding: 12px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>

</head>
<body>
    <?php include_once('includes/header.php');?>
    <h1>Create Your Venue</h1>

    <form method="post">
        <label for="venue_name">Name:</label>
        <input type="text" id="venue_name" name="venue_name" required>

        <label for="venue_capacity">Capacity:</label>
        <input type="number" id="venue_capacity" name="venue_capacity" required>

        <label for="venue_location">Location:</label>
        <input type="text" id="venue_location" name="venue_location" required>

        <label for="venue_price">Price:</label>
        <input type="number" id="venue_price" name="venue_price" required>

        <label for="venue_description">Description:</label>
        <textarea id="venue_description" name="venue_description" required></textarea>

        <button type="submit">Create Venue</button>
    </form>

</body>
</html>
