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
        $uname = htmlspecialchars($_POST["uname"]);
        $pword = htmlspecialchars($_POST["pword"]);
        $redirect_url = htmlspecialchars($_POST["redirect_url"]);
        if (isset($_POST["logout"]))
        {
            session_unset();
            session_destroy();
            header("Location: " . $redirect_url);
            die();
        }
        if (try_login($uname, $pword)) {
            header("Location: " . $redirect_url);
            die();
        }
        else 
        {
            ?>
            Please sign up below:
            <form action="login.php" method="post">
                <label for="uname">Username</label><input type="text" name="uname" id="uname"><br>
                <label for="pass1">Password</label><input type="password" name="pass1" id="pass1"><br>
                <label for="pass2">Confirm Password</label><input type="password" name="pass2" id="pass2"><br>
                <input type="submit" value="Submit">
            </form>
            <?php
        }
         ?>
    </div>
</body>
</html>