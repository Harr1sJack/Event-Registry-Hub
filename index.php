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
            // Simulated user login status and role (replace with actual login and role logic)
            $loggedIn = true; // Change to false for simulation
            $userRole = 'venue_owner'; // Change to 'customer' for simulation

            if ($loggedIn) {
                echo '<a href="logout.php">Logout</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
        </div>
    </header>

    <main>
        <?php
        // Display content based on user role
        if ($loggedIn) {
            if ($userRole === 'venue_owner') {
                // Venue owner view
                echo '<h2>Create Venue</h2>';
                echo '<p>Create your venue with details and description.</p>';
                echo '<button>Create Venue</button>';
            } else {
                // Customer view
                echo '<h2>Look for Venue</h2>';
                echo '<p>Explore and book venues for your events.</p>';
                echo '<button>Look for Venue</button>';
            }
        } else {
            // Default view for non-logged-in users
            echo '<h2>Welcome to Event Registry Hub</h2>';
            echo '<p>Login to access personalized features.</p>';
        }
        ?>
    </main>

</body>
</html>
