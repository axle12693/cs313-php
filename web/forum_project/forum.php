<?php
require($_SERVER['DOCUMENT_ROOT'] . '/header1.php');
require("forum_functions.php");
?>

<title>Alex's House of Mythical Pets</title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/header2.php'; ?>
    <div id="body_container">
        <?php
        $forum = htmlspecialchars($_GET["forum"]);
        $forum_title = htmlspecialchars($_GET["title"]);
        echo("Forum $forum is called $forum_title.")
        // $conn = pg_connect(getenv("DATABASE_URL"));
        // $result = pg_prepare($conn, "get_forum", 'SELECT title FROM Forum WHERE forum_category_id = $1');
        // $result = pg_execute($conn, "get_forum", array($forum));

        ?>  
    </div>
</body>
</html>