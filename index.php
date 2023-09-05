<?php
require "vendor/autoload.php";
require "autoload.php";

use Academy01\Csrftoken\CsrfToken;
use Academy01\Semej\Semej;
use Models\AuthUser;

// REGISTER FORM

if(isset($_POST['register_btn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
	$csrf_token = $_POST['csrf_token'];
	$data = $_POST['frm'];

	$authUser = new AuthUser();
	$authUser->register($csrf_token, $data);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>animated sinin and signup panel. animated login and registeration page, popup,  - Bootsnipp.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="login-reg-panel">
		<div class="login-info-box">
			<h2>Have an account?</h2>
			<p>Lorem ipsum dolor sit amet</p>
			<label id="label-register" for="log-reg-show">Login</label>
			<input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
		</div>
							
		<div class="register-info-box">
			<h2>Don't have an account?</h2>
			<p>Lorem ipsum dolor sit amet</p>
			<label id="label-login" for="log-login-show">Register</label>
			<input type="radio" name="active-log-panel" id="log-login-show">
		</div>
							
		<div class="white-panel">
			<div class="login-show">
				<h2>LOGIN</h2>
				<input type="text" placeholder="Email">
				<input type="password" placeholder="Password">
				<input type="button" value="Login">
				<a href="">Forgot password?</a>
			</div>
			<div class="register-show">
				<h2>REGISTER</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="register" method="post">
					<input type="hidden" name="csrf_token" value="<?php echo CsrfToken::generate(); ?>">
				<input name="frm[email]" type="text" placeholder="Email">
				<input name="frm[password]" type="password" placeholder="Password">
				<input name="frm[confirm_password]" type="password" placeholder="Confirm Password">
				<input name="register_btn" type="submit" value="Register">
				</form>
			</div>
		</div>
	</div>

    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/script.js"></script>

	<?php Semej::alert(); ?>
</body>
</html>
