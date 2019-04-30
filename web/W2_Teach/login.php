<?php include("header.php") ?>
<?php
    session_start();
    if (isset($_GET['admin']))
    {
        $_SESSION['hello'] = "Administrator";
        echo 1;
    }
    elseif (isset($_GET['tester']))
    {
        $SESSION["hello"] = "Tester";
        echo 2;
    }
    else
    {
        echo 0;
    }
?>
    <form action="login.php" method="get">
        <input type="button" value="Login as administrator" method="get" name="admin">
        <input type="button" value="Login as tester" method="get" name="tester">
    </form>
</body>
</html>