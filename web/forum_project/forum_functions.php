<?php

function add_forum_categories()
{
    //Connect to DB
    $conn = pg_connect(getenv("DATABASE_URL"));

    //Get category IDs and titles
    $result = pg_prepare($conn, "get_categories", 'SELECT * FROM FORUM_CATEGORY');
    $result = pg_execute($conn, "get_categories", array());
    $category_rows = pg_fetch_all($result);
    echo("<div class=\"container\">");
    //Get forum IDs and titles for each category
    foreach ($category_rows as $key => $value)
    {
        echo("<div class=\"card bg-primary text-white\">");
        echo("<div class=\"card-header\">" . $value["title"] . "</div>");
        $result = pg_prepare($conn, "get_forums", 'SELECT * FROM Forum WHERE forum_category_id = $1');
        $result = pg_execute($conn, "get_forums", array($value["forum_category_id"]));
        $forum_rows = pg_fetch_all($result);
        
        foreach ($forum_rows as $fkey => $fvalue)
        {
            echo("<div class=\"card-body alink\" onclick=window.location.href='forum.php?forum=" . $fvalue["forum_id"] . "'>" . $fvalue["title"] . "</div>");
        }

        echo("</div>");
    }
    echo("</div>");
}

function add_forum_posts($forum_id)
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "get_posts", "
    SELECT      p.post_id, p.title, p.post_content, p.date_last_updated::date, au.username
    FROM        Post p INNER JOIN App_User au 
    ON          p.app_user_id = au.app_user_id
    WHERE       p.forum_id = $1
    ORDER BY    p.date_last_updated::date DESC
    ");
    $result = pg_execute($conn, "get_posts", array($forum_id));
    $data_array = pg_fetch_all($result);
    echo("<div class=\"container\">");
    $i = 0;
    foreach ($data_array as $key => $value)
    {
        if ($i % 2 == 0)
        {
            echo("<div class=\"card bg-primary text-white\">");
        }
        else
        {
            echo("<div class=\"card bg-info text-white\">");
        }
        $i+=1;
        echo("<div class=\"card-body alink\" onclick=window.location.href=\"post.php?post=" . $value["post_id"] . "\">");
        echo($value["title"] . " - " . $value["username"] . " - " . $value["date_last_updated"]);
        echo("</div></div>");
    }
    echo("</div>");
}

function add_post_and_comments($post_id) 
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "get_post", "
    SELECT      p.post_id, p.title, p.post_content, p.date_last_updated::date, au.username
    FROM        Post p INNER JOIN App_User au 
    ON          p.app_user_id = au.app_user_id
    WHERE       p.post_id = $1
    ");
    $result = pg_execute($conn, "get_post", array($post_id));
    $post_array = pg_fetch_all($result);

    $result = pg_prepare($conn, "get_comments", "
    SELECT      pc.post_comment_content, pc.app_user_id, pc.date_last_updated::date
    FROM        Post p INNER JOIN Post_Content pc
    ON          p.app_user_id = pc.app_user_id
    WHERE       pc.post_id = $1
    ORDER BY    pc.date_last_updated::date
    ");
    $result = pg_execute($conn, "get_comments", array($post_id));
    $comment_array = pg_fetch_all($result);

    echo("<div class=\"container\"");
    echo("This is where the post and comments go!");
    echo("</div>");
}

?>