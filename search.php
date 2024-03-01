<?php
include_once('includes/dbconnection.php');

$query = "SELECT DISTINCT venue_location FROM venues";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    $locations = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $locations = [];
}

// Handle the location filter
if (isset($_GET['location']) && !empty($_GET['location'])) {
    $selectedLocation = $_GET['location'];
    $locationFilter = " AND venue_location = '$selectedLocation'";
} else {
    $selectedLocation = ''; 
    $locationFilter = '';
}

// Handle the price filter
if (isset($_GET['price']) && is_numeric($_GET['price'])) {
    $selectedPrice = floatval($_GET['price']);
    $priceFilter = " AND venue_price <= $selectedPrice";
} else {
    $selectedPrice = ''; 
    $priceFilter = '';
}

// Handle the capacity filter
if (isset($_GET['capacity']) && is_numeric($_GET['capacity'])) {
    $selectedCapacity = intval($_GET['capacity']);
    $capacityFilter = " AND venue_capacity >= $selectedCapacity";
} else {
    $selectedCapacity = ''; 
    $capacityFilter = '';
}

$filterQuery = "SELECT * FROM venues WHERE 1 $locationFilter $priceFilter $capacityFilter";

$filterResult = $conn->query($filterQuery);

if (!$filterResult) {
    die("Filter query failed: " . $conn->error);
}

if ($filterResult->num_rows > 0) {
    $venues = $filterResult->fetch_all(MYSQLI_ASSOC);
} else {
    $venues = [];
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

        .filter-dropdown {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .filter-dropdown label {
            margin-right: 10px;
        }

        .filter-dropdown select,
        .filter-dropdown input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .filter-dropdown button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .filter-dropdown button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    include_once('includes/header.php');

    echo("<h1>Search Venues</h1>");

    // Display filter dropdown for locations
    echo '<form method="get" class="filter-dropdown">';
    echo '<label for="location">Filter by Location:</label>';
    echo '<select id="location" name="location">';
    echo '<option value="">All Locations</option>'; // Option to show all locations
    foreach ($locations as $location) {
        $selected = ($selectedLocation === $location['venue_location']) ? 'selected' : '';
        echo '<option value="' . $location['venue_location'] . '" ' . $selected . '>' . $location['venue_location'] . '</option>';
    }
    echo '</select>';

    // Display filter input for price
    echo '<label for="price">Filter by Price (max):</label>';
    echo '<input type="number" id="price" name="price" value="' . $selectedPrice . '" placeholder="Enter max price">';

    // Display filter input for capacity
    echo '<label for="capacity">Filter by Capacity (min):</label>';
    echo '<input type="number" id="capacity" name="capacity" value="' . $selectedCapacity . '" placeholder="Enter min capacity">';

    echo '<button type="submit">Apply Filter</button>';
    echo '</form>';

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
        echo '<p>No venues found for the selected filters.</p>';
    }
    ?>
</body>
</html>
