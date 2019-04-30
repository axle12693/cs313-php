<?php
    session_start();
    if (isset($_POST['admin']))
    {
        $_SESSION['hello'] = "Administrator";
        header("home.php");
        die();
    }
    elseif (isset($_POST['tester']))
    {
        $SESSION["hello"] = "Tester";
        header("home.php");
        die();
    }
    else
    {
        echo 0;
    }
?>
<?php include("header.php") ?>
    <form action="login.php" method="post">
        <input type="submit" value="Login as administrator" method="post" name="admin">
        <input type="submit" value="Login as tester" method="post" name="tester">
    </form>
</body>
</html>