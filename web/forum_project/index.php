<?php

function add_forum_categories()
{
    $conn = pg_connect(getenv("DATABASE_URL"));

    $result = pg_prepare($conn, "my_query", 'SELECT * FROM FORUM_CATEGORY');

    $result = pg_execute($conn, "my_query", array());

    print_r(pg_fetch_all($result));
}

add_forum_categories();

?>