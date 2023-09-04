<?php

require_once 'autoload.php';

use Models\Mail;

$to = "academy01test@mailna.co";
$subject = "test subject";
$message = "click this link to verify your email address";

$result = Mail::send($to, $subject, $message);

var_dump($result);