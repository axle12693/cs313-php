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
        if (!isset($_GET['post'])) {header("Location: index.php");}
        $post = htmlspecialchars($_GET["post"]);
        $forum_id = get_forum_from_post($post);
        // echo("Post: " . $post);
        // echo("<br>Forum: " . $forum_id);
        setup_current_forum_nav($forum_id);
        require("forum_header.php");
        add_post_and_comments($post);
        ?>  
        <div class="container">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <form action="create_reply.php" method="post">
                        <input type="hidden" name="post_id" value="<?php echo($post); ?>">
                        <textarea class="form-control" name="reply" cols="30" rows="10"></textarea>
                        <input type="submit" value="Reply">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>