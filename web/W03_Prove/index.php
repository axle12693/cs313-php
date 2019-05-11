<?php session_start(); ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/header1.php'; ?>

    <script src="script.js"></script>
    <title>Alex's House of Mythical Pets</title>
</head>
<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/header2.php'; ?>
  <div id="body_container">
    <div id="items_list_container">
      <div class="item" id="dr" style="background-color: <?php echo($_SESSION["ItemsList"]["dr"] ? "#CCFFCC" : "#FFFFFF");  ?>">
        <p>
          <img class="item_pic_left" src="/images/dragon.jpg">
          <h3>Dragon - $1,000,000</h3>
          This is text describing a dragon. Dragons are really cool!
        </p>
      </div>
      <div class="item" id="ph" style="background-color: <?php echo($_SESSION["ItemsList"]["ph"] ? "#CCFFCC" : "#FFFFFF");  ?>">
        <p>
          <img class="item_pic_left" src="/images/phoenix.jpg">
          <h3>Phoenix - $500,000</h3>
          This is text describing a phoenix. Phoenixes are really cool!
        </p>
      </div>
      <div class="item" id="hy" style="background-color: <?php echo($_SESSION["ItemsList"]["hy"] ? "#CCFFCC" : "#FFFFFF");  ?>">
        <p>
          <img class="item_pic_left" src="/images/hydra.jpg">
          <h3>Hydra - $250,000</h3>
          This is text describing a hydra. Hydras are really cool!
        </p>
      </div>
    </div>
    <button onclick="window.location.replace('cart.php');" value="Go to Cart">Go to Cart</button>
  </div>
</body>
</html>