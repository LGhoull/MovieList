<!DOCTYPE html>
<html>

    <?php                                               // Siehe home.php
        require '../reglog/config.php';
        session_start();
        if(!isset($_SESSION['id'])) {
            header("Location: ../reglog/login");
            die();
        }
    ?>

    <head>                                          <!--siehe home.php-->
	    <link rel="stylesheet" href="style.css">
        <title>MovieList.de</title>
    </head>
    
    <body>                                          <!--siehe home.php-->
        <div id="header">
        <a href="home" id="logo">MovieList.de</a>
            <button class="button" onclick="window.location.href='home';">Home</button>
            <button class="button" onclick="window.location.href='liste';">Meine Liste</button>
            <button class="button" onclick="window.location.href='../reglog/logout';">Abmelden</button>
        </div>
    <br> <br>
	
    
    <?php


    if (isset($_GET['query'])) {    // Parameter "query" aus der URL holen (GET Methode)
     $query = $_GET['query'];
    }

    $page;                          // Aktuelle Seite aufrufen, falls keine vorhanden auf 1 setzen
    if(isset($_GET['page'])) {
    $page = $_GET['page'];
    } else {
        $page=1;
    }
    
    $search = str_replace(' ', '+', $query); // Ersetzt Leerzeichen durch + für die OmdbAPI

        // Apikey der OmdbAPI
        $api_key = "91d40bff";

        // URL bauen
        $url = "https://www.omdbapi.com/?apikey=" . $api_key . "&s=" . (string)$search . "&page=" . $page;

        // Ergebnis abrufen
        $response = file_get_contents($url);

        // JSON in eine PHP-Value decodieren
        $data = json_decode($response, true);

        // Prüfen, ob Ergebnisse vorhanden sind & Darstellung der Infoboxen
        if (isset($data['Search'][0])) {
            $results = $data['totalResults'];
            echo "
            <link rel='stylesheet' href='style.css'>

            <div id='infoBoxDiv'>
            <div id='infoBox1'>  Suche für '" . $query . "' </div>
            <div id='infoBox2'>" . $results . " gefundene Ergebnisse </div>
            <div id='infoBox3'>Seite " . $page . "</div>
            </div>
            
            <br>";
          } else {      // Falls keine Ergebnisse geliefert wurden, auf keine Ergebnisse hinweisen
            echo "
            <ul class='movie-list'> 
                 <li class='movie-item'>
                 <div class='movie-details'>
                 <h2 class='movie-title'>Keine Ergebnisse gefunden</h2>
                 </div>
                 </li>
            ";
          }
    ?>
	</div>

	<ul class="movie-list">              <!--ul = Liste-->
		<?php foreach ($data['Search'] as $movie): ?>   <!--Schleife, die jeden Eintrag des Arrays 'Search' darstellt-->
			<li class="movie-item">
				<img class="movie-poster" src=<?php echo $movie['Poster']; ?>>      <!--Die einzelnen Komponenten Poster, Details, Titel & Overwiev werden dargestellt-->
                <div class="movie-details">
					
                    <h2 class="movie-title"> 
                        <a href="details?id=<?php echo $movie['imdbID']; ?>" id="movie-title-link">
                        <?php echo $movie['Title']; ?>
                        </a>
                    </h2>

					<p class="movie-overview">
                        <?php echo $movie['Year'];?> • 
                        
                        <?php 
                        if($movie['Type'] == 'movie') {     // Anzeige der Art des Objekts, es gibt movie, series & game
                            echo 'Film';
                        } elseif ($movie['Type'] == 'series') {
                            echo 'Serie';
                        } elseif ($movie['Type'] == 'game') {
                            echo 'Spiel';
                        } else {
                            echo 'Sonstiges';
                        }
                        ?> • imdb-Bewertung 

                        <?php           // Abrufen der imdb-Bewertung & Kurzübersicht, da diese nicht in der Suchanfrage nicht intigriert ist. > zeitaufwendig & langsam / TODO: lösen
                        $movieData = json_decode(file_get_contents("https://www.omdbapi.com/?apikey=" . $api_key . "&i=" . $movie['imdbID']), true);
                        echo $movieData['imdbRating'];
                        echo "<br>" . $movieData['Plot'];

                        ?>
                        

                    </p>

				</div>
			</li>
		<?php endforeach; ?>
	</ul>
    
    <br>
    <br>
    <hr>

    <div class="page">          <!--Seitenauswahl, aktuelle Seite wird per URL(GET) weiter gegeben-->
    <?php
    $urlnext = "search?query=" . (string)$search . "&page=" . ($page + 1); // URL für die nächste Seite
    $urlprev = "search?query=" . (string)$search . "&page=" . ($page - 1); // URL für die letzte Seite
  
    if($page > 1) {
        echo "<a href='" . $urlprev . "' class='prev-page'>&#8249;   </a>";
    }
        echo "<a href='#' class='page-link'>$page</a>";         // Anzeige der aktuelle Seite
        echo "<a href='" . $urlnext . "' class='next-page'>   &#8250;</a>";
     ?>
</div>

</body>
</html>