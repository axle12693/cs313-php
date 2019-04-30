<?php include("header.php") ?>
<?php
    if (isset($_SESSION["hello"]))
    {
        <p>Welcome $_SESSION["hello"];</p>
    }
    else
    {
        <p>Welcome. You are not logged in.</p>
    }
?>
    <p> Welcome. You are not logged in.</p>
</body>
</html>