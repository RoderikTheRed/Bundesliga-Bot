<?php
session_start();
if(!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit;
}
 ?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Interface | Bundesliga Bot</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style1.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="assets/bundesliga.png" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
    </head>
    <body>
      <?php
      if(!empty($_GET["delete"])) {
        echo "Team wurde erfolgreich gelöscht!";
        require("mysql.php");
        $stmt = $mysql->prepare("DELETE FROM tabelle WHERE VEREIN = :verein");
        $stmt->bindParam(":verein", $_GET["delete"]);
        $stmt->execute();
      }
      if(!empty($_GET["sucess"])) {
        echo "Erfolgreich angelegt!";
      }
       ?>
        <header>
            <a class="logo" href="interface.php"><img src="assets/bundesliga1.png" alt="logo"></a>
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

        <table border="1">
          <tr>
          <th>Rang</th>
          <th>Verein</th>
          <th>Spiele</th>
          <th>Punkte</th>
          <th>Letzten 5</th>
          <th>Aktionen</th>
          </tr>

          <?php
   require("mysql.php");

   $stmt = $mysql->prepare("SELECT * FROM tabelle ORDER BY `tabelle`.`RANG` ASC");
   $stmt->execute();
   while($row = $stmt->fetch()){
       ?>
       <tr>
       <td><?php echo $row["RANG"] ?></td>
       <td><?php echo $row["VEREIN"] ?></td>
       <td><?php echo $row["SPIELE"] ?></td>
       <td><?php echo $row["PUNKTE"] ?></td>
       <td></td>
       <td><a href="edit.php?verein=<?php echo $row["VEREIN"] ?>"><i class="fas fa-edit"></i></a><a href="interface.php?delete=<?php echo $row["VEREIN"] ?>"><i class="fas fa-trash-alt"></i></a></td>

       </tr>
       <?php
      }
      ?>
        </table>
        <a href="add.php"><i class="fas fa-plus"></i></a>

        <script type="text/javascript" src="mobile.js"></script>
    </body>
</html>
