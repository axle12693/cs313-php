<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <?php if (!is_logged_in()) { ?>
  <form class="form-inline my-2 my-lg-0" action="login.php" method="post">
    <input class="form-control mr-sm-2" type="text" placeholder="Username" name="uname">
    <input class="form-control mr-sm-2" type="password" placeholder="Password" name="pword">
    <input type="hidden" value="<?php if (isset($_POST['redirect_url'])){echo(htmlspecialchars($_POST['redirect_url']));} else {echo($_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']);} ?>" name="redirect_url">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="sub">Login/Sign up</button>
  </form>
  <?php 
    } 
    else 
    { 
      echo("Hello " . get_logged_in_username() . "&nbsp;&nbsp;");
      ?>
        <form class="form-inline my-2 my-lg-0" action="login.php" method="post">
          <input type="hidden" value="<?php if (isset($_POST['redirect_url'])){echo(htmlspecialchars($_POST['redirect_url']));} else {echo($_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']);} ?>" name="redirect_url">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout">Log out</button>
        </form>
        <a class="nav-link" href="change_password.php">Change password</a>
      <?php
    } 
    ?>
</nav>
<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Mythical Pet Store Forums</a>
    </li>
    <?php 
    if (isset($current_category))
    {
        echo("<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php\"> &gt;&gt; " . $current_category["title"] . "</a></li>");
        if (isset($current_forum))
        {
            echo("<li class=\"nav-item\"><a class=\"nav-link\" href=\"forum.php?forum=" . $current_forum["id"] . "\"> &gt;&gt; " . $current_forum["title"] . "</a></li>");
            if (is_logged_in())
            {
              ?>
              <form class="form-inline my-2 my-lg-0" action="create_post.php" method="get">
                <input type="hidden" name="forum" value="<?php echo($current_forum["id"]); ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Create Post</button>
              </form>
              <?php
            }
        }
    }

    ?>
  </ul>
</nav>