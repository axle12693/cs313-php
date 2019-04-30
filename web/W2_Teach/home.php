<?php include("header.php") ?>
<?php
    session_start();
    if (isset($_POST['logout']))
    {
        session_unset();
        session_destroy();
        header("Location: login.php");
        die();
    }

    if (isset($_SESSION["hello"]))
    {
        echo("<p>Welcome " . $_SESSION["hello"] . "</p>");
    }
    else
    {
        header("Location: login.php");
        die();
    }
?>
<form action="home.php" method="post">
<input type="submit" value="Log out" name="logout">
</form>
</body>
</html>