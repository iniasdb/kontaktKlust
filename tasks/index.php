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
          <label for="filterTags">Filter by tags:</label>
          <select id="filterTags">
            <option value="">--------</option>
            <option value="Elentriek">Elentriek</option>
            <option value="Loodgieterij">Loodgieterij</option>
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
            <p class='dateAdded'>$dateAdded</p>
            <p class='tags'>Tags: Loodgieterij</p>
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
