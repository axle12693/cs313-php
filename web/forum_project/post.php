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
    </div>
</body>
</html>