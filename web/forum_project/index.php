<?php

function add_forum_categories()
{
    echo(getenv("DATABASE_URL"));

    // $conn = pg_connect();

    // $result = pg_prepare($conn, "my_query", 'SELECT * FROM FORUM_CATEGORY');

    // $result = pg_execute($conn, "my_query", array());

    // echo($result)
}

add_forum_categories()

?>