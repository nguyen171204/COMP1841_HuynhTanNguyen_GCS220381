<?php setcookie("user", "matt12", time() - 3600);?>
<html>
<head>
<title>Setting and Reading Cookies</title>
<body>
    <?php
    if (isset($_COOKIE["user"])) {
        echo "Welcome ".$_COOKIE["user"]."!<br />";
    } else {
        echo "Welcome guess!<br />";
    }
    ?>
</body>
</head>
</html>