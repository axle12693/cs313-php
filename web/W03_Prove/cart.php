<?php session_start(); ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/header1.php'; ?>

    <script src="script.js"></script>
    <title>Alex's House of Mythical Pets</title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/header2.php'; ?>
    <div id="body_container">
        <table id="cartTable">
            <?php
                require("cartTable.php");
            ?>
        </table>    
        <button onclick="window.location.replace('index.php');" value="Back to Browsing">Back to Browsing</button>
        <button onclick="window.location.replace('checkout.php');" value="Continue to Checkout">Continue to Checkout</button>
    </div>
</body>
</html>