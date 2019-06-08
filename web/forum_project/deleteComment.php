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
        if (!isset($_GET['comment_id'])) 
        {
            header("Location: index.php");
            die();
        }
        $comment_id = htmlspecialchars($_GET["comment_id"]);
        $redirect = "post.php?post=" . get_post_from_comment($comment_id);
        if (is_allowed_to_delete_comment($comment_id)) 
        {
            delete_comment($comment_id);
        }
        header("Location: " . $redirect);
        die();
        ?>
    </div>
</body>
</html>