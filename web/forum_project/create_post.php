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
        $forum = htmlspecialchars($_GET["forum"]);
        setup_current_forum_nav($forum);
        require("forum_header.php");
        // if (isset($_POST["title"]) && isset($_POST["post-content"]) and is_logged_in())
        // {
            
        // }
        ?>  
        <form action="create_post.php" method="post">
            <input type="text" name="title" placeholder="Post title"><br>
            <textarea name="post-content" cols="30" rows="10"></textarea><br>
            <input type="submit" value="Post">
        </form>
    </div>
</body>
</html>