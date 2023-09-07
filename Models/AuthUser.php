<?php

namespace Models;

use Academy01\Semej\Semej;

class AuthUser extends Database {

    use SanitizerTrait;

    // register user
    public function register($csrf_token, $formData) {

        // sanitize data
        $csrf_token = $this->sanitizeInput($csrf_token);
        $formData   = $this->sanitizeInput($formData);

        
        // check email exists
        $check_email = $this->checkEmail($formData['email']);

        if($check_email) {
            Semej::set('error', 'Email', 'Email already exists.');
            header("Location: index.php");die;
        }

        // check and confirm password
        if($formData['password'] != $formData['confirm_password']) {
            Semej::set('error', 'confirm password', 'passwords are not match');
            header("Location: index.php");die;
        }

        // hash password
        $hashed_password = password_hash($formData['password'], PASSWORD_DEFAULT);

        // extract username from email address
        $emailArray = explode('@', $formData['email']);
        $name = $emailArray[0];

        // insert user to database(users)

        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $params = [
            $name,
            $formData['email'],
            $hashed_password
        ];

        $stmt = $this->executeStatement($sql, $params);

        if($stmt->affected_rows === 1) {
            $lastInsertId = $stmt->insert_id;
            $_token = new Token();

            $token = $_token->saveToken($lastInsertId, 'email');

            $this->sendActivationLinks($formData['email'], $lastInsertId);
        }else{
            Semej::set('error', 'user register failed', 'User Register failed.');
            header("Location: index.php");die;
        }
        
    }

    // check user email exists
    public function checkEmail($email) {

        // echo $email;

        $sql = "SELECT email FROM users WHERE email = ?";
        $params = [$email];

        $stmt = $this->executeStatement($sql, $params);

        $result = $stmt->get_result();
        
        $result = $result->fetch_assoc();

        if(is_null($result)) {
            return false;
        }else{
            return true;
        }

    }

    // send activation link to new registered user
    public function sendActivationLinks($email, $user_id) {
        
        $_token = new Token();

        $token = $_token->getToken($user_id, 'email');

        $subject = "Activation link";

        $message = "http://localhost/php-oop-login/verifyEmail.php?token=".$token['token'];

        $mail = new Mail();
        $result = $mail->send($email, $subject, $message);

        var_dump($result);die;
    }

}