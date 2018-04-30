<?php
  require("inc/inc.php");
  session_start();
  session_unset();

  header("Location: " . $menupage . "?e=2");
  exit();
?>
