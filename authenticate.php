<?php
  require("inc/inc.php");

  $username = strip_tags($_POST['username']);
  $password = strip_tags($_POST['password']);

  // check user login
  $sql = <<<SQL
    SELECT *
    FROM   cse482project_user
    WHERE  username = ?
SQL;

  $statement = $pdo->prepare($sql);
  $statement->execute(array($username));

  if($statement->rowCount() === 0){
    header("Location: " . $menupage . "?e=11");
    exit();
  }

  $row = $statement->fetch(\PDO::FETCH_ASSOC);
  //check to see if passwords match
  $hash = $row['password'];
  $salt = $row['salt'];

  // no encryption
  // if($password !== $hash){
  //   header("Location: " . $menupage . "?e=12");
  //   exit();
  // }
  // encryption
  if($hash !== hash("sha256", $password . $salt)){
    header("Location: " . $menupage . "?e=12");
    exit();
  }

  // if user is authenticated: set session and redirect to site home page
  $id = $row['id'];
  $username = $row['username'];
  session_start();
  $_SESSION["user"] = array($id, $username);
  header("Location: " . $indexpage);
?>
