<?php
$root = "../";
require_once($root."controllers/TaskController.php");
$controller = new TaskController();
$controller->connect();
$tasks = $controller->getTasks();
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
      <h1>Task List</h1>
    </header>
    <nav id="sidebar">
      <ul>
        <li id="active"><a>Taken</a></li>
        <li><a href="<?=$root?>ranking/">Ranking</a></li>
        <li><a href="<?=$root?>taskcontrol/">Taak toevoegen</a></li>
        <li><a href="<?=$root?>profile/">Profiel</a></li>
      </ul>
    </nav>
    <main>
      <button class="button" id="filterToggleBtn">Show Filters</button>
      <div class="filter">  
          <label for="filterTags">Filter by tags:</label>
          <select id="filterTags">
            <option value="">--------</option>
            <?php
                foreach ($tags as $tag) {
                  $id = $tag->getId();
                  $name = $tag->getName();
                  echo "<option value='$id'>$name</option>";
                }
            ?>          
          </select>
          <label for="sortBy">Sort by:</label>
          <select id="sortBy">
            <option value="dateAsc">Date Asc</option>
            <option value="dateDesc">Date Desc</option>
            <option value="points">Points</option>
          </select>
          <button class="filterBtn" id="filterBtn">Filteren</button>
      </div>
      <div class="selectedTags" id="selectedTags"></div>  
      <hr>
      <?php
      foreach ($tasks as $task) {
        $title = $task->getTitle();
        $desc = $task->getDesc();
        $points = $task->getPoints();
        $dateAdded = $task->getDateAdded();
        $tags = $controller->getTagsByTask($task);
        echo "
        <div class='task'>
            <h1>$title</h1>
            <p class='points'>$points p</p>
            <p class='dateAdded'>$dateAdded</p>
            <p class='tags'>Tags: ";
        
        foreach ($tags as $tag) {
          echo $tag->getName();

          // PHP 7.3 and newer
          // My version of USBWebserver is still on v7.1 --> must upgrade asap
          // TODO: swap in production!!!
          // if (!$tag = array_key_last($tags)) {
          //   echo ", ";
          // }
          // TODO: Delete line below in production
          echo ", ";
        }

        echo "
            </p>
            <p class='description'>$desc</p>
            <button class='button'>Complete</button>
        </div>
        ";
      }
      ?>
    </main>
    <script src="<?=$root?>js/sidebar.js"></script>
    <script src="<?=$root?>js/filter.js"></script>
  </body>
</html>
