<?php session_start() ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/header1.php'; ?>
    <script src="script.js"></script>
    <title>Alex's House of Mythical Pets</title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/header2.php'; ?>
    <div id="body_container">
        <h2>Order Confirmed:</h2><br>
        <table>
            <?php require("cartTable.php"); ?>
        </table>
        <?php
            $street = htmlspecialchars($_POST["street"]);
            $city = htmlspecialchars($_POST["city"]);
            $state = htmlspecialchars($_POST["state"]);
            $zip = htmlspecialchars($_POST["zip"]);
            echo("Your order will be delived to: <br> 
                  $street <br>
                  $city, $state $zip");
        ?>
    </div>
</body>
</html>