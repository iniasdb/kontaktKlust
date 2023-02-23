<?php
require_once("../models/Task.php");
require_once("../models/Tag.php");

class DatabaseController {
    private $servername = "localhost";
    private $username = "root";
    private $password = "usbw";
    private $dbname = "klusjes";
    public $con;

    public function connect() {
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $con = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=utf8mb4", $this->username, $this->password, $options);
        $this->con = $con;
    }

    public function close() {
        $this->con = null;
    }

    protected function checkInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
}

?>