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
        require("forum_header.php");
        $post = htmlspecialchars($_GET["post"]);
        //$forum_title = htmlspecialchars($_GET["title"]);
        add_post_and_comments($post);
        ?>  
    </div>
</body>
</html>