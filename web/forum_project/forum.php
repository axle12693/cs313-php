<?php
require($_SERVER['DOCUMENT_ROOT'] . '/header1.php');
require("forum_functions.php");
?>

<title>Alex's House of Mythical Pets</title>
</head>
<body>
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/header2.php'); 
          require("forum_header.php")?>

    <div id="body_container">
        <?php
        $forum = htmlspecialchars($_GET["forum"]);
        //$forum_title = htmlspecialchars($_GET["title"]);
        add_forum_posts($forum);
        ?>  
    </div>
</body>
</html>