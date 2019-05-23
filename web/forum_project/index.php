<?php
require($_SERVER['DOCUMENT_ROOT'] . '/header1.php');
require("forum_functions.php");
?>

<title>Alex's House of Mythical Pets</title>
</head>
<body>
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/header2.php'); 
          require("forum_header.php")?>
    <div id="body_container">
        <?php add_forum_categories() ?>
    </div>
</body>
</html>