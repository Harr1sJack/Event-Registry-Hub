<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #e6f7ff;
    }

    header {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: center;
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
        padding: 5px 10px;
        border: 1px solid #fff;
        border-radius: 4px;
    }

    nav a:hover {
        background-color: #fff;
        color: #333;
    }
</style>

<header>
        <h1>EVENT REGISTRY HUB</h1>
    </header>
<nav>
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
    <a href="create.php">CREATE VENUE</a>
    <a href="search.php">SEARCH VENUE</a>
    <a href="help.php">HELP & SUPPORT</a>
    <a href="explore.php">MAIL US</a>
</nav>