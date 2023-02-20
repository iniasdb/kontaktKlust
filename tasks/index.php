<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klusjes</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
  </head>
  <body>
    <header>
      <button id="menu-btn">&#9776;</button>
      <h1>Task List</h1>
    </header>
    <nav id="sidebar">
      <ul>
        <li id="active"><a>Taken</a></li>
        <li><a href="../ranking/">Ranking</a></li>
        <li><a href="../taskcontrol/">Taak toevoegen</a></li>
        <li><a href="../profile/">Profiel</a></li>
      </ul>
    </nav>
    <main>
      <button class="button" id="filterToggleBtn">Show Filters</button>
      <div class="filter">  
          <label for="filter-tags">Filter by tags:</label>
          <select id="filter-tags">
            <option value="Elentriek">Elentriek</option>
            <option value="Loodgieterij">Loodgieterij</option>
          </select>
          <label for="sort-by">Sort by:</label>
          <select id="sort-by">
            <option value="points">Points</option>
            <option value="date">Date</option>
          </select>
          <button class="filterBtn">Filteren</button>
        <div class="selected-tags">
          <span class="tag">Tag 1</span>
          <span class="tag">Tag 2</span>
          <span class="tag">Tag 3</span>
        </div>  
      </div>
      <hr>
      <?php
      
      require_once("../controllers/DatabaseController.php");
      $controller = new DatabaseController();
      $controller->connect();
      $tasks = $controller->getTasks();

      foreach ($tasks as $task) {
        $title = $task->getTitle();
        $desc = $task->getDesc();
        $points = $task->getPoints();
        $dateAdded = $task->getDateAdded();
        echo "
        <div class='task'>
            <h1>$title</h1>
            <p class='points'>$points p</p>
            <p class='tags'>Tags: Elentriek, Loodgieterij</p>
            <p class='description'>$desc</p>
            <button class='button'>Complete</button>
        </div>
        ";
      }
      ?>
    </main>
    <script src="../js/sidebar.js"></script>
    <script src="../js/filter.js"></script>
  </body>
</html>
