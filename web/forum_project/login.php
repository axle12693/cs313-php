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
            <form action="login.php" method="post">
                Please sign up below:<br><br>
                <div class="row">
                    <div class="col-sm-2">
                        <label for="uname">Username</label>
                    </div>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" name="uname" id="uname">
                    </div>
                    <div class="col-sm-4"></div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label for="pass1">Password</label>
                    </div>
                    <div class="col-sm-3">
                        <input class="form-control" type="password" name="pass1" id="pass1">
                    </div>
                    <div class="col-sm-4"></div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label for="pass2">Confirm Password</label>
                    </div>
                    <div class="col-sm-3">
                        <input class="form-control" type="password" name="pass2" id="pass2">
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <input class="form-control" type="submit" value="Submit">
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </form>
            <?php
        }
         ?>
    </div>
</body>
</html>