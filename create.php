<?php
session_start();
include_once('includes/dbconnection.php');
echo("<script src='index.js'></script>");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit']) && isset($_SESSION['username'])) {
        $venueName = htmlspecialchars($_POST['venue_name']);
        $venueCapacity = intval($_POST['venue_capacity']); 
        $venueLocation = htmlspecialchars($_POST['venue_location']);
        $venuePrice = floatval($_POST['venue_price']); 
        $venueDescription = htmlspecialchars($_POST['venue_description']);
        $user_id = $_SESSION['user_id'];
        $insertQuery = "INSERT INTO venues (venue_name, venue_capacity, venue_location, venue_price, venue_description,user_id) 
                        VALUES ('$venueName', $venueCapacity, '$venueLocation', $venuePrice, '$venueDescription',$user_id)";
    
        $checkNameQuery = "SELECT * FROM venues WHERE venue_name='$venueName'";

        $result = $conn->query($checkNameQuery);

        if ($result->num_rows > 0) {
        echo "<script>showAlert('Venue name already exist. Please choose a different venue name.');</script>";
    }
    else{
        $conn->query($insertQuery);
        echo "Venue created successfully!";
    } 
        $conn->close();
    }
    else
    {
        echo "<script>showAlert('Please Login before creating a venue!');</script>";
    }
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

        input, textarea, select {
            width: 95%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            position: relative;
            left: 140;
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
        <select id="venue_location" name="venue_location" required>
            <option value="Nungambakkam">Nungambakkam</option>
            <option value="Tambaram">Tambaram</option>
            <option value="Guindy">Guindy</option>
            <option value="Egmore">Egmore</option>
            <option value="AnnaNagar">AnnaNagar</option>
        </select>

        <label for="venue_price">Price:</label>
        <input type="number" id="venue_price" name="venue_price" required>

        <label for="venue_description">Description:</label>
        <textarea id="venue_description" name="venue_description" required></textarea>

        <button type="submit" name="submit">Create Venue</button>
    </form>
</body>
</html>
