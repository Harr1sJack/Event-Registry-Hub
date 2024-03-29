<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
}

header {
    background: linear-gradient(45deg, lightsalmon, lightskyblue, #0056b3);
    color: #fff;
    padding: 15px;
    text-align: center;
    background-size: 200% 200%;
    animation: gradientAnimation 5s infinite linear;
}

@keyframes gradientAnimation {
    0% {
        background-position: 0% 50%;
    }
    100% {
        background-position: 100% 50%;
    }
}

nav {
    background: linear-gradient(45deg, lightsalmon, lightskyblue, #0056b3);
    display: flex;
    justify-content: center;
    align-items: right; 
    padding: 10px;
    background-size: 200% 200%;
    animation: gradientAnimation 5s infinite linear;
}

nav a {
    color: #fff;
    text-decoration: none;
    padding: 10px 30px; 
    border-radius: 8px;
    transition: background-color 0.90s, color 0.90s;
}

nav a:hover {
    background-color: #0056b3;
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
    <a href="mail.php">MAIL US</a>
    <?php
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }

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