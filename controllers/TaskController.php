<?php
require_once($root."controllers/DatabaseController.php");

class TaskController extends DatabaseController {
    
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
                $task->setId($endresult['id']);
                $task->setDateAdded($endresult['dateAdded']);
                $tasks[] = $task;
            }
        }
        return $tasks;
    }

    public function getTaskId($task) {
        $id = null;
        $title = $this->checkInput($task->getTitle());
        $desc = $this->checkInput($task->getDesc());
        $points = $this->checkInput($task->getPoints());

        $stmt = $this->con->prepare("SELECT id FROM tasks WHERE title = ? AND description = ? AND points = ?");
        $stmt->bind_param("ssi", $title, $desc, $points);
        $stmt->execute();

        $qresult = $stmt->get_result();
        if ($qresult->num_rows > 0) {
            $id = $qresult->fetch_array()[0];
        }

        $stmt->close();
        return $id;
    }

    public function getTags() {
        $tags = array();

        $qresult = $this->con->query("SELECT * FROM tags");
        if ($qresult->num_rows > 0) {
            while ($endresult = $qresult->fetch_assoc()) {
                $tag = new Tag($endresult['id'], $endresult['name']);
                $tags[] = $tag;
            }
        }
        return $tags;
    }

    public function getTagsByTask($task) {
        $tagIds = array();
        $tags = array();

        $taskId = $this->checkInput($task->getId());

        $stmt = $this->con->prepare("SELECT tagId FROM taglink WHERE taskId = ?");
        $stmt->bind_param("i", $taskId);
        $stmt->execute();

        $qresult = $stmt->get_result();
        if ($qresult->num_rows > 0) {
            while ($endresult = $qresult->fetch_array()) {
                $tagIds[] = $endresult[0];
            }
        }

        foreach ($tagIds as $id) {
            $stmt = $this->con->prepare("SELECT name FROM tags WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $qresult = $stmt->get_result();
            if ($qresult->num_rows > 0) {
                $name = $qresult->fetch_array()[0];
                $tag = new Tag($id, $name);
                $tags[] = $tag;
            }
        }
        
        return $tags;
    }

    public function addTaskTag($task, $tag) {
        $taskId = $this->checkInput($task->getId());
        $tagId = $this->checkInput($tag->getId());

        $stmt = $this->con->prepare("INSERT INTO `taglink`(`taskId`, `tagId`) VALUES (?,?)");
        $stmt->bind_param("ii", $taskId, $tagId);
        $stmt->execute();
        $stmt->close();
    }
}

?>