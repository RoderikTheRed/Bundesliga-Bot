<?php
session_start();
if(!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit;
}
 ?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profil | Bundesliga Bot</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style1.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="assets/bundesliga.png" />
  </head>
  <body>
    <header>
        <a class="logo" href="/"><img src="assets/bundesliga1.png" alt="logo"></a>
        <nav>
            <ul class="nav__links">
                <li><a href="interface.php">Home</a></li>
                <li><a href="profil.php">Profil</a></li>
            </ul>
        </nav>
        <a class="cta" href="logout.php">Logout</a>
        <p class="menu cta">Menu</p>
    </header>
    <div id="mobile__menu" class="overlay">
        <a class="close">&times;</a>
        <div class="overlay__content">
            <a href="interface.php">Home</a>
            <a href="profil.php">Profil</a>
        </div>
    </div>
    <?php
    require("mysql.php");
    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :username");
    $stmt->bindParam(":username", $_SESSION["username"]);
    $stmt->execute();
    $row = $stmt->fetch();
     ?>
     <input type="text" name="username" value="<?php echo $row["USERNAME"] ?>" required><br>
     <input type="password" name="password" value="<?php echo $row["PASSWORD"] ?>" required><br>
     <button type="submit" name="submit">Speichern</button>
    <?php
    if(isset($_POST["submit"])) {
      require("mysql.php");
      $stmt = $mysql->prepare("UPDATE accounts SET USERNAME = :username, PASSWORD :password");
      $stmt->bindParam(":username", $_POST["username"]);
      $stmt->bindParam(":password", $_POST["password"]);
      $stmt->execute();
      echo "Die Daten wurden erfolgreich gespeichert!";
    }
     ?>
    <script type="text/javascript" src="mobile.js"></script>
  </body>
</html>
