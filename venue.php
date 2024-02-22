<?php
include_once('includes/dbconnection.php');

$venueName = isset($_GET['name']) ? urldecode($_GET['name']) : '';

$query = "SELECT * FROM venues WHERE venue_name = '$venueName'";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    $venue = $result->fetch_assoc();
} else {
    header("Location: search.php");
    exit();
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

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 60%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
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
    </style>
</head>
<body>
    <?php
    include_once('includes/header.php');
    
    echo '<h1>Venue Details</h1>';
    echo '<table>';
    foreach ($venue as $key => $value) {
        echo '<tr>';
        echo '<th>' . $key . '</th>';
        echo '<td>' . $value . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>
</body>
</html>
