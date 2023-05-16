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
    
    $search = str_replace(' ', '+', $query); // ersetzt Leerzeichen durch % für die API
    
    echo " <link rel='stylesheet' href='style.css'>
             <div id='searchInput'>
             Suche für " . $query . "
            </div>
            <br>
            ";                              // anzeige des Suchbegriffs


        // apikey
        $api_key = "91d40bff";

        // url bauen
        $url = "https://www.omdbapi.com/?apikey=" . $api_key . "&s=" . (string)$search;

        // ergebniss ziehen
        $response = file_get_contents($url);

        // in ne json decodieren 
        $data = json_decode($response, true);

        // auf ergebnisseprüfen
        if (isset($data['Search'][0])) {
            $first_result = $data['Search'][0];
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
		<?php foreach ($data['Search'] as $movie): ?>
			<li class="movie-item">
				<img class="movie-poster" src=<?php echo $movie['Poster']; ?>>
				
                <div class="movie-details">
					
                    <h2 class="movie-title"> 
                        <a href="details.php?id=<?php echo $movie['imdbID']; ?>" id="movie-title-link">
                        <?php echo $movie['Title']; ?>
                        </a>
                    </h2>

					<p class="movie-overview">
                        <?php echo $movie['Year'];?> • 
                        
                        <?php 
                        if($movie['Type'] == 'movie') {
                            echo 'Film';
                        } elseif ($movie['Type'] == 'series') {
                            echo 'Serie';
                        }
                        ?> • imdb-Bewertung 

                        <?php 
                        $movieData = json_decode(file_get_contents("https://www.omdbapi.com/?apikey=" . $api_key . "&i=" . $movie['imdbID']), true);
                        echo $movieData['imdbRating']

                        ?>

                    </p>

				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</body>
</html>

</body>
</html>