<?php
// Einbinden der Konfigurationsdatei
require 'config.php'; 

if (!empty($_SESSION["id"])) { // Überprüfen, ob bereits eine Sitzung gestartet wurde
  header("Location: index.php"); // Weiterleitung zur Hauptseite
}

if (isset($_POST["submit"])) { // Überprüfen, ob das Registrierungsformular abgeschickt wurde
  $name = $_POST["name"]; // Name aus dem Formular auslesen
  $username = $_POST["username"]; // Benutzernamen aus dem Formular auslesen
  $email = $_POST["email"]; // E-Mail aus dem Formular auslesen
  $password = $_POST["password"]; // Passwort aus dem Formular auslesen
  $confirmpassword = $_POST["confirmpassword"]; // Bestätigung des Passworts aus dem Formular auslesen

  $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'"); // Überprüfen, ob der Benutzername oder die E-Mail bereits vorhanden sind

  if (mysqli_num_rows($duplicate) > 0) { // Überprüfen, ob bereits ein Benutzer mit demselben Benutzernamen oder derselben E-Mail-Adresse existiert
    echo "<script> alert('Username or Email Has Already Taken'); </script>"; // Fehlermeldung ausgeben
  } else {
    if ($password == $confirmpassword) { // Überprüfen, ob das Passwort mit der Bestätigung übereinstimmt
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Passwort hashen (sicherer als das Klartext-Passwort zu speichern)
      $query = "INSERT INTO tb_user VALUES('', '$name', '$username', '$email', '$hashedPassword')"; // SQL-Query zum Einfügen des neuen Benutzers
      mysqli_query($conn, $query); // Query ausführen, um den neuen Benutzer in die Datenbank einzufügen
      echo "<script> alert('Registration Successful'); </script>"; // Erfolgsmeldung ausgeben
    } else {
      echo "<script> alert('Password Does Not Match'); </script>"; // Fehlermeldung ausgeben, dass die Passwörter nicht übereinstimmen
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="./css/register.css"> 
  </head>
  <body>
    <h2>Registration</h2>
    <form class="" action="" method="post" autocomplete="off">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" required value=""><br>
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required value=""><br>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required value=""><br>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required value=""><br>
      <label for="confirmpassword">Confirm Password:</label>
      <input type="password" name="confirmpassword" id="confirmpassword" required value=""><br>
      <button type="submit" name="submit">Register</button>
    </form>
    <br>
    <a href="login.php">Login</a> 
  </body>
</html>