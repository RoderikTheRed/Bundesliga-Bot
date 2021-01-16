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
    <title>Edit Team | Bundesliga Bot</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/bundesliga.png" />
  </head>
  <body>
    <?php
    if(isset($_GET["verein"])) {
      if(!empty($_GET["verein"])) {
        if(isset($_POST["submit"])) {
          require("mysql.php");
          $stmt = $mysql->prepare("UPDATE tabelle SET RANG = :rang, VEREIN = :verein, SPIELE = :spiele, PUNKTE = :punkte WHERE VEREIN = :vereinold");
          $stmt->bindParam(":vereinold", $_GET["verein"]);
          $stmt->bindParam(":rang", $_POST["rang"]);
          $stmt->bindParam(":verein", $_POST["verein"]);
          $stmt->bindParam(":spiele", $_POST["spiele"]);
          $stmt->bindParam(":punkte", $_POST["punkte"]);
          $stmt->execute();
          header("Location: interface.php");
        }
        require("mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM tabelle WHERE VEREIN = :verein");
        $stmt->bindParam(":verein", $_GET["verein"]);
        $stmt->execute();
        $row = $stmt->fetch();
        ?>
        <form action="edit.php?verein=<?php echo $_GET["verein"] ?>" method="post">
          <input type="text" name="rang" value="<?php echo $row["RANG"] ?>">
          <input type="text" name="verein" value="<?php echo $row["VEREIN"] ?>">
          <input type="text" name="spiele" value="<?php echo $row["SPIELE"] ?>">
          <input type="text" name="punkte" value="<?php echo $row["PUNKTE"] ?>">
          <button type="submit" name="submit">Speichern</button>
        </form>
        <?php
      } else {
        echo "Kein Benutzer wurde angefragt!";
         ?>
         <a href="interface.php">Zurück zum Interface</a>
         <?php
      }
  } else {
    echo "Kein Benutzer angefragt!";
    ?>
    <a href="interface.php">Zurück zum Interface</a>
    <?php
  }
     ?>
  </body>
</html>
