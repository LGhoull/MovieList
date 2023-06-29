<!DOCTYPE html>
<html>

    <?php
        require '../reglog/config.php';
        session_start();
        if(!isset($_SESSION['id'])) {
            header("Location: ../reglog/login");
            die();
        }

        if(isset($_GET["action"])) {

          if($_GET["action"] == "add") {
            $userid = $_SESSION["id"];
            $movieid = $_GET["id"];

            $query = "INSERT INTO tb_movieLists(movieid, id) VALUES('$movieid', '$userid')";
            if(mysqli_query($conn, $query) == TRUE) {  } else { echo $conn->error(); }
            header("Refresh: 1; url=details?id=$movieid");
          } else {
            $userid = $_SESSION["id"];
            $movieid = $_GET["id"];
            
            $query = "DELETE FROM tb_movieLists WHERE id = '$userid' AND movieid = '$movieid'";
            if(mysqli_query($conn, $query) == TRUE) { } else { echo $conn->error(); }
            header("Refresh: 1; url=details?id=$movieid");
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

    <div class="imagediv">

      <img src="<?php echo $data["Poster"]; ?>" alt="">

      <div class="detailbox" style="margin-left: 100px; max-width: 40%;">
        <span class="detailtext">Kurzbeschreibung:</span><br>
        <span class="detailvalue"><?php echo $data['Plot']?></span>
      </div>
    </div>
    

    <div style="float: right; width: 41%; margin-right: 420px;">

    <?php 
    $UserId = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM tb_movieLists WHERE id = '$UserId' AND movieid = '$id'");
    $row = mysqli_fetch_assoc($result);

    $listMovieIds = is_null($row) ? [] : [$row["movieid"]];
    $isMovieInList = false;
    foreach($listMovieIds as $listMovieId){
        if($listMovieId == $_GET["id"])
        {
            $isMovieInList = true;
        }
    }

    if($isMovieInList) {
      $redirectUrl = $_SERVER['REQUEST_URI'] . "&action=remove";
      echo "
        <button class='buttonList' onclick=\"window.location.href = '$redirectUrl';\">Von der Liste entfernen</button>
      ";
    } else {
      $redirectUrl = $_SERVER['REQUEST_URI'] . "&action=add";
      echo "
        <button class='buttonList' onclick=\"window.location.href = '$redirectUrl';\">Zur Liste hinzufügen</button>
      ";
    }

    ?>

  </div>

  <p style="margin-top: 100px"></p>

    <div class="grid-container">
      <div class="detailbox">
        <span class="detailtext">Titel:</span><br>
        <span class="detailvalue"><?php echo $data['Title']?></span>
      </div>
      <div class="detailbox">
        <span class="detailtext">Erscheinungsdatum:</span><br>
        <span class="detailvalue"><?php echo $data['Released']?></span>
      </div>
      <div class="detailbox">
        <span class="detailtext">Länge:</span><br>
        <span class="detailvalue"><?php echo $data['Runtime']?></span>
      </div>
      <div class="detailbox">
        <span class="detailtext">Genres:</span><br>
        <span class="detailvalue"><?php echo $data['Genre']?></span>
      </div>
      <div class="detailbox">
        <span class="detailtext">Hauptrollen:</span><br>
        <span class="detailvalue"><?php echo $data['Actors']?></span>
      </div>
      <div class="detailbox">
        <span class="detailtext">imdb Bewertung:</span><br>
        <span class="detailvalue"><?php echo $data['imdbRating']?></span>
      </div>
      <div class="detailbox">
        <span class="detailtext">Typ:</span><br>
        <span class="detailvalue"><?php
                                if($data['Type'] == 'movie') {
                                    echo 'Film';
                                } elseif ($data['Type'] == 'series') {
                                    echo 'Serie';
                                } elseif ($data['Type'] == 'game') {
                                    echo 'Spiel';
                                } else {
                                    echo 'Sonstiges';
                                }?></span>
      </div>
      <div class="detailbox">
        <span class="detailtext">Staffeln:</span><br>
        <span class="detailvalue"><?php echo $data['totalSeasons']?></span>
      </div>
    </div>

  </body>
</html>
