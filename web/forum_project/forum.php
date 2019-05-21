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
        $conn = pg_connect(getenv("DATABASE_URL"));
        $result = pg_prepare($conn, "get_posts", '
        SELECT      p.title, p.post_content, p.date_last_updated, au.username
        FROM        Post p INNER JOIN App_User au 
        ON          p.app_user_id = au.app_user_id
        WHERE       forum_id = $1
        ORDER BY    p.date_last_updated DESC
        ');
        $result = pg_execute($conn, "get_posts", array($forum));
        $data_array = pg_fetch_all($result);
        foreach ($data_array as $key => $value)
        {
            echo("Post " . $value["p.title"] . "<br>");
        }
        ?>  
    </div>
</body>
</html>