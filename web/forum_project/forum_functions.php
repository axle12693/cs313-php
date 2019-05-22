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
            echo("<div class=\"link\" onclick=window.location.href='forum.php?forum=" . $fvalue["forum_id"] . "'>" . $fvalue["title"] . "</div>");
        }

        echo("</div>");
    }
    echo("</div>");
}

function add_forum_posts($forum_id)
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "get_posts", "
    SELECT      p.title, p.post_content, p.date_last_updated, au.username
    FROM        Post p INNER JOIN App_User au 
    ON          p.app_user_id = au.app_user_id
    WHERE       p.forum_id = $1
    ORDER BY    p.date_last_updated DESC
    ");
    $result = pg_execute($conn, "get_posts", array($forum_id));
    $data_array = pg_fetch_all($result);
    echo("<div class=\"container\">");
    foreach ($data_array as $key => $value)
    {
        echo("<div class=\"card bg-primary text-white\">");
        echo("<div class=\"card-body\">");
        echo("Post " . $value["title"] . "<br>");
        echo("</div></div>");
    }
    echo("</div>");
}

?>