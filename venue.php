<?php
include_once('includes/dbconnection.php');
echo("<script src='index.js'></script>");
// Assuming you have a venue ID passed through the URL
if (isset($_GET['venue_id'])) {
    $venueId = $_GET['venue_id'];

    // Fetch venue details based on the ID
    $query = "SELECT * FROM venues WHERE venue_id = $venueId";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Check if the venue exists
    if ($result->num_rows > 0) {
        $venueDetails = $result->fetch_assoc();
    } else {
        // Redirect to the search page or display an error message
        header("Location: search.php");
        exit();
    }
} else {
    // Redirect to the search page if no venue ID is provided
    header("Location: search.php");
    exit();
}

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have user information available in the session
    // Modify this based on your actual user authentication implementation
    $userId = $_SESSION['user_id']; // Replace with the actual session variable for user ID

    $venueId = $_POST["venue_id"];
    $registrationDate = $_POST["registration_date"];

    // Check if the selected date is available for the venue
    $availabilityQuery = "SELECT * FROM venue_registrations WHERE venue_id = $venueId AND registration_date = '$registrationDate'";
    $availabilityResult = $conn->query($availabilityQuery);

    if (!$availabilityResult) {
        die("Availability check failed: " . $conn->error);
    }

    if ($availabilityResult->num_rows > 0) {
        // Date is already booked, handle accordingly (e.g., show an error message)
        echo "<script>showAlert('Selected date is not available. Please choose another date.')</script>";
    } else {
        // Date is available, proceed with registration
        $insertQuery = "INSERT INTO venue_registrations (user_id, venue_id, registration_date) VALUES ($userId, $venueId, '$registrationDate')";
        
        if ($conn->query($insertQuery) === TRUE) {
            // Registration successful
            echo "Registration successful!"; // You can redirect or display a success message here
        } else {
            // Display an error message (replace with actual error handling)
            echo "Error: " . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e6f7ff;
        }

        header {
            background-color: #4285f4;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-size: 1.5em;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        .venue-details {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .venue-details p {
            margin-bottom: 10px;
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

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            padding: 12px;
            background-color: #4285f4;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #3367d6;
        }
    </style>
</head>
<body>
    <?php
    include_once('includes/header.php');

    echo "<h1>Venue Details</h1>";

    // Display venue details
    if (!empty($venueDetails)) {
        echo '<form method="post">';
        echo '<label for="venue_name"><strong>Venue Name:</strong> ' . $venueDetails['venue_name'] . '</label>';
        echo '<label for="venue_capacity"><strong>Venue Capacity:</strong> ' . $venueDetails['venue_capacity'] . '</label>';
        echo '<label for="venue_location"><strong>Venue Location:</strong> ' . $venueDetails['venue_location'] . '</label>';
        echo '<label for="venue_price"><strong>Venue Price:</strong> ' . $venueDetails['venue_price'] . '</label>';
        echo '<label for="venue_description"><strong>Venue Description:</strong> ' . $venueDetails['venue_description'] . '</label>';

        echo '<input type="hidden" name="venue_id" value="' . $venueDetails['venue_id'] . '">';
        echo '<label for="registration_date"><strong>Select Registration Date:</strong></label>';
        echo '<input type="date" id="registration_date" name="registration_date" required>';
        echo '<button type="submit">Register for Event</button>';
        echo '</form>';
    } else {
        echo '<p>Venue details not found.</p>';
    }
    ?>
</body>
</html>
