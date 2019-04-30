<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <div>Fake Company Name!</div>
        <?php
            if (basename($_SERVER['PHP_SELF']) == "home.php")
            {
                echo("
                <a href=\"home.php\" style=\"font-weight: bold\">Home</a>
                <a href=\"about-us.php\">About Us</a>
                <a href=\"login.php\">Log in</a>
                ");
            }
            elseif (basename($_SERVER['PHP_SELF']) == "about-us.php")
            {
                echo("
                <a href=\"home.php\">Home</a>
                <a href=\"about-us.php\" style=\"font-weight: bold\">About Us</a>
                <a href=\"login.php\">Log in</a>
                ");
            }
            else
            {
                echo("
                <a href=\"home.php\">Home</a>
                <a href=\"about-us.php\">About Us</a>
                <a href=\"login.php\" style=\"font-weight: bold\">Log in</a>
                ");
            }
        ?>

    </header>