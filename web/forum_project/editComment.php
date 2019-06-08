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
        $post_id = 0;
        if (!isset($_GET['comment_id'])) 
        {
            header("Location: index.php");
            die();
        }
        $post_id = htmlspecialchars($_GET["comment_id"]);
        if (isset($_POST["text"]))
        {
            $text = htmlspecialchars($_POST["text"]);
            edit_comment($comment_id, $text);
            header("Location: index.php");
            die();
        }
        if (is_allowed_to_edit_comment($comment_id)) 
        {
           ?>
            <form action="editComment.php?comment_id=<?php echo $comment_id; ?>" method="post">
                <textarea class="form-control" name="text" id="text" cols="30" rows="10"></textarea><br>
                <button type="submit">Reply</button>
                
            </form>
           <?php
        }
        else
        {
            header("Location: index.php");
            die();
        }
        ?>
    </div>
</body>
</html>