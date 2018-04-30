<?php
  $pdo = new PDO('mysql:host=174.138.38.48;dbname=cse482project', 'unionpacific', 'UnionPacificDB');

  $rootpage = "http://159.65.164.241/";
  $menupage = $rootpage . "menu.php";
  $indexpage = $rootpage . "index.php";

  function printHeader(){
    $html = <<<HTML
<h1 id="proj-header">CSE 482 Project: Movie Recommender System</h1>
<h3 id="authors">By: Jessica Clappison and Daniel Agbay</h3>
HTML;
    return $html;
  }

  function printFooter(){
    $html =<<<HTML
<p>
  <small>
    CSE 482 Big Data Analysis at Michigan State University, Spring Semester 2018<br>
    Professor: Pang-Ning Tan<br>
    Course Website: <a href="http://www.cse.msu.edu/~ptan/CSE482/">http://www.cse.msu.edu/~ptan/CSE482/</a>
  </small>
</p>
HTML;
    return $html;
  }
?>
