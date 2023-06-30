<?php
require 'config.php';
if (!empty($_SESSION["id"])) {
  header("Location: index");
}
if (isset($_POST["submit"])) {
  $usernameemail = $_POST["usernameemail"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email = '$usernameemail'");
  $row = mysqli_fetch_assoc($result);
  if (mysqli_num_rows($result) > 0) {
    if (password_verify($password, $row['password'])) {
      session_start();
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      $_SESSION["name"] = $row["name"];
      $_SESSION["colormode"] = $row["colormode"];

      header("Location: ../search/home");
    } else {
      echo "<script> alert('Wrong Password'); </script>";
    }
    } else {
      echo "<script> alert('User Not Registered'); </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MovieList.de</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="icon" href="../../../media/favicon.ico" type="image/x-icon">
  </head>
   <body>

      <div id="header">
        <a href="../search/home" id="logo">MovieList.de</a>
        <button class="button" onclick="window.location.href='registration';">Registrieren</button>
      </div>
    <br> <br> <br>

    <h2>Login</h2>

    <form class="" action="" method="post" autocomplete="off">
      <label for="usernameemail">Username oder Email :</label>
      <input type="text" name="usernameemail" id="usernameemail" required value=""><br>
      <label for="password">Passwort :</label>
      <input type="password" name="password" id="password" required value=""><br>
      <button type="submit" name="submit">Login</button>
    </form>
    
    <br>
    <a class="aa" href="registration">Registrierung</a>
  </body>
</html>
