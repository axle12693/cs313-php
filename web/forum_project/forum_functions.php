<?php

function add_forum_categories()
{
    //Connect to DB
    $conn = pg_connect(getenv("DATABASE_URL"));

    //Get category IDs and titles
    $result = pg_prepare($conn, "get_categories", 'SELECT * FROM FORUM_CATEGORY');
    $result = pg_execute($conn, "get_categories", array());
    $category_rows = pg_fetch_all($result);
    echo("<ol>");
    //Get forum IDs and titles for each category
    foreach ($category_rows as $key => $value)
    {
        echo("<li>" . $value["title"] . "<ol>");
        $result = pg_prepare($conn, "get_forums", 'SELECT * FROM Forum WHERE forum_category_id = $1');
        $result = pg_execute($conn, "get_forums", array($value["forum_category_id"]));
        $forum_rows = pg_fetch_all($result);
        
        foreach ($forum_rows as $fkey => $fvalue)
        {
            echo("<li><a href=\"forum.php?forum=" . $fvalue["forum_id"] . "&title=" . $fvalue["title"] . "\">" . $fvalue["title"] . "</a></li>");
        }

        echo("</ol></li>");
    }
    echo("</ol>");
}

?>