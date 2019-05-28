<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    $conn = pg_connect(getenv("DATABASE_URL"));
    if (isset($_POST["book"]))
    {
        $book = htmlspecialchars($_POST["book"]);
        $chapter = htmlspecialchars($_POST["chapter"]);
        $verse = htmlspecialchars($_POST["verse"]);
        $content = htmlspecialchars($_POST["content"]);

        $topic_array = array_map("htmlspecialchars", $_POST["topic"]);
        print_r($topic_array);

        $result = pg_prepare($conn, "insert_scripture", "
        INSERT INTO scripture
            (book, chapter, verse, content)
        VALUES
            ($1, $2, $3, $4)
        RETURNING scripture_id
        ");
        $result = pg_execute($conn, "insert_scripture", array($book, $chapter, $verse, $content));
        $last_inserted_scripture_id = pg_fetch_all($result)[0]["scripture_id"];

        $result = pg_prepare($conn, "insert-scrip-topic", "
        INSERT INTO scripture-topic
            (scripture_id, topic_id)
        VALUES
            ($1, $2)
        ");
        foreach ($topic_array as $key => $value)
        {
            echo($value);
            pg_execute($conn, "insert-scrip-topic", array($last_inserted_scripture_id, $value));
        }
    }
    $result = pg_prepare($conn, "get_all_scriptures", "
    SELECT * FROM Scripture
    ");
    $result = pg_execute($conn, "get_all_scriptures", array());
    $scriptures = pg_fetch_all($result);

    $result = pg_prepare($conn, "get_scrip_topics", "
    SELECT t.topic_name
    FROM Scripture_Topic sc  INNER JOIN Topic t
    ON sc.topic_id = t.topic_id
    WHERE scripture_id = $1
    ");
    foreach ($scriptures as $key => $value)
    {
        $result = pg_execute($conn, "get_scrip_topics", array($value["scripture_id"]));
        $scrip_topics = pg_fetch_all($result);
        echo("<p>" . $value['book'] . " " . $value['chapter'] . ":" . $value['verse'] . " - ");
        foreach ($scrip_topics as $key2 => $value2)
        {
            echo($value2["topic_name"] . " ");
        }
        echo("</p>");
    }

    ?>

</body>
</html>