<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="newscripture.php" method="post">
        Book: <input type="text" name="book"><br>
        Chapter: <input type="text" name="chapter"><br>
        Verse:  <input type="text" name="verse"><br>
        Content: <textarea></textarea>
        <?php
            $conn = pg_connect(getenv("DATABASE_URL"));
            $result = pg_prepare($conn, "get_scripture_topics", "
            SELECT topic_name FROM Topic
            ");
            $result = pg_execute($conn, "get_scripture_topics", array());
            $data = pg_fetch_all($result);
            foreach ($data as $key => $value)
            {
                echo("<input type='checkbox' name='topic[]' value='" . $value["topic_name"] . "'><br>");
            }
        ?>
        <input type="submit">
    </form>
</body>
</html>