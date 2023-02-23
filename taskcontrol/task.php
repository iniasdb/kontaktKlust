<?php
$root = "../";
require_once($root."controllers/TaskController.php");
require_once($root."models/Task.php");
require_once($root."models/Tag.php");

$controller = new TaskController();
$controller->connect();
$task = new Task($_POST['title'], $_POST['description'], $_POST['points']);
$controller->addTask($task);

$taskId = $controller->getTaskId($task);
$task->setId($taskId);

$tags = explode(",", $_POST['tags']);
foreach ($tags as $t) {
    $tag = new Tag($t, $taskId);
    echo $tag->getId();
    $controller->addTaskTag($task, $tag);
}

$controller->close();
header("Location: ./");
?>