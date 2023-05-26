<!DOCTYPE html>
<html>

    <head>
        <link href="style.css" rel="stylesheet" type="text/css"/>
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
    
    <div id="welcome">
        Willkommen auf MovieSearch.de, [Account.Name]

    </div>

	<div id="search">
		<input type="text" placeholder="Suche...">
        <button onclick="window.location.href='search.php?query=' + encodeURIComponent(document.querySelector('#search input[type=text]').value);">Suchen</button>
	</div>

    <div class="container">
        <div class="box" onclick="window.location.href='search.php?query=action'">
            <img class= "imgCard" src="https://via.placeholder.com/100" alt="Action">
            <span>Action</span>
        </div>
        <div class="box" onclick="window.location.href='search.php?query=comedy'">
            <img src="https://via.placeholder.com/100" alt="Comedy">
            <span>Comedy</span>
        </div>
        <div class="box" onclick="window.location.href='search.php?query=drama'">
            <img src="https://via.placeholder.com/100" alt="Drama">
            <span>Drama</span>
        </div>
        <div class="box" onclick="window.location.href='search.php?query=horror'">
            <img src="https://via.placeholder.com/100" alt="Horror">
            <span>Horror</span>
        </div>
        <div class="box" onclick="window.location.href='search.php?query=sci-fi'">
            <img src="https://via.placeholder.com/100" alt="Science Fiction">
            <span>Science Fiction</span>
        </div>
        <div class="box" onclick="window.location.href='search.php?query=thriller'">
            <img src="https://via.placeholder.com/100" alt="Thriller">
            <span>Thriller</span>
        </div>
        <div class="box" onclick="window.location.href='search.php?query=animation'">
            <img src="https://via.placeholder.com/100" alt="Animation">
            <span>Animation</span>
        </div>
        <div class="box" onclick="window.location.href='search.php?query=documentary'">
            <img src="https://via.placeholder.com/100" alt="Dokumentation">
            <span>Dokumentation</span>
        </div>
        <div class="box" onclick="window.location.href='search.php?query=FSK18'">
            <img src="https://via.placeholder.com/100" alt="FSK18">
            <span>FSK18</span>
        </div>
</body>
</html>