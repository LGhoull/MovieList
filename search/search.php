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


    if (isset($_GET['query'])) {    //Holt den Parameter query aus der URL
    $query = $_GET['query'];
    }
    
    $search = str_replace(' ', '%', $query); // ersetzt Leerzeichen durch % für die API
    
    echo " <link rel='stylesheet' href='style.css'>
             <div id='searchInput'>
             Suche für " . $query . "
            </div>
            ";                              // anzeige des Suchbegriffs ||LÄUFT NOCH NICHT


        // apikey
        $api_key = "d9640bd65cc9d9c16cb5ca486e476d37";

        // url bauen
        $url = "https://api.themoviedb.org/3/search/movie?api_key=" . $api_key . "&query=" . (string)$search;

        // ergebniss ziehen
        $response = file_get_contents($url);

        // in ne json decodieren 
        $data = json_decode($response, true);

        // auf ergebnisseprüfen
        if (isset($data['results'][0])) {
            $first_result = $data['results'][0];
            json_encode($first_result);
          } else {
            echo "<ul class='movie-list'> 
                 <li class='movie-item'>
                 <div class='movie-details'>
                 <h2 class='movie-title'>Keine Ergebnisse gefunden</h2>
                 </div>
                 </li>
            ";
          }

    ?>
	</div>
    <link rel="stylesheet" href="style.css">
        <head>
        <link rel="stylesheet" href="style.css">
        </head>
	<ul class="movie-list">
		<?php foreach ($data['results'] as $movie): ?>
			<li class="movie-item">
				<img class="movie-poster" src=https://image.tmdb.org/t/p/original/<?php echo $movie['poster_path']; ?>>
				<div class="movie-details">
					<h2 class="movie-title"><?php echo $movie['title']; ?></h2>
					<p class="movie-overview"><?php echo $movie['overview']; ?></p>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</body>
</html>

</body>
</html>