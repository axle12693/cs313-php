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
        if (!isset($_GET['post_id'])) 
        {
            header("Location: index.php");
            die();
        }
        $post_id = htmlspecialchars($_GET["post_id"]);
        $redirect = "forum.php?forum=" . get_forum_from_post($post_id);
        if (is_allowed_to_delete_post($post_id)) 
        {
            delete_post($post_id);
        }
        header("Location: " . $redirect);
        die();
        ?>
    </div>
</body>
</html>