<?php

function add_forum_categories()
{
    //Connect to DB
    $conn = pg_connect(getenv("DATABASE_URL"));

    //Get category IDs and titles
    $result = pg_prepare($conn, "get_categories", 'SELECT * FROM FORUM_CATEGORY');
    $result = pg_execute($conn, "get_categories", array());
    $category_rows = pg_fetch_all($result);

    //Get forum IDs and titles for each category
    //$forums = array();
    foreach ($category_rows as $key => $value)
    {
        // $result = pg_prepare($conn, "get_forums", 'SELECT * FROM Forum WHERE forum_category_id = $1');
        // $result = pg_execute($conn, "get_forums", array())
        print_r($key . " " . $value);
    }
}

add_forum_categories();

?>