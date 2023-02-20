<?php
require_once("../models/Task.php");

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

    public function addTask($task) {
        $title = $this->checkInput($task->getTitle());
        $desc = $this->checkInput($task->getDesc());
        $points = $this->checkInput($task->getPoints());
        $stmt = $this->con->prepare("INSERT INTO `tasks`(`title`, `description`, `points`) VALUES (?,?,?)");
        $stmt->bind_param("ssi", $title, $desc, $points);
        $stmt->execute();
        $stmt->close();
    }

    public function getTasks() {
        $tasks = array();

        $qresult = $this->con->query("SELECT * FROM tasks");
        if ($qresult->num_rows > 0) {
            while ($endresult = $qresult->fetch_assoc()) {
                $task = new Task($endresult['title'], $endresult['description'], $endresult['points']);
                $task->setDateAdded($endresult['dateAdded']);
                $tasks[] = $task;
            }
        }
        return $tasks;
    }

    private function checkInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
}

?>