<?php session_start() ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/header1.php'; ?>
    <script src="script.js"></script>
    <title>Alex's House of Mythical Pets</title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/header2.php'; ?>
    <div id="body_container">
        <h2>Order Confirmed:</h2><br>
        <?php require("cartTable"); ?>
        <?php
            $street = htmlspecialchars($_SESSION["street"]);
            $city = htmlspecialchars($_SESSION["city"]);
            $state = htmlspecialchars($_SESSION["state"]);
            $zip = htmlspecialchars($_SESSION["zip"]);
            echo("Your order will be delived to: <br> 
                  $street
                  $city, $state $zip")
        ?>
    </div>
</body>
</html>