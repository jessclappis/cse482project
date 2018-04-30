<?php
  require("inc/inc.php");
  session_start();

  $movieID = $_POST['movieID'];
  $title = $_POST['title'];
  $releaseYear = $_POST['releaseYear'];
  $rating = $_POST['rating'];

  $movie = array($movieID,$title,$releaseYear,$rating);
  if( isset($_SESSION['movies']) ){
    // add to array session
    array_push($_SESSION['movies'], $movie);
  }
  else{
    // create session variable for rated movies
    $_SESSION['movies'] = array($movie);
  }

  header("Location: " . $indexpage);
  exit();
?>
