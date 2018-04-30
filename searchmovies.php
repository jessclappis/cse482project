<?php
  require("inc/inc.php");

  $moviename = $_POST['movie-name'];
  // echo $moviename;

  $command = "python3 Python/search_movies.py '" . $moviename . "'";
  exec($command, $out, $status);
  // print_r($out);

  $results = array();
  foreach($out as $key => $val){
    $movie = explode("\t", $val);
    array_push($results, $movie);
    // echo $movie[0] . " " . $movie[1] . " " . $movie[2] . "<br />";
  }
  // print_r($results);
  session_start();
  $_SESSION['search-movies-results'] = $results;
  header("Location: " . $indexpage);
  exit();

?>
