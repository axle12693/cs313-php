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
        $forum = htmlspecialchars($_REQUEST["forum"]);
        echo($forum);
        setup_current_forum_nav($forum);
        require("forum_header.php");
        // if (isset($_POST["title"]) && isset($_POST["post-content"]) && is_logged_in())
        // {
        //     $conn = pg_connect(getenv("DATABASE_URL"));
        //     $result = pg_prepare($conn, "create_post", "
        //     INSERT INTO 
        //     ");
        //     $result = pg_execute($conn, "create_post", array($uname));
        //     //redirect after everything
        // }

        ?>  
        <form action="create_post.php" method="post">
            <input type="hidden" name="forum" value="<?php echo($forum); ?>">
            <?php echo($forum); ?>
            <input type="text" name="title" placeholder="Post title"><br>
            <textarea name="post-content" cols="30" rows="10"></textarea><br>
            <input type="submit" value="Post">
        </form>
    </div>
</body>
</html>