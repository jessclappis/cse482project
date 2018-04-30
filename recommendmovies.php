<?php
  require("inc/inc.php");
  session_start();

  // print_r($_SESSION);
  $username = $_SESSION['user'][1];
  echo $username . "<br />";
  $movies = $_SESSION['movies'];
  // print_r($movies);

  $my_file = 'Python/user_rated_movies.tsv';
  $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
  foreach ($movies as $key => $value) {
    $data = $username . "\t" . $value[1] . "\t" . $value[3] . "\n";
    fwrite($handle, $data);
  }

  $command = "python3 Python/projectscrpt.py";
  exec($command, $out, $status);

  print_r($out);
?>
