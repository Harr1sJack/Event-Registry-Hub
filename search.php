<?php
include_once('includes/dbconnection.php');

// Fetch all venues from the database
$query = "SELECT * FROM venues";
$result = $conn->query($query);

// Check for errors in the query execution
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Check if there are any venues
if ($result->num_rows > 0) {
    $venues = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $venues = []; // No venues found
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Venues</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e6f7ff;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden; /* Hide the table borders */
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Alternating row colors */
        }

        .view-button {
            padding: 8px 12px;
            background-color: #4285f4;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .view-button:hover {
            background-color: #3367d6;
        }
    </style>
</head>
<body>
    <?php
    include_once('includes/header.php');
    
    echo("<h1>Search Venues</h1>");
    // Display venues in a table
    if (!empty($venues)) {
        echo '<table>';
        echo '<tr><th>Venue Name</th><th>Venue Capacity</th><th>Venue Location</th><th>Venue Price</th><th>Venue Description</th><th>Action</th></tr>';
        foreach ($venues as $venue) {
            echo '<tr>';
            echo '<td>' . $venue['venue_name'] . '</td>';
            echo '<td>' . $venue['venue_capacity'] . '</td>';
            echo '<td>' . $venue['venue_location'] . '</td>';
            echo '<td>' . $venue['venue_price'] . '</td>';
            echo '<td>' . $venue['venue_description'] . '</td>';
            echo '<td><a href="venue.php"><button class="view-button">View</button></a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No venues found.</p>';
    }
    ?>
</body>
</html>
