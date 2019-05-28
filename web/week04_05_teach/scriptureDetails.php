<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scripture Details</title>
</head>
<body>
    <?php
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
        
                $stmt = $db->prepare('SELECT * FROM scriptures WHERE scripture_id = :id');
                $stmt->bindValue(':id', htmlspecialchars($_GET['id']), PDO::PARAM_STR);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //print_r($rows);
                foreach ($rows as $key => $value)
                {
                    echo '<strong>'.$value['book'].' '.$value['chapter'].':'.$value['verse'].'</strong><br>';
                    echo '<p>'.$value['content'].'</p>';
                }
    ?>
</body>
</html>