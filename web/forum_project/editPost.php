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
        if (isset($_POST["title"]))
        {
            $title = htmlspecialchars($_POST["title"]);
            $text = htmlspecialchars($_POST["text"]);
            edit_post($post_id, $title, $text);
            header("Location: index.php");
            die();
        }
        if (is_allowed_to_edit_post($post_id)) 
        {
           ?>
            <form action="editPost.php" method="post">
                <input type="text" name="title" id="title"><br>
                <textarea class="form-control" name="text" id="text" cols="30" rows="10"></textarea><br>
                <button type="submit">Reply</button>
                
            </form>
           <?php
        }
        else
        {
            //header("Location: index.php");
            //die();
        }
        ?>
    </div>
</body>
</html>