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
	    <link rel="stylesheet" href="style.css">
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
            $result = mysqli_query($conn, "SELECT * FROM tb_movielists WHERE id = '$UserId'");
            $row = mysqli_fetch_assoc($result);
            $movieIds = is_null($row) ? [] : [$row["movieId"]];
            $data = [];
            if (mysqli_num_rows($result) > 0) {
                echo "
                <link rel='stylesheet' href='style.css'>

                <div id='infoBoxDiv'>
                <div id='infoBox1'>  Eigene Liste </div>
                <div id='infoBox2'>" . count($movieIds) . " gefundene Ergebnisse </div>
                </div>
            
                <br>";
                
            } else {
                //list length 0
                echo "
                <link rel='stylesheet' href='style.css'>

                <div id='infoBoxDiv'>
                <div id='infoBox1'> Du hast noch keine Liste! </div>
                </div>
            
                <br>";
            }
            foreach($movieIds as $movieId)
            {
                // url bauen
                $url = "https://www.omdbapi.com/?apikey=" . $api_key . "&i=" . $movieId;

                // ergebniss ziehen
                $response = file_get_contents($url);

                // json in ne php value decodieren
                $movie = json_decode($response, true);

                array_push($data, $movie);
            }
            
        ?>
        <link rel="stylesheet" href="style.css">
            <head>
                <link rel="stylesheet" href="style.css">
            </head>
        <ul class="movie-list">
            <?php foreach ($data as $movie): ?>
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
    </body>
</html>
<?php/*
    php code für die like buttons:
    $query = "INSERT INTO tb_movielists VALUES(" . $_SESSION["id"] . ", " . $movieId . ")";
    mysqli_query($conn, $query);
*/ ?>