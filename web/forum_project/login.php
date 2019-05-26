<?php
require($_SERVER['DOCUMENT_ROOT'] . '/header1.php');
require("forum_functions.php");
?>

<title>Alex's House of Mythical Pets</title>
</head>
<body>
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/header2.php'); ?>
    <div id="body_container">
        <?php 
        require("forum_header.php");
        $uname = $_POST["uname"]); //htmlspecialchars($_POST["uname"]);
        $pword = htmlspecialchars($_POST["pword"]);
        $redirect_url = htmlspecialchars($_POST["redirect_url"]);
        if (try_login($uname, $pword)) {
            header("Location: " . $redirect_url);
            die();
        }
        else 
        {
            echo("Login failed! This will be implemented later.");
        }
         ?>
    </div>
</body>
</html>