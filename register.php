
<?php
session_start();
echo("<script src='index.js'></script>");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $userRole = $_POST["userRole"];

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "eventregistryhub";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $checkUsernameQuery = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkUsernameQuery);

    if ($result->num_rows > 0) {
        echo "<script>showAlert('Username already taken. Please choose a different username.');</script>";
    } elseif ($password !== $confirmPassword) {
        echo "<script>showAlert('Password and Confirm Password do not match. Please try again.');</script>";
    } else {

        $insertQuery = "INSERT INTO users (username,password,email,userrole) VALUES ('$username', '$password', '$email' ,'$userRole')";
        if ($conn->query($insertQuery) === TRUE) 
        {
            // Registration successful
            echo "<script>showAlert('Registration successful! You can now login with your credentials.');</script>";
            header("Location: login.php");
            exit();
        } else 
        {
            // Display an error message (replace with actual error handling)
            echo "<script>showAlert('Error: " . $conn->error . "');</script>";
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Event Registry Hub</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Create an Account on Event Registry Hub</h1>
    </header>
    <main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>

            <label for="userRole">User Role:</label>
            <select id="userRole" name="userRole" required>
                <option value="venue_owner">Venue Owner</option>
                <option value="customer">Customer</option>
            </select>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </main>
</body>
</html>


