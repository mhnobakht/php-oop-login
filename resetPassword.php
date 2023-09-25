<?php
require 'vendor/autoload.php';
require 'autoload.php';

use Academy01\Csrftoken\CsrfToken;
use Academy01\Semej\Semej;
use Models\Token;
use Models\User;


// check token and email exist
if(!isset($_GET['token']) || !isset($_GET['email'])) {
    
}

$token = $_GET['token'];
$email = $_GET['email'];

// check token and email has value
if($token == '' || $email == '') {
    header('Location: index.php');die;
}

// check token 

$_user = new User();
$user_id = $_user->getIdByEmail($email)['id'];

$_token = new Token();
$lastValidToken = $_token->getToken($user_id, 'password')['token'];

if(is_null($lastValidToken)) {
    header('Location: index.php');die;
}

if($token != $lastValidToken) {
    header('Location: index.php');die;
}

// if token and email are valid
if(isset($_POST['btn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $passwords = $_POST['frm'];

    if($passwords['password'] !== $passwords['confirm_password']) {
        header('Location: index.php');die;
    }

    $_user->updatePassword($email, $token, $passwords);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>verify Email Address.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-reg-panel justify-content-center align-items-center row">
        <fieldset>
            <legend>Update password for: <?php echo htmlspecialchars($email); ?></legend>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?token=$token&email=$email"; ?>" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo CsrfToken::generate(); ?>">
                <div class="form-group">
                    <input type="password" name="frm[password]" id="" class="form-control" placeholder="password">
                </div>
                <div class="form-group">
                    <input type="password" name="frm[confirm_password]" id="" class="form-control" placeholder="confirm password">
                </div>
                <div class="form-group">
                    <input name="btn" type="submit" value="Update Password" class="btn btn-success form-control">
                </div>
            </form>
        </fieldset>
	</div>

    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/script.js"></script>
</body>
</html>