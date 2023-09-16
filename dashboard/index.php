<?php

require_once "../vendor/autoload.php";

use Academy01\AuthToken\AuthToken;

if(!AuthToken::check()) {
    header("Location: ../index.php");die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard panel</title>
</head>
<body>
    <h1>welcome <?php echo $_SESSION['username']; ?></h1>
    <hr>
    <a href="logout.php">
    <button>Logout</button>
    </a>
</body>
</html>