<?php
  session_start();
  require("inc/inc.php");
  if( !isset($_SESSION['user']) ){
    header("Location: " . $menupage . "?e=1");
    exit();
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>CSE 482 Project: Home</title>
    <link rel="stylesheet" href="CSS/styles.css" type="text/css">
  </head>

  <body>
    <header class="body-content">
      <?php echo printHeader(); ?>
    </header>

    <main class="body-content home-main">
      <ul id="main-menu">
        <li><b>Homepage</b></li>
        <li>&nbsp;</li>
        <li><a href="logout.php">Logout</a></li>
      </ul>

      <fieldset id="rated-movies">
        <legend>Rated Movies</legend>
        <?php
          if( isset($_SESSION['movies']) ){
            $html = "<p><a href=\"clearratedmovies.php\">Clear Rated Movies</a></p>";

            // print each rating in session
            $html .= "<table><th>Movie ID</th><th>Movie Title</th><th>Release Year</th><th>Rating</th>";
            $movies = $_SESSION['movies'];
            foreach ($movies as $key => $value) {
              $html .= "<tr>";
              foreach ($value as $key => $value2) {
                $html .= "<td>" . $value2 . "</td>";
              }
              $html .= "</tr>";
            }
            $html .= "</table>";
            echo $html;
          }
          else{
            echo "<div>You have not rated any movies yet.</div>";
          }
        ?>
      </fieldset>

      <fieldset id="search-movies">
        <legend>Search Movies</legend>
        <form id="form-search-movies" action="searchmovies.php" method="post">
          <p>
            <input id="movie-name" name="movie-name" type="text" placeholder="Enter movie name...">
            <button type="submit">Search</button>
          </p>
        </form>
        <?php
          if( isset($_SESSION['search-movies-results']) ){
            $html = "<p><a href=\"clearsearchedmovies.php\">Clear Searched Movies</a></p>";

            //print movies found
            $html .= "<table><th>Movie ID</th><th>Movie Title</th><th>Release Year</th><th>Rating:</th><th>Submit Rating</th>";
            $movies = $_SESSION['search-movies-results'];
            $headers = array("movieID", "title", "releaseYear");
            foreach ($movies as $key => $value) {
              $html .= "<tr><form id=\"ratemovie\" action=\"ratemovie.php\" method=\"post\">";
              $ndx = 0;
              foreach ($value as $key => $value2) {
                $html .= "<td>" . $value2 . "</td>";
                $html .= "<input type=\"hidden\" name=\"" . $headers[$ndx] . "\" value=\"" . $value2 . "\">";
                $ndx += 1;
              }
              $html .= "<td>";
              $html .= "<select id=\"ratemovie-select\" name=\"rating\">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>";
              $html .= "</td>";
              $html .= "<td><button id=\"ratemovie-submit\" type=\"submit\">Rate</button></td>";
              $html .= "</form></tr>";
            }
            $html .= "</table>";
            echo $html;
          }
        ?>
      </fieldset>

      <fieldset id="rec-movies">
        <legend>Recommended Movies</legend>
        <?php
          if( isset($_SESSION['movies']) && count($_SESSION['movies'])>=3 ){
            // run Recommendation alg and display Recommended movies
            $html = "<form id=\"recommend-movies\" action=\"recommendmovies.php\" method=\"post\">
              <button type=\"submit\">Get Recommendations</button>
            </form>";
            // echo $html;
            echo "<p>
              Sadly, we are unable to run our algorithm on the server our website is hosted on, due to resource limitations.  A sample is given below:<br>
              Rated movies:
              <ul>
                <li>The Dark Knight	5</li>
                <li>The Dark Knight Rises	5</li>
                <li>Batman Begins	5</li>
              </ul>
              Recommended movies:
              <ul>
                <li>Alone through Iran: 1144 miles of trust</li>
                <li>Las Vegas</li>
                <li>Jelita Sejuba: Mencintai Kesatria Negara</li>
                <li>Gold Stars: The Story of the FIFA World Cup Tournaments</li>
                <li>White Blessing</li>
                <li>Terbang: Menembus Langit</li>
                <li>Motorcycle Girl</li>
                <li>The Dark Knight</li>
                <li>The Dark Knight Rises</li>
                <li>Batman Begins</li>
              </ul>
            </p>";
          }
          else{
            echo "<div>Rate at least 3 movies to get recommendations.</div>";
          }
        ?>
      </fieldset>
    </main>

    <footer class="body-content">
      <?php echo printFooter(); ?>
    </footer>

  </body>
</html>
