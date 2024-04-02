<?php
session_start();

// Include database connection
include_once('includes/dbconnection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user ID from the session
$userId = $_SESSION['user_id'];

// Fetch past created venues
$createdVenuesQuery = "SELECT * FROM venues WHERE user_id = $userId";
$createdVenuesResult = $conn->query($createdVenuesQuery);

if (!$createdVenuesResult) {
    die("Query failed: " . $conn->error);
}

$createdVenues = ($createdVenuesResult->num_rows > 0) ? $createdVenuesResult->fetch_all(MYSQLI_ASSOC) : [];

// Fetch registered venues with user information
$registeredVenuesQuery = "SELECT v.*, vr.registration_date, u.username
                        FROM venues v
                        JOIN venue_registrations vr ON v.venue_id = vr.venue_id
                        JOIN users u ON vr.user_id = u.user_id
                        WHERE vr.user_id = $userId";

$registeredVenuesResult = $conn->query($registeredVenuesQuery);

if (!$registeredVenuesResult) {
    die("Query failed: " . $conn->error);
}

$registeredVenues = ($registeredVenuesResult->num_rows > 0) ? $registeredVenuesResult->fetch_all(MYSQLI_ASSOC) : [];

// Include header
include_once('includes/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        h2 {
            margin-top: 30px;
        }

        .venue-details {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .venue-details p {
            margin: 0;
            padding: 5px 0;
        }

        .venue-details hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #ccc;
        }

        .registered-venues {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .registered-venues p {
            margin: 0;
            padding: 5px 0;
        }

        .registered-venues hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h1>User Profile</h1>

    <h2>Created Venues:</h2>
    <?php
    if (!empty($createdVenues)) {
        foreach ($createdVenues as $venue) {
            // Fetch the corresponding venue details from the "venues" table
            $venueId = $venue['venue_id'];
            $venueDetailsQuery = "SELECT * FROM venues WHERE venue_id = $venueId";
            $venueDetailsResult = $conn->query($venueDetailsQuery);

            if (!$venueDetailsResult) {
                die("Query failed: " . $conn->error);
            }

            $venueDetails = ($venueDetailsResult->num_rows > 0) ? $venueDetailsResult->fetch_assoc() : [];

            echo '<div class="venue-details">';
            echo '<p>Venue Name: ' . $venue['venue_name'] . '</p>';
            echo '<p>Venue Capacity: ' . $venue['venue_capacity'] . '</p>';
            echo '<p>Venue Location: ' . $venueDetails['venue_location'] . '</p>';
            echo '<p>Venue Price: ' . $venueDetails['venue_price'] . '</p>';
            echo '<p>Venue Description: ' . $venueDetails['venue_description'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No venues created.</p>';
    }
    ?>

    <h2>Registered Venues:</h2>
    <?php
    if (!empty($registeredVenues)) {
        foreach ($registeredVenues as $venue) {
            echo '<div class="registered-venues">';
            echo '<p>Venue Name: ' . $venue['venue_name'] . '</p>';
            echo '<p>Venue Capacity: ' . $venue['venue_capacity'] . '</p>';
            echo '<p>Registration Date: ' . $venue['registration_date'] . '</p>';
            echo '<p>Booked by: ' . $venue['username'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No venues registered.</p>';
    }
    ?>
</body>
</html>

