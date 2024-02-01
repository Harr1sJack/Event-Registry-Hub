<?php
session_start();
echo("<script src='index.js'></script>");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "eventregistryhub";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $checkCredentialsQuery = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkCredentialsQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['username'];
        $pass = $row['password'];
        $email = $row['email'];
        $userRole = $row['userrole'];

        if ($password == $pass) {
            $_SESSION['username'] = $name;
            $_SESSION['email'] = $email
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
    <link rel="stylesheet" href="styles.css">
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
    </main>
</body>
</html>
