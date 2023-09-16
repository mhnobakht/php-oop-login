<?php

require_once "../vendor/autoload.php";

use Academy01\AuthToken\AuthToken;

AuthToken::delete();

header("Location: ../index.php");die;