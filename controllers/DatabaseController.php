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
        $con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $con->set_charset('utf8mb4');
        if ($con->connect_error) {
            die("Connection failed, ".$con->error);
        }
        $this->con = $con;
    }

    public function close() {
        $this->con->close();
    }

    protected function checkInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
}

?>