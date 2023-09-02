<?php

require_once 'autoload.php';

use Models\Token;

$user_id = 1;
$type = 'email';
$userToken = "e40a474b717e09367d72da5a77a5f5574bcf50f6b1de1ca7501320bd83c28a1b";


$obj = new Token();

$token = $obj->compareToken($user_id, $type, $userToken);

var_dump($token);
