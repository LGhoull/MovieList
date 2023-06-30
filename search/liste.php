<!DOCTYPE html>
<html>
    <?php
        require '../reglog/config.php';
        if(!isset($_SESSION['id'])) {
            header("Location: ../reglog/login.php");
            die();
        }
    ?>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <title>MovieList.de</title>
    </head>
    <body>
        <div id="header">
            <a href="home" id="logo">MovieList.de</a>
            <button class="button" onclick="window.location.href='home';">Home</button>
            <button class="button" onclick="window.location.href='liste';">Meine Liste</button>
            <button class="button" onclick="window.location.href='../reglog/logout';">Abmelden</button>
        </div>
        <br> <br>
        <?php
            // apikey
            $api_key = "91d40bff";

            // get the movie list from database
            $UserId = $_SESSION["id"];

            $query = "select * from tb_movieLists where id='$UserId'";
            $result = $conn->query($query);

            $data = $result->fetch_all(MYSQLI_ASSOC); // $data nun als Array[Zeile], der Hashtables Enthält

            if (count($data) > 0) {
                echo "
                <div id='infoBoxDiv'>
                <div id='infoBox1'>  Persönliche Liste von " . $_SESSION["name"] . " </div>
                <div id='infoBox2'>" . count($data) . " gefundene Ergebnisse </div>
                </div>
            
                <br>";
                
            } else { // Falls die Liste leer ist
                echo "
                <div id='infoBoxDiv'>
                <div id='infoBox1'> Du hast noch keine Liste! </div>
                </div>
            
                <br>";
            }

            $movieData = [];

            foreach($data as $movieId)
            {
                // url bauen
                $url = "https://www.omdbapi.com/?apikey=" . $api_key . "&i=" . $movieId["movieid"];

                // Film ziehen
                $response = file_get_contents($url); 

                // json in ne php value decodieren
                $value = json_decode($response, true);
                
                //Film in $movieData einfügen
                array_push($movieData, $value);
            }
            
        ?>

        <ul class="movie-list">
            <?php foreach ($movieData as $movie): //Anzeige von search.php?>
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
                            ?> • imdb-Bewertung <?php echo $movie["imdbRating"]."<br>" . $movie['Plot']; ?>
                            
                        </p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>