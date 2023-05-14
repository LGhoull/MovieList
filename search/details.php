<!DOCTYPE html>
<html>
    <head>
	    <link rel="stylesheet" href="style.css">
        <title>MovieList.de</title>
    </head>

    <body>
        <div id="header">
        <a href="home.php" id="logo">MovieList.de</a>
            <button onclick="window.location.href='home.php';">Home</button>
            <button onclick="window.location.href='liste.php';">Meine Liste</button>
            <button onclick="window.location.href='logout.php';">Abmelden</button>
        </div>
    <br> <br>


    <?php
      $json = file_get_contents('pfad/zur/deine-daten.json');
      $data = json_decode($json, true);
    ?>
    
    <h1>Film-Suchergebnisse</h1>
    
    <ul class="movie-list">
      <?php foreach ($data['results'] as $movie): ?>
        <li class="movie-item">
          <img class="movie-poster" src="<?php echo $movie['poster_path']; ?>" alt="<?php echo $movie['title']; ?>">
          <div class="movie-details">
            <h2 class="movie-title"><?php echo $movie['title']; ?></h2>
            <p class="movie-overview"><?php echo $movie['overview']; ?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </body>
</html>
