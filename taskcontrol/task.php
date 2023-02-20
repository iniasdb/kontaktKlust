<?php

require_once("../controllers/DatabaseController.php");
require_once("../models/Task.php");

$controller = new DatabaseController();
$controller->connect();
$task1 = new Task($_POST['title'], $_POST['description'], $_POST['points']);
$controller->addTask($task1);
$controller->close();
header("Location: ./");
?>