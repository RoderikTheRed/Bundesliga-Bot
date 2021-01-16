<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login | Bundesliga Bot</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/bundesliga.png" />
  </head>
  <body>
    <?php
    if(isset($_POST["submit"])) {
      require("mysql.php");
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :username");
      $stmt->bindParam(":username", $_POST["username"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count != 0) {
        $row = $stmt->fetch();
        if($_POST["password"] == $row["PASSWORD"]) {
          session_start();
          $_SESSION["username"] = $row["USERNAME"];
          header("Location: interface.php");
        } else {
          echo "Der Login ist fehlgeschlagen!";
        }
      } else {
        echo "Der Login ist fehlgeschlagen!";
      }
    }
     ?>
    <form class="box" action="login.php" method="post">
      <img src="assets\bundesliga.png" alt="">
      <h1>Login</h1>
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <input type="submit" name="submit" value="Login">
    </form>
  </body>
</html>
