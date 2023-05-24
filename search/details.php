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


    <?php

      $id = "";
      if(isset($_GET['id'])) {
        $id = $_GET['id'];
      }

      // apikey
      $api_key = "91d40bff";

      // url bauen
      $url = "https://www.omdbapi.com/?apikey=" . $api_key . "&i=" . $id . "&plot=full";

      // ergebniss ziehen
      $response = file_get_contents($url);

      // json in ne php value decodieren
      $data = json_decode($response, true);

      if(isset($data['Title'])) {
        echo "<h2 id='detail-title'> " . $data['Title'] . " </h2>";

      } else {
        echo "<h2 id='detail-title'> Fehler: Keine Daten gefunden </h2>";
      }
    ?>

  
    <h3>Titel: <?php echo $data['Title']?> </h3>
    <h3>Erscheinungsdatum: <?php echo $data['Released']?> </h3>
    <h3>Länge: <?php echo $data['Runtime']?> </h3>
    <h3>Genres: <?php echo $data['Genre']?> </h3>
    <h3>Hauptrollen: <?php echo $data['Actors']?> </h3>
    <h3>Kurzbeschreibung: <?php echo $data['Plot']?> </h3>
    <h3>imdb Bewertung: <?php echo $data['imdbRating']?> </h3>
    <h3>Typ: <?php echo $data['Type']?> </h3>
    <h3>Staffeln: <?php echo $data['totalSeasons']?> </h3>
    

  </body>
</html>
