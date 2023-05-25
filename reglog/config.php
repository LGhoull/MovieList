<?php
session_start();
$host = "localhost";
$name = "movielist";
$user = "movielist";
$passwort = "xelA";
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
 ?>