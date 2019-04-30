<?php include("header.php") ?>
<?php
    session_start();
    if (isset($_GET['admin']))
    {
        $_SESSION['hello'] = "Administrator";
        echo 1;
    }
    else
    {
        $SESSION["hello"] = "Tester";
        echo 2;
    }
?>
    <form action="login.php">
        <input type="button" value="Login as administrator" method="get" name="admin">
        <input type="button" value="Login as tester" method="get" name="tester">
    </form>
</body>
</html>