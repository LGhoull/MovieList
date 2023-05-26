<?php
session_start();
$host = "localhost";
$dbname = "movielist";
$user = "movielist";
$passwort = "xelA";

// Verbindung herstellen
$conn = mysqli_connect($host, $user, $passwort, $dbname);
// Verbindung prüfen
if ($conn->connect_error) {
    echo "$conn->connect_error";
  die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}