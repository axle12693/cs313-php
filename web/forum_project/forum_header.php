<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Mythical Pet Store Forums</a>
    </li>
    <?php 
    if (isset($current_category))
    {
        echo("<li class=\"nav-item\"> &gt;&gt; <a class=\"nav-link\" href=\"index.php\">" . $current_category["title"] . "</a></li>");
        if (isset($current_forum))
        {
            echo("<li class=\"nav-item\"> &gt;&gt; <a class=\"nav-link\" href=\"forum.php?forum=" . $current_forum["id"] . "\">" . $current_forum["title"] . "</a></li>");
        }
    }

    ?>
  </ul>
</nav>