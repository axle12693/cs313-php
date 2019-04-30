<?php include("header.php") ?>
<?php
    if (isset($_SESSION["hello"]))
    {
        echo "<p>Welcome " . $_SESSION["hello"] . "</p>";
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