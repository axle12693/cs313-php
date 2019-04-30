<?php include("header.php") ?>
<?php
    session_start();
    if (isset($_SESSION["hello"]))
    {
        echo("<p>Welcome " . $_SESSION["hello"] . "</p>");
    }
    else
    { 
?>
        <p>Welcome. You are not logged in.</p>
<?php
    }
?>
</body>
</html>