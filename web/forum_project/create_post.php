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
        setup_current_forum_nav($forum);
        require("forum_header.php");
        if (isset($_POST["title"]) && isset($_POST["post-content"]) && is_logged_in())
        {
            $title = htmlspecialchars($_POST["title"]);
            $post_content = htmlspecialchars($_POST["post-content"]);
            $conn = pg_connect(getenv("DATABASE_URL"));
            $result = pg_prepare($conn, "create_post", "
            INSERT INTO Post
            (post_id, forum_id, app_user_id, title, post_content, date_last_updated)
            VALUES
            (nextval('s_Post'), $1, $2, $3, $4, current_timestamp)
            ");
            $result = pg_execute($conn, "create_post", array($forum, get_logged_in_user_id(), $title, $post_content));

            $result = pg_prepare($conn, "get_last_post_id", "
            SELECT currval('s_Post')
            ");
            $result = pg_execute($conn, "get_last_post_id", array());
            $data = pg_fetch_all($result);
            sleep(1);
            header("Location: post.php?post=" . $data[0]["currval"]);
        }

        ?>  
        <div class="container">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <form action="create_post.php" method="post">
                        <input type="hidden" name="forum" value="<?php echo($forum); ?>">
                        <input class="form-control" type="text" name="title" placeholder="Post title"><br>
                        <textarea class="form-control" name="post-content" cols="30" rows="10"></textarea><br>
                        <input type="submit" value="Post">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>