<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <?php if (!is_logged_in()) { ?>
  <form class="form-inline my-2 my-lg-0" action="login.php" method="post">
    <input class="form-control mr-sm-2" type="text" placeholder="Username">
    <input class="form-control mr-sm-2" type="password" placeholder="Password">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login/Sign up</button>
  </form>
  <?php } else { echo("Hello " . get_logged_in_username());} ?>
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
        }
    }

    ?>
  </ul>
</nav>