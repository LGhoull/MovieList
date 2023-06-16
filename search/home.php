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
		<input type="text" placeholder="Suche...">
        <button class="button2" onclick="window.location.href='search?query=' + encodeURIComponent(document.querySelector('#search input[type=text]').value);"><span class="material-symbols-outlined" style="color:azure;">search</span></button>
	</div>

    <div class="container"> <!--ein Container mit den Karten der Genres. TODO: Objektorientiert darstellen-->
        <div class="box" onclick="window.location.href='search?query=action'">
            <img src="https://via.placeholder.com/50" alt="Action">
            <span><span class="material-symbols-outlined">arrow_forward_ios</span> Action</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=comedy'">
            <img src="https://via.placeholder.com/50" alt="Comedy">
            <span><span class="material-symbols-outlined">arrow_forward_ios</span> Comedy</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=drama'">
            <img src="https://via.placeholder.com/50" alt="Drama">
            <span><span class="material-symbols-outlined">arrow_forward_ios</span> Drama</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=horror'">
            <img src="https://via.placeholder.com/50" alt="Horror">
            <span><span class="material-symbols-outlined">arrow_forward_ios</span> Horror</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=sci-fi'">
            <img src="https://via.placeholder.com/50" alt="Science Fiction">
            <span><span class="material-symbols-outlined">arrow_forward_ios</span> Science Fiction</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=thriller'">
            <img src="https://via.placeholder.com/50" alt="Thriller">
            <span><span class="material-symbols-outlined">arrow_forward_ios</span> Thriller</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=animation'">
            <img src="https://via.placeholder.com/50" alt="Animation">
            <span><span class="material-symbols-outlined">arrow_forward_ios</span> Animation</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=documentary'">
            <img src="https://via.placeholder.com/50" alt="Dokumentation">
            <span><span class="material-symbols-outlined">arrow_forward_ios</span> Dokumentation</span>
        </div>
        <div class="box" onclick="window.location.href='search?query=FSK18'">
            <img src="https://via.placeholder.com/50" alt="FSK18">
            <span><span class="material-symbols-outlined">arrow_forward_ios</span> FSK18</span>
        </div>
    </div>
        <br> 

        <hr>

        <div class="footer"> <!--Footer - experimentelles Feature mit Designänderung-->
            <form action="home" method="post">
                <?php 
                    $result = mysqli_query($conn, "select colormode FROM tb_user WHERE id = '" . $_SESSION['id'] . "'");
                    $row = mysqli_fetch_assoc($result);
                    if($row['colormode'] == null || $row['colormode'] == "NULL") {
                        $colormode=1;
                    } else {
                        $colormode = $row['colormode'];
                    }

                    if($colormode==1) {
                        echo "<input class='input' type='submit' value='wechseln zu: Heller Modus'/>
                              <input type='hidden' name='mode' value='hell'/>";
                    } else {
                        echo "<input class='input' type='submit' value='wechseln zu: Dunkler Modus'/>
                              <input type='hidden' name='mode' value='dunkel'/>";
                    }
                ?>
            </form>
        </div>
</body>
</html>