<!DOCTYPE html>
<html>

    <?php
        require '../reglog/config.php';
        session_start();
        if(!isset($_SESSION['id'])) {
            header("Location: ../reglog/login");
            die();
        }

        if(isset($_POST["submit"])) {
          if($_POST["add"]) {
            $userid = $_SESSION["id"];
            $movieid = $_GET["id"];

            $query = "INSERT INTO tb_movieLists(movieId, id) VALUES($movieid, $userid)";
            mysqli_query($conn, $query);
            header("Refresh: 2;");
          } else {
            $userid = $_SESSION["id"];
            $movieid = $_GET["id"];
            
            $query = "DELETE FROM tb_movieLists WHERE id = $userid AND movieId = $movieid)";
            mysqli_query($conn, $query);
            header("Refresh: 1;");
          }
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
    
      <span> <?php echo $_SESSION["id"] . $_GET["id"] ;?></span>

    <form action="" method="POST">

    <?php 

    $UserId = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM tb_movieLists WHERE id = '$UserId'");
    $row = mysqli_fetch_assoc($result);
    $listMovieIds = is_null($row) ? [] : [$row["movieId"]];
    $isMovieInList = false;
    foreach($listMovieIds as $listMovieId){
        if($listMovieId == $_GET["id"])
        {
            $isMovieInList = true;
        }
    }

    if($isMovieInList) {
      echo "
        <input type='hidden' name='remove'>
        <button class='buttonList' type='submit' name='submit'>Von der Liste entfernen</button>
      ";
    } else {
      echo "
        <input type='hidden' name='add'>
        <button class='buttonList' type='submit' name='submit'>Zur Liste hinzufügen</button>
      ";
    }

    ?>
    </form>

  </body>
</html>
