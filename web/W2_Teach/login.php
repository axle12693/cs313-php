<?php
    session_start();
    if (isset($_POST['admin']))
    {
        $_SESSION['hello'] = "Administrator";
        header("Location: home.php");
        die();
    }
    elseif (isset($_POST['tester']))
    {
        $_SESSION["hello"] = "Tester";
        header("Location: home.php");
        die();
    }
?>
<?php include("header.php") ?>
    <form action="login.php" method="post">
        <input type="submit" value="Login as administrator" method="post" name="admin">
        <input type="submit" value="Login as tester" method="post" name="tester">
    </form>
</body>
</html>