<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registry Hub</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e6f7ff; /* Light blue background */
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: right;
        }

        header a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #fff;
            border-radius: 4px;
        }

        header a:hover {
            background-color: #fff;
            color: #333;
        }

        main {
            max-width: 1200px; /* Increased width */
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff; /* White background */
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 2px solid #007bff; /* Border color - blue */
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #007bff; /* Header background color - blue */
            color: #fff;
        }

        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <header>
        <h1>Welcome to Event Registry Hub</h1>
        <div id="login-btn">
            <?php
            // Simulated user login status (replace with actual login logic)
            $loggedIn = false;

            if ($loggedIn) {
                echo '<a href="logout.php">Logout</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
        </div>
    </header>

    <main>
        <h2>Venue Details</h2>

        <?php
        // Simulated venue data (replace with actual data from your database)
        $venues = array(
            array('Venue 1', 'City A', 200, 1),
            array('Venue 2', 'City B', 150, 2),
            // Add more venue data as needed
        );

        if (empty($venues)) {
            echo '<p>No venues available.</p>';
        } else {
            echo '<table>';
            echo '<tr><th>Venue Name</th><th>Location</th><th>Capacity</th><th>Action</th></tr>';

            foreach ($venues as $venue) {
                echo '<tr>';
                echo '<td>' . $venue[0] . '</td>';
                echo '<td>' . $venue[1] . '</td>';
                echo '<td>' . $venue[2] . '</td>';
                echo '<td><a href="venue_details.php?id=' . $venue[3] . '">View Details</a></td>';
                echo '</tr>';
            }

            echo '</table>';
        }
        ?>
    </main>

</body>
</html>
