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
        echo("<div class=\"card-header\"><h4>" . $value["title"] . "</h4></div>");
        $result = pg_prepare($conn, "get_forums", 'SELECT * FROM Forum WHERE forum_category_id = $1');
        $result = pg_execute($conn, "get_forums", array($value["forum_category_id"]));
        $forum_rows = pg_fetch_all($result);
        
        foreach ($forum_rows as $fkey => $fvalue)
        {
            echo("<div class=\"card-body alink\" onclick=window.location.href='forum.php?forum=" . $fvalue["forum_id"] . "'>" . $fvalue["title"] . "</div>");
        }

        echo("</div>");
    }
    echo("</div>");
}

function add_forum_posts($forum_id)
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "get_posts", "
    SELECT      p.post_id, p.title, p.post_content, p.date_last_updated::date, au.username, p.date_last_updated AS dlu
    FROM        Post p INNER JOIN App_User au 
    ON          p.app_user_id = au.app_user_id
    WHERE       p.forum_id = $1
    ORDER BY    dlu DESC
    ");
    $result = pg_execute($conn, "get_posts", array($forum_id));
    $data_array = pg_fetch_all($result);
    echo("<div class=\"container\">");
    $i = 0;
    foreach ($data_array as $key => $value)
    {
        if ($i % 2 == 0)
        {
            echo("<div class=\"card bg-primary text-white\">");
        }
        else
        {
            echo("<div class=\"card bg-info text-white\">");
        }
        $i+=1;
        echo("<div class=\"card-body alink\" onclick=window.location.href=\"post.php?post=" . $value["post_id"] . "\">");
        echo($value["title"] . " - " . $value["username"] . " - " . $value["date_last_updated"]);
        echo("</div></div>");
    }
    echo("</div>");
}

function is_allowed_to_edit_comment($comment_id)
{
    $user_type_id = get_logged_in_user_type_id();
    if (get_comment_creator($comment_id)["app_user_id"] == get_logged_in_user_id())
    {
        return true;
    }
    return false;
}

function is_allowed_to_delete_comment($comment_id)
{
    $user_type_id = get_logged_in_user_type_id();
    if ($user_type_id == 1 || $user_type_id == 2 ||  get_comment_creator($comment_id)["app_user_id"] == get_logged_in_user_id())
    {
        return true;
    }
    return false;
}

function is_allowed_to_edit_post($post_id)
{
    $logged_in_user_id = get_logged_in_user_id();
    $creator_is_logged_in_user = get_post_creator($post_id)["app_user_id"] == $logged_in_user_id;
    echo($logged_in_user_id . " . " . $creator_is_logged_in_user . " . " . get_post_creator($post_id)["app_user_id"]);
    if ($creator_is_logged_in_user && $logged_in_user_id)
    {
        return true;
    }
    return false;
}

function is_allowed_to_delete_post($post_id)
{
    $user_type_id = get_logged_in_user_type_id();
    $logged_in_user_id = get_logged_in_user_id();
    $creator_is_logged_in_user = get_post_creator($post_id)["app_user_id"] == $logged_in_user_id;
    if ($user_type_id == 1 || $user_type_id == 2 ||  ($creator_is_logged_in_user && $logged_in_user_id))
    {
        return true;
    }
    return false;
}

function add_post_and_comments($post_id) 
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "get_post", "
    SELECT      p.post_id, p.title, p.post_content, p.date_last_updated::date, au.username, p.deleted
    FROM        Post p INNER JOIN App_User au 
    ON          p.app_user_id = au.app_user_id
    WHERE       p.post_id = $1
    ");
    $result = pg_execute($conn, "get_post", array($post_id));
    $post_array = pg_fetch_all($result);
    $post = $post_array[0];

    if ($post["deleted"])
    {
        header("Location: index.php");
        die();
    }

    $result = pg_prepare($conn, "get_comments", "
    SELECT      pc.post_comment_id, pc.post_comment_content, pc.app_user_id, pc.date_last_updated::date, au.username, pc.date_last_updated AS dlu
    FROM        Post p INNER JOIN Post_Comment pc
    ON          p.post_id = pc.post_id INNER JOIN App_User au
    ON          pc.app_user_id = au.app_user_id
    WHERE       pc.post_id = $1
    ORDER BY    dlu
    ");
    $result = pg_execute($conn, "get_comments", array($post_id));
    $comment_array = pg_fetch_all($result);



    echo("<div class=\"container\">");
    echo("<div class=\"card bg-success text-white\">");
    echo("<div class=\"card-header\">");
    echo("<h4>" . $post["title"]);
    if (is_allowed_to_edit_post($post_id))
    {
        echo(" - <button onclick=\"window.location.href = 'editPost.php?post_id=" . $post_id . "';\">Edit</button>");
    }
    if (is_allowed_to_delete_post($post_id))
    {
        echo(" - <button onclick=\"window.location.href = 'deletePost.php?post_id=" . $post_id . "';\">Delete</button>");
    }
    echo("</h4><hr>" . $post["post_content"] . "<br><br><hr>" . $post["username"] . " - " . $post["date_last_updated"]);
    echo("</div>");
    echo("</div>");
    foreach ($comment_array as $key => $value)
    {
        echo("<div class=\"card bg-primary text-white\">");
        echo("<div class=\"card-body\">");
        echo($value["post_comment_content"] . "<br><br><hr>");
        echo($value["username"] . " - " . $value["date_last_updated"]);

        if (is_logged_in())
        {
            if (is_allowed_to_edit_comment($value["post_comment_id"]))
            {
                echo(" - <button onclick=\"window.location.href = 'editComment.php?comment_id=" . $comment_id . "';\">Edit</button>");
            }
            if (is_allowed_to_delete_comment($value["post_comment_id"]))
            {
                echo(" - <button onclick=\"window.location.href = 'deleteComment.php?comment_id=" . $comment_id . "';\">Delete</button>");
            }
        }
        echo("</div>");
        echo("</div>");
    }
    echo("</div>");


}

$current_category = null;
$current_forum = null;

function setup_current_forum_nav($forum_id)
{
    global $current_category, $current_forum;
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "get_current", "
    SELECT      f.title, fc.forum_category_id, fc.title AS cat_title
    FROM        Forum f INNER JOIN Forum_Category fc
    ON          f.forum_category_id = fc.forum_category_id
    WHERE       f.forum_id = $1
    ");
    $result = pg_execute($conn, "get_current", array($forum_id));
    $data = pg_fetch_all($result)[0];
    //print_r($data);
    $current_category["id"] = $data["forum_category_id"];
    $current_category["title"] = $data["cat_title"];
    $current_forum["id"] = $forum_id;
    $current_forum["title"] = $data["title"];
    //echo("<br>TEST: " . $current_category["title"] . " " . $current_forum["title"]);
}

function get_forum_from_post($post_id)
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "get_forum_from_post", "
    SELECT      f.forum_id
    FROM        Forum f INNER JOIN Post p
    ON          f.forum_id = p.forum_id
    WHERE       p.post_id = $1
    ");
    $result = pg_execute($conn, "get_forum_from_post", array($post_id));
    $data = pg_fetch_all($result);
    return $data[0]["forum_id"];
}

function is_logged_in() {return isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"];}

function get_logged_in_username() {return $_SESSION["logged_in_username"];}

function get_logged_in_user_id() {return $_SESSION["logged_in_user_id"];}

function get_logged_in_user_type() {return $_SESSION["logged_in_user_type"];}

function get_logged_in_user_type_id() {return $_SESSION["logged_in_user_type_id"];}

function verify_password($uname, $pword)
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "try_login", "
    SELECT      au.pw_hash, au.app_user_id, au.username, au.user_type_id, aut.user_type_title
    FROM        App_User au INNER JOIN App_User_Type aut
    ON          au.user_type_id = aut.user_type_id
    WHERE       au.username = $1
    ");
    $result = pg_execute($conn, "try_login", array($uname));
    $data = pg_fetch_all($result);
    
    if (empty($data))
    {
        return false;
    }
    elseif (!password_verify($pword, $data[0]["pw_hash"]))
    {
        // echo(strlen(data[0]["pw_hash"]));
        // echo(data[0]["pw_hash"]);
        return false;
    }
    else
    {
        $data = $data[0];
        return $data;
    }
}

function try_login($uname, $pword)
{
    // $conn = pg_connect(getenv("DATABASE_URL"));
    // $result = pg_prepare($conn, "try_login", "
    // SELECT      au.pw_hash, au.app_user_id, au.username
    // FROM        App_User au
    // WHERE       au.username = $1
    // ");
    // $result = pg_execute($conn, "try_login", array($uname));
    // $data = pg_fetch_all($result);
    // if (empty($data))
    // {
    //     return false;
    // }
    // elseif (!password_verify($pword, $data[0]["pw_hash"]))
    // {
    //     // echo(strlen(data[0]["pw_hash"]));
    //     // echo(data[0]["pw_hash"]);
    //     return false;
    // }
    // else
    $data = verify_password($uname, $pword);
    if ($data)
    {
        $_SESSION["logged_in_username"] = $data["username"];
        $_SESSION["is_logged_in"] = true;
        $_SESSION["logged_in_user_id"] = $data["app_user_id"];
        $_SESSION["logged_in_user_type"] = $data["user_type_title"];
        $_SESSION["logged_in_user_type_id"] = $data["user_type_id"];

        return true;
    }
    return false;
}

function username_is_taken($uname)
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "username_already_exists", "
    SELECT      *
    FROM        App_User
    WHERE       username = $1
    ");
    $result = pg_execute($conn, "username_already_exists", array($uname));
    $data = pg_fetch_all($result);
    if (empty($data))
    {
        return false;
    }
    return true;
}

function add_user($uname, $pass)
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $pw_hash = password_hash($pw, PASSWORD_BCRYPT);
    $result = pg_prepare($conn, "add_user", "
    INSERT INTO App_User
    (user_type_id, username, pw_hash)
    VALUES
    (3, $1, $2)
    ");
    $result = pg_execute($conn, "add_user", array($uname, $pw_hash));
    $data = pg_fetch_all($result);
}

function get_comment_creator($comment_id)
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "get_comment_creator", "
    SELECT  au.app_user_id, au.username
    FROM    App_User au INNER JOIN Post_Comment pc
    ON      au.app_user_id = pc.app_user_id
    WHERE   pc.post_comment_id = $1
    ");
    $result = pg_execute($conn, "get_comment_creator", array($comment_id));
    $data = pg_fetch_all($result)[0];
    return $data;
}

function get_post_creator($post_id)
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "get_post_creator", "
    SELECT  au.app_user_id, au.username
    FROM    App_User au INNER JOIN Post p
    ON      au.app_user_id = p.app_user_id
    WHERE   p.post_id = $1
    ");
    $result = pg_execute($conn, "get_post_creator", array($post_id));
    $data = pg_fetch_all($result)[0];
    return $data;
}

function delete_post($post_id) 
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "delete_post", "
    UPDATE Post
    SET deleted = TRUE
    WHERE post_id = $1
    ");
    $result = pg_execute($conn, "delete_post", array($post_id));
}

function edit_post($post_id, $title, $text) 
{
    $conn = pg_connect(getenv("DATABASE_URL"));
    $result = pg_prepare($conn, "edit_post", "
    UPDATE  Post
    SET     title = $2,
            post_content = $3,
            date_last_updated = current_timestamp
    WHERE   post_id = $1
    ");
    $result = pg_execute($conn, "edit_post", array($post_id. $title, $text));
}

?>



