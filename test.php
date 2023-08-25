<?php

require_once 'autoload.php';

use Models\Database;

class User extends Database {

    use Models\SanitizerTrait;

    public function get($id) {
        $sql = "SELECT * FROM users WHERE id= ?";
        $stmt = $this->executeStatement($sql, $id);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function test($input) {

        return self::sanitizeInput($input);

    }

}


$userTable = new User();

