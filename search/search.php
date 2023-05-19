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

    $page;
    if(isset($_GET['page'])) {
    $page = $_GET['page'];
    } else {
        $page=1;
    }
    
    $search = str_replace(' ', '+', $query); // ersetzt Leerzeichen durch + für die API

        // apikey
        $api_key = "91d40bff";

        // url bauen
        $url = "https://www.omdbapi.com/?apikey=" . $api_key . "&s=" . (string)$search . "&page=" . $page;

        // ergebniss ziehen
        $response = file_get_contents($url);

        // json in ne php value decodieren
        $data = json_decode($response, true);

        // auf ergebnisseprüfen
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
          } else {
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
                        } elseif ($movie['Type'] == 'game') {
                            echo 'Spiel';
                        } else {
                            echo 'Sonstiges';
                        }
                        ?> • imdb-Bewertung 

                        <?php 
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

    <div class="page">
    <?php
    $urlnext = "search.php?query=" . (string)$search . "&page=" . ($page + 1);
    $urlprev = "search.php?query=" . (string)$search . "&page=" . ($page - 1);
  
    if($page > 1) {
        echo "<a href='" . $urlprev . "' class='prev-page'>&#8249;   </a>";
    }
        echo "<a href='#' class='page-link'>$page</a>";
        echo "<a href='" . $urlnext . "' class='next-page'>   &#8250;</a>";
     ?>
</div>

</body>
</html>

</body>
</html>