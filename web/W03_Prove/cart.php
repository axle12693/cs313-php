<?php session_start(); 
$costs = array("dr" => 1000000, "ph" => 500000, "hy"=>250000);
?>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/header1.php'; ?>

    <script src="script.js"></script>
    <title>Alex's House of Mythical Pets</title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/header2.php'; ?>
    <div id="body_container">
        <table>
            <?php
                $total = 0;
                foreach ($_SESSION["ItemsList"] as $item => $buying)
                {
                    if ($buying)
                    {
                        $total += $costs[$item];
                        echo("<tr>
                                <td>$item</td>
                                <td>$costs[$item]</td>
                              </tr>");
                    }
                }
                echo("<tr>
                        <td>Total:</td>
                        <td>$total</td>
                      </tr>");
            ?>
        </table>    
        <button onclick="window.location.replace('index.php');" value="Back to Browsing">Back to Browsing</button>
    </div>
</body>
</html>