<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa; /* Light background color */
}

header {
    background-color: #dc3545; /* Red header color */
    color: #fff;
    padding: 15px;
    text-align: center;
}

nav {
    background-color: #007bff;
    display: flex;
    justify-content: center;
    align-items: right; /* Align items vertically */
    padding: 10px;
}

nav a {
    color: #fff;
    text-decoration: none;
    padding: 10px 20px; /* Increase padding for better touch experience */
    border-radius: 8px;
    transition: background-color 0.3s, color 0.3s; /* Add smooth transition effect */
}

nav a:hover {
    background-color: #0056b3; /* Darker blue on hover */
    color: #fff;
}

</style>

<header>
        <h1>EVENT REGISTRY HUB</h1>
    </header>
<nav>
    <a href="index.php">HOME</a>
    <a href="create.php">CREATE VENUE</a>
    <a href="search.php">SEARCH VENUE</a>
    <a href="explore.php">MAIL US</a>
    <?php
        session_start();
        if (isset($_SESSION['username'])) {
            $loggedIn = true;
        } else {
            $loggedIn = false;
        }
        if (isset($_SESSION['userrole'])) {
            $userRole = $_SESSION['userrole'];
        }

        if ($loggedIn) {
            echo '<a href="logout.php">LOG OUT</a>';
            echo '<a href="profile.php">MY PROFILE</a>';
        } else {
            echo '<a href="login.php">LOGIN</a>';
        }
    ?>
</nav>