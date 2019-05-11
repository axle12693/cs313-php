<?php require $_SERVER['DOCUMENT_ROOT'] . '/header1.php'; ?>

    <script src="script.js"></script>
    <title>Alex's House of Mythical Pets</title>
</head>
<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/header2.php'; ?>
  <div id="body_container">
    <div id="items_list_container">
      <div class="item" id="dr">
        <p>
          <img class="item_pic_left" src="/images/dragon.jpg">
          <h3>Dragon - $1,000,000</h3>
          This is text describing a dragon. Dragons are really cool!
        </p>
      </div>
      <div class="item" id="ph">
        <p>
          <img class="item_pic_left" src="/images/phoenix.jpg">
          <h3>Phoenix - $1,000,000</h3>
          This is text describing a phoenix. Phoenixes are really cool!
        </p>
      </div>
      <div class="item" id="hy">
        <p>
          <img class="item_pic_left" src="/images/hydra.jpg">
          <h3>Hydra - $1,000,000</h3>
          This is text describing a hydra. Hydras are really cool!
        </p>
      </div>
    </div>
  </div>
  <button onclick="window.location.replace('cart.php');" value="Go to Cart">
</body>
</html>