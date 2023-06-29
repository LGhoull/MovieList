<!DOCTYPE html>
<html>
    <!--Startseite und Suchbar-->

    <?php                                               // Befindet sich in jeder Seite, gibt vor, dass die config.php benötigt wird 
                                                        // und leitet user um, wenn sie nicht angemeldet sind. 
        require '../reglog/config.php';
        session_start();
        if(!isset($_SESSION['id'])) {
            header("Location: ../reglog/login");    // Weiterleitung zur login.php falls unangemeldet
            die();
        }

        if(isset($_POST['mode'])) {                     // Experimentelle Designauswahl
            if($_POST['mode'] == "dunkel") {
                $query = "update tb_user set 'colormode' = 1 where id = " .  $_SESSION['id'] . ";";
                mysqli_query($conn, $query);
            } else {
                $query = "update tb_user set 'colormode' = 2 where id = " .  $_SESSION['id'] . ";";
                mysqli_query($conn, $query);
            }
            header("Refresh:3");
        }
    ?>

    <head>  <!--beinhaltet eine google css mit verschiedenen symbolen-->
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,200" />
        <title>MovieList.de</title>
    </head>

    <body>  <!--Header - in jedem Dokument gleich-->
        <div id="header">
        <a href="home" id="logo">MovieList.de</a>
            <button class="button" onclick="window.location.href='home';">Home</button>
            <button class="button" onclick="window.location.href='liste';">Meine Liste</button>
            <button class="button" onclick="window.location.href='../reglog/logout';">Abmelden</button>
        </div>
    <br> <br>
    
    <div id="welcome">
        Willkommen auf MovieList.de, <?php echo $_SESSION['name'] ?> <!--Sessioninformationen beinhalten namen & Id des angemeldeten Users / siehe login.php-->
    </div>

	<div id="search">   <!--Suche mit Suchbar und Button-->
    <form id="search" action="search" method="GET">
        <input type="text" name="query" placeholder="Suche...">
        <button type="submit" name="submit" class="button2"><span class="material-symbols-outlined" style="color:azure;">search</span></button>
    </form>
    </div>

    <div class="container"> <!--ein Container mit den Karten der Genres. TODO: Objektorientiert darstellen-->
        <div class="box" onclick="window.location.href='search?query=action'">
            <img src="https://media.tenor.com/pMhSj9NfCXsAAAAd/saul-goodman-better-call-saul.gif" alt="Action">
            <br><span><span class="material-symbols-outlined">arrow_forward_ios</span> Action</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=comedy'">
            <img src="https://media.tenor.com/qzKGBxyjjuoAAAAM/fake-gunshot-shoot-self.gif" alt="Comedy">
            <br><span><span class="material-symbols-outlined">arrow_forward_ios</span> Comedy</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=drama'">
            <img src="https://media.tenor.com/flAEdYmmzWkAAAAM/manifest-michaela-stone.gif" alt="Drama">
            <br><span><span class="material-symbols-outlined">arrow_forward_ios</span> Drama</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=horror'">
            <img src="https://media.tenor.com/4bAjBHHF59EAAAAd/creepy-smile-smile.gif" alt="Horror">
            <br><span><span class="material-symbols-outlined">arrow_forward_ios</span> Horror</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=sci-fi'">
            <img src="https://media.tenor.com/8Gw_V8YrUpYAAAAd/interstellar-crying.gif" alt="Science Fiction">
            <br><span><span class="material-symbols-outlined">arrow_forward_ios</span> Science Fiction</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=thriller'">
            <img src="https://media.tenor.com/iE7MTQNviFsAAAAd/playing-video-games-regus-patoff.gif" alt="Thriller">
            <br><span><span class="material-symbols-outlined">arrow_forward_ios</span> Thriller</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=animation'">
            <img src="https://media.tenor.com/Perjat4L7xsAAAAC/attack-on-titan-motherfucker.gif" alt="Animation">
            <br><span><span class="material-symbols-outlined">arrow_forward_ios</span> Animation</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=documentary'">
            <img src="https://media.tenor.com/O1pgisgi5AQAAAAd/ronaldo-ronaldo-wink.gif" alt="Dokumentation">
            <br><span><span class="material-symbols-outlined">arrow_forward_ios</span> Dokumentation</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=FSK18'">
            <img src="https://media.tenor.com/I-cTGJkdO8MAAAAd/johnnysins-johnny.gif" alt="FSK18">
            <br><span><span class="material-symbols-outlined">arrow_forward_ios</span> Weitere Filme</span>
        </div>
    </div>
        <br> 
</body>
</html>