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
        background: url('images/bg1.jpg') no-repeat center center fixed;
        background-size: cover;
    }
    body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.2); /* Adjust the transparency as needed */
    z-index: -1;
    }

    h2 {
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 1);
        color: #fff;
        margin: 100px auto;
        font-size: 40px;
    }
    </style>

</head>
<body>
    <?php include_once('includes/header.php');?>
    <h2 align="center">Welcome to Event Registry Hub</h2>
    </main>
</body>
</html>
