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
        background-color: #e6f7ff;
    }

    header {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: right;
    }

    nav {
        background-color: #007bff;
        display: flex;
        justify-content: space-around;
        padding: 10px;
    }

    nav a {
        color: #fff;
        text-decoration: none;
        padding: 5px 20px;
        border: 1px solid #fff;
        border-radius: 4px;
    }

    nav a:hover {
        background-color: #fff;
        color: #333;
    }

    main {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: #ffffff;
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
        border: 2px solid #007bff;
    }

    th, td {
        padding: 15px;
        text-align: left;
    }

    th {
        background-color: #007bff;
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
    <?php include_once('includes/header.php');?>
    <main>
        <?php
        // Display content based on user role
        if ($loggedIn) {
            if (isset($userRole)) {
                if ($userRole === 'venue_owner') {
                    include 'venueOwnerView.html';
                } else {
                    include 'customerView.html';
                }
            }
        } else {
            include 'defaultView.html';
        }
        ?>
    </main>

</body>
</html>
