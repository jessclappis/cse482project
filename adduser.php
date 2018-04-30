<?php
  require("inc/inc.php");

  $username = strip_tags($_POST['new-username']);
  $password = strip_tags($_POST['new-password']);
  $password_confirm = strip_tags($_POST['new-password-confirm']);

  // check if any fields are empty
  if(empty($username) || empty($password) || empty($password_confirm)){
    header("Location: " . $menupage . "?e=21");
    exit();
  }

  // check if passwords match
  if($password !== $password_confirm){
    header("Location: " . $menupage . "?e=22");
    exit();
  }

  // hash and salt password
  $salt = bin2hex(openssl_random_pseudo_bytes(8));
  $hash = hash("sha256", $password . $salt);

  // insert user into the database
  $sql = <<<SQL
    INSERT INTO cse482project_user (username, password, salt)
    VALUES      (?,?,?)
SQL;

  $statement = $pdo->prepare($sql);
  $statement->execute(array($username, $hash, $salt));

  // redirect back to menu and allow user to login
  header("Location: " . $menupage . "?u");
  exit();
?>
