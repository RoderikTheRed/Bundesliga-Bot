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
    <title>Add Team | Bundesliga Bot</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/bundesliga.png" />
  </head>
  <body>
    <?php
    if(isset($_POST["submit"])) {
      require("mysql.php");
      $stmt = $mysql->prepare("INSERT INTO tabelle (RANG, VEREIN, SPIELE, PUNKTE) VALUES (:rang, :verein, :spiele, :punkte)");
      $stmt->bindParam(":rang", $_POST["rang"]);
      $stmt->bindParam(":verein", $_POST["verein"]);
      $stmt->bindParam(":spiele", $_POST["spiele"]);
      $stmt->bindParam(":punkte", $_POST["punkte"]);
      $stmt->execute();
      $stmt = $mysql->prepare("INSERT INTO letzten (VEREIN, EINS, ZWEI, DREI, VIER FÜNF) VALUES (:verein, :eins, :zwei, :drei, :vier, :fünf)");
      $stmt->bindParam(":verein", $_POST["verein"]);
      $stmt->bindParam(":eins", $_POST["match1"]);
      $stmt->bindParam(":zwei", $_POST["match2"]);
      $stmt->bindParam(":drei", $_POST["match3"]);
      $stmt->bindParam(":vier", $_POST["match4"]);
      $stmt->bindParam(":fünf", $_POST["match5"]);

      header("Location: interface.php?sucess=1");
    }
     ?>
     <form action="add.php" method="post">
       <input type="text" name="rang" placeholder="Rang" required><br>
       <input type="text" name="verein" placeholder="Verein" required><br>
       <input type="text" name="spiele" placeholder="Spiele" required><br>
       <input type="text" name="punkte" placeholder="Punkte" required><br>
       <a>Match 1</a>
       <select name="match1">
          <option value="">✔</option>
          <option value="saab">◯</option>
          <option value="mercedes">✖</option>
      </select><br>
      <a>Match 2</a>
      <select name="match2">
         <option value="✔">✔</option>
         <option value="◯">◯</option>
         <option value="✖">✖</option>
     </select><br>
     <a>Match 3</a>
     <select name="match3">
        <option value="✔">✔</option>
        <option value="◯">◯</option>
        <option value="✖">✖</option>
    </select><br>
    <a>Match 4</a>
    <select name="match4">
       <option value="✔">✔</option>
       <option value="◯">◯</option>
       <option value="✖">✖</option>
   </select><br>
   <a>Match 5</a>
   <select name="match5">
      <option value="✔">✔</option>
      <option value="◯">◯</option>
      <option value="✖">✖</option>
  </select><br>
       <button type="submit" name="submit">Hinzufügen</button>
     </form>
  </body>
</html>
