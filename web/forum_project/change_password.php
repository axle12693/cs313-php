<?php
require($_SERVER['DOCUMENT_ROOT'] . '/header1.php');
require("forum_functions.php");
?>

<title>Alex's House of Mythical Pets</title>
</head>
<body>
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/header2.php'); ?>

    <?php
    if (isset($_POST["oldPass"]))
    {
        // echo("It is set.");
        $oldPass = htmlspecialchars($_POST["oldPass"]);
        $newPass1 = htmlspecialchars($_POST["newPass1"]);
        $newPass2 = htmlspecialchars($_POST["newPass2"]);
        if (verify_password(get_logged_in_username(), $oldPass) && $newPass1 == $newPass2)
        {
            // echo("Verified, and new1 = new2");
            // echo("User id is: " . get_logged_in_user_id());
            $conn = pg_connect(getenv("DATABASE_URL"));
            $pw_hash = password_hash($newPass1, PASSWORD_BCRYPT);
            $result = pg_prepare($conn, "change_pw", "
            UPDATE  App_User
            SET     pw_hash = $1
            WHERE   app_user_id = $2
            ");
            $result = pg_execute($conn, "change_pw", array($pw_hash, get_logged_in_user_id()));
            header("Location: index.php");
        }
    }
    ?>

    <div id="body_container">
        <?php
        require("forum_header.php");
        ?>  
        <form action="change_password.php" method="post">
            <input type="password" name="oldPass"> <br>
            <input type="password" name="newPass1"><br>
            <input type="password" name="newPass2"><br>
            <input type="submit">
        </form>
    </div>
</body>
</html>