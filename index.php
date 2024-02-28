<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
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
        background: url('images/BG.webp') no-repeat center center fixed;
        background-size: cover;
    }

    main {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.85); /* Add some transparency to the background */
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        color: #333;
    }

    h2 {
        color: #333;
    }

    p {
        color: #555;
    }
    </style>
</head>
<body>
    <?php include_once('includes/header.php');?>
    <main>
        <div class="home-container">
            <h2 align="center">Welcome to Event Registry Hub</h2>
            <p>Login to access personalized features and make your events unforgettable!</p>

            <section class="action-section">
                <h2>Create Your Venue</h2>
                <p>Are you a venue owner? Showcase your unique space, manage details, and easily accept bookings through our platform. Join now to enhance your venue's visibility and reach a wider audience.</p>
            </section>

            <section class="action-section">
                <h2>Explore Venues</h2>
                <p>Planning an event? Discover a diverse range of venues suitable for weddings, parties, conferences, and more. Explore and book the perfect space that matches your event requirements.</p>
            </section>

            <section class="community-section">
                <h2>Join Our Community</h2>
                <p>Connect with a vibrant community of event organizers and venue owners. Share insights, collaborate on events, and stay informed about the latest trends in the event industry. Event Registry Hub is more than a platform; it's a community that supports your event journey.</p>
            </section>

            <section class="about-section">
                <h2>About Event Registry Hub</h2>
                <p>Event Registry Hub is your one-stop solution for seamless event planning. Whether you're an event organizer or a venue owner, our platform is designed to simplify the process. From finding the perfect venue to managing bookings, we've got you covered. Join us and make your events memorable!</p>
            </section>
        </div>
    </main>
</body>
</html>
