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
        $post_id = htmlspecialchars($_REQUEST["post_id"]);
        setup_current_forum_nav($forum);
        require("forum_header.php");
        if (isset($_POST["reply"]) && is_logged_in())
        {
            $reply = htmlspecialchars($_POST["reply"]);
            $conn = pg_connect(getenv("DATABASE_URL"));
            $result = pg_prepare($conn, "create_reply", "
            INSERT INTO Post_Comment
            (post_id, app_user_id, post_comment_content, date_last_updated)
            VALUES
            ($1, $2, $3, current_timestamp)
            ");
            $result = pg_execute($conn, "create_reply", array($post_id, get_logged_in_user_id(), $reply));

            sleep(1);
            header("Location: post.php?post=$post_id");
        }
        ?>  
    </div>
</body>
</html>