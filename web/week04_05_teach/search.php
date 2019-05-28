<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>
</head>
<body>
    <form action="search.php" method="get">
        <input type="text" name="book" id="" placeholder="Book"><br>
        <input type="submit" value="Submit">
    </form>
    <br>
    <?php
        if (isset($_GET['book'])){
            try
            {
              $dbUrl = getenv('DATABASE_URL');
            
              $dbOpts = parse_url($dbUrl);
            
              $dbHost = $dbOpts["host"];
              $dbPort = $dbOpts["port"];
              $dbUser = $dbOpts["user"];
              $dbPassword = $dbOpts["pass"];
              $dbName = ltrim($dbOpts["path"],'/');
            
              $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
            
              $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $ex)
            {
              echo 'Error!: ' . $ex->getMessage();
              die();
            }

        $stmt = $db->prepare('SELECT * FROM scriptures WHERE book = :name');
        $stmt->bindValue(':name', htmlspecialchars($_GET['book']), PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '<p>Your requested data:</p>';
        //print_r($rows);
        foreach ($rows as $key => $value)
        {
            echo '<a href="scriptureDetails.php?id='.$value['scripture_id'].'"><strong>'.$value['book'].' '.$value['chapter'].':'.$value['verse'].'</strong></a><br>';
         //echo 'user: ' . $row['username'] . ' password: ' . $row['password'] . '<br/>';
        }
        }
    ?>
</body>
</html>