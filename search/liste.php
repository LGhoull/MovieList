<!DOCTYPE html>
<html>

    <?php
        require '../reglog/config.php';
        session_start();
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
        <a href="home.php" id="logo">MovieList.de</a>
            <button class="button" onclick="window.location.href='home.php';">Home</button>
            <button class="button" onclick="window.location.href='liste.php';">Meine Liste</button>
            <button class="button" onclick="window.location.href='../reglog/logout.php';">Abmelden</button>
        </div>
    <br> <br>
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
    </body>
</html>