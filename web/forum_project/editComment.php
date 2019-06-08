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
        $comment_id = 0;
        if (!isset($_GET['comment_id'])) 
        {
            header("Location: index.php");
            die();
        }
        $comment_id = htmlspecialchars($_GET["comment_id"]);
        $redirect = "post.php?post=" . get_post_from_comment($comment_id);
        if (is_allowed_to_edit_comment($comment_id)) 
        {
            if (isset($_POST["text"]))
            {
                $text = htmlspecialchars($_POST["text"]);
                edit_comment($comment_id, $text);
                header("Location: " . $redirect);
                die();
            }
            ?>
            <form action="editComment.php?comment_id=<?php echo $comment_id; ?>" method="post">
                <textarea class="form-control" name="text" id="text" cols="30" rows="10"></textarea><br>
                <button type="submit">Reply</button>
                
            </form>
            <?php
        }
        else
        {
            header("Location: " . $redirect);
            die();
        }
        ?>
    </div>
</body>
</html>