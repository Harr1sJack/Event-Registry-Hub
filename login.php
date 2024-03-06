<?php
session_start();
echo("<script src='index.js'></script>");
include_once('includes/dbconnection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $checkCredentialsQuery = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkCredentialsQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $name = $row['username'];
        $pass = $row['password'];
        $email = $row['email'];
        $userRole = $row['userrole'];

        if ($password == $pass) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['userrole'] = $userRole;

            header("Location: index.php");
            exit();
        } else {
            echo "<script>showAlert('Invalid username or password. Please try again.');</script>";
        }
    } else {
        echo "<script>showAlert('Invalid username or password. Please try again.');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Event Registry Hub</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    header {
        position: fixed;
        top: 0;
        width: 100%;
        background-color: #4285f4;
        color: #fff;
        padding: 5px 0;
        text-align: center;
        font-size: 1.0em;
        z-index: 1000; /* Ensure the header appears above other elements */
    }

    main {
        position: fixed;
        top: 70px;
        max-width: 400px;
        margin: 70px auto; /* Adjusted margin to accommodate fixed header */
        padding: 30px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 8px;
    }

    input, select {
        margin-bottom: 16px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    button {
        padding: 10px;
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

    p {
        margin-top: 16px;
        text-align: center;
    }

    a {
        color: #4285f4;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

</head>
<body>
    <header>
        <h1>Login to Event Registry Hub</h1>
    </header>
    <main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
        <p>Don't want to sign in? <a href="index.php">Home page</a>.</p>
    </main>
</body>
</html>
