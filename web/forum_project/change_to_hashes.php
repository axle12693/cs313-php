<?php
$conn = pg_connect(getenv("DATABASE_URL"));
$result = pg_prepare($conn, "change_to_hashes1", "
SELECT      app_user_id, pw, pw_hash
FROM        App_User
WHERE       pw_hash IS NULL
");
$result = pg_execute($conn, "change_to_hashes1", array());
$pw_array = pg_fetch_all($result);
foreach ($pw_array as $key => $value)
{
    $pw = $value["pw"];
    $pw_hash = password_hash($pw, PASSWORD_DEFAULT);
    $result = pg_prepare($conn, "change_to_hashes2", "
    UPDATE  App_User
    SET     pw_hash = $1
    WHERE   app_user_id = $2
    ");
    $result = pg_execute($conn, "change_to_hashes2", array($pw_hash, $value["app_user_id"]));

    $result = pg_prepare($conn, "change_to_hashes3", "
    UPDATE  App_User
    SET     pw = NULL
    WHERE   app_user_id = $1
    ");
    $result = pg_execute($conn, "change_to_hashes3", array($value["app_user_id"]));
}

$result = pg_prepare($conn, "change_to_hashes4", "
ALTER TABLE App_User
DROP COLUMN pw
");
$result = pg_execute($conn, "change_to_hashes4", array());
?>