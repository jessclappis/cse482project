<?php
  require("inc/inc.php");
  session_start();
  unset($_SESSION['movies']);

  header("Location: " . $indexpage);
  exit();
?>
