
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

        $insertQuery = "INSERT INTO users (username,password,email,role) VALUES ('$username', '$password', '$email' ,'$userRole')";
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
        top: 40;
        max-width: 400px;
        margin: 70px auto; /* Adjusted margin to accommodate fixed header */
        padding: 20px;
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
        <h1>Create an Account</h1>
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


