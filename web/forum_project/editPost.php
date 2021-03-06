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
        if (!isset($_GET['post_id'])) 
        {
            header("Location: index.php");
            die();
        }
        $post_id = htmlspecialchars($_GET["post_id"]);
        $redirect = "post.php?post=" . $post_id;
        if (is_allowed_to_edit_post($post_id)) 
        {
            if (isset($_POST["title"]))
            {
                $title = htmlspecialchars($_POST["title"]);
                $text = htmlspecialchars($_POST["text"]);
                edit_post($post_id, $title, $text);
                header("Location: " . $redirect);
                die();
            }
            ?>
            <form action="editPost.php?post_id=<?php echo $post_id; ?>" method="post">
                <input type="text" name="title" id="title" value="<?php echo get_post_title($post_id); ?>"><br>
                <textarea class="form-control" name="text" id="text" cols="30" rows="10"><?php echo get_post_text($post_id); ?></textarea><br>
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