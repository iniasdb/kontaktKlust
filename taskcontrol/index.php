<?php
$root = "../";
require_once($root."controllers/TaskController.php");
$controller = new TaskController();
$controller->connect();
$tags = $controller->getTags();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klusjes</title>
    <link rel="stylesheet" type="text/css" href="<?=$root?>styles/style.css">
  </head>
  <body>
    <header>
      <button id="menu-btn">&#9776;</button>
      <h1>Add task</h1>
    </header>
    <nav id="sidebar">
      <ul>
        <li><a href="<?=$root?>tasks/">Taken</a></li>
        <li><a href="<?=$root?>ranking/">Ranking</a></li>
        <li id="active"><a>Taak toevoegen</a></li>
        <li><a href="<?=$root?>profile/">Profiel</a></li>
      </ul>
    </nav>
    <main>
        <form class="task-form" action="task.php" method="post">
              <label for="title">Title:</label>
              <input type="text" id="title" name="title" placeholder="Enter task title" required>
              <label for="filterTags">Tags:</label>
              <select name="tagselect" id="filterTags">
                <option value="">--------</option>
                <?php
                foreach ($tags as $tag) {
                  $id = $tag->getId();
                  $name = $tag->getName();
                  echo "<option value='$id'>$name</option>";
                }
                ?>
              </select>
              <div class="selectedTags" id="selectedTags"></div>  
              <input type="hidden" name="tags" id="tagInput">
              <label for="points">Points:</label>
              <input type="number" id="points" name="points" min="1" required>
              <label for="description">Description:</label>
              <textarea id="description" name="description" placeholder="Enter task description" required></textarea>
            <button type="submit">Submit</button>
        </form>                  
    </main>
    <script src="<?=$root?>js/sidebar.js"></script>
    <script src="<?=$root?>js/addtasks.js"></script>
  </body>
</html>
