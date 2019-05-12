<?php require $_SERVER['DOCUMENT_ROOT'] . '/header1.php'; ?>

    <script src="script.js"></script>
    <title>Alex's House of Mythical Pets</title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/header2.php'; ?>
    <div id="body_container">
        <form action="confirm.php" method="post">
            Street Address: <input type="text" name="street"><br>
            City: <input type="text" name="city">
            State: <input type="text" name="state">
            ZIP: <input type="text" name="zip"><br>
            <input type="submit" value="Checkout">
        </form>
        <button onclick="window.location.replace('cart.php');" value="Back to Cart">Back to Cart</button>
    </div>
</body>
</html>