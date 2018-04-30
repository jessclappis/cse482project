<?php
  require("inc/inc.php");
  session_start();
  unset($_SESSION['search-movies-results']);

  header("Location: " . $indexpage);
  exit();
?>
