<?php
require_once($root."controllers/DatabaseController.php");

class TaskController extends DatabaseController {
    
    public function addTask($task) {
        $title = $this->checkInput($task->getTitle());
        $desc = $this->checkInput($task->getDesc());
        $points = $this->checkInput($task->getPoints());

        $stmt = $this->con->prepare("INSERT INTO `tasks`(`title`, `description`, `points`) VALUES (:title, :description, :points)");
        $stmt->bindParam(":title", $title); 
        $stmt->bindParam(":description", $desc);
        $stmt->bindParam(":points", $points);
        $stmt->execute();
    }

    public function getTasks() {
        $tasks = array();

        $stmt = $this->con->query("SELECT * FROM tasks");
        while ($qresult = $stmt->fetch()) {
            $task = new Task($qresult['title'], $qresult['description'], $qresult['points']);
            $task->setId($qresult['id']);
            $task->setDateAdded($qresult['dateAdded']);
            $tasks[] = $task;
        }
        return $tasks;
    }

    public function getTaskId($task) {
        $id = null;
        $title = $this->checkInput($task->getTitle());
        $desc = $this->checkInput($task->getDesc());
        $points = $this->checkInput($task->getPoints());

        $stmt = $this->con->prepare("SELECT id FROM tasks WHERE title = :title AND description = :description AND points = :points");
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $desc);
        $stmt->bindParam(":points", $points);
        $stmt->execute();

        while ($qresult = $stmt->fetch()) {
            $id = $qresult['id'];
        }

        return $id;
    }

    public function getTags() {
        $tags = array();

        $stmt = $this->con->query("SELECT id, name FROM tags");
        while ($qresult = $stmt->fetch()) {
            $tag = new Tag($qresult['id'], $qresult['name']);
            $tags[] = $tag;
        }

        return $tags;
    }

    public function getTagsByTask($task) {
        $tagIds = array();
        $tags = array();

        $taskId = $this->checkInput($task->getId());

        $stmt = $this->con->prepare("SELECT tagId FROM taglink WHERE taskId = :taskId");
        $stmt->bindParam("taskId", $taskId);
        $stmt->execute();

        while ($qresult = $stmt->fetch()) {
            $tagIds[] = $qresult['tagId'];
        }

        foreach ($tagIds as $id) {
            $stmt = $this->con->prepare("SELECT name FROM tags WHERE id = :tagId");
            $stmt->bindParam(":tagId", $id);
            $stmt->execute();

            while ($qresult = $stmt->fetch()) {
                $name = $qresult['name'];
                $tag = new Tag($id, $name);
                $tags[] = $tag;
            }
        }
        
        return $tags;
    }

    public function addTaskTag($task, $tag) {
        $taskId = $this->checkInput($task->getId());
        $tagId = $this->checkInput($tag->getId());

        $stmt = $this->con->prepare("INSERT INTO `taglink`(`taskId`, `tagId`) VALUES (:taskId, :tagId)");
        $stmt->bindParam("taskId", $taskId);
        $stmt->bindParam("tagId", $tagId);
        $stmt->execute();
    }
}

?>