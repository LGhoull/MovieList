<?php
require 'config.php';
    function destroySession() {
        $_SESSION = [];
        session_unset();
        session_destroy();
    };

    echo "
    
    <!DOCTYPE html>
    <html lang='en' dir='ltr'>
    <head>
        <meta charset='utf-8'>
        <title>MovieList.de</title>
        <link rel='stylesheet' href='./css/login.css'>
        <link rel='stylesheet' href='./css/header.css'>
    </head>

        <body>

        <div id='header'>
        <a href='../search/home.php' id='logo'>MovieList.de</a>
        </div>
        <br> <br> <br> <br> <br>
        <div class='logoutDiv'>
        <h2>Du wirst nun ausgeloggt...</h2><div class='spinner'></div>
        </div>
        </body>
    </html>

    ";
    destroySession();
    header('Refresh: 5; url=login.php');

    exit;
?>