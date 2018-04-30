<?php
  require("inc/inc.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>CSE 482 Project: Login</title>
    <link rel="stylesheet" href="CSS/styles.css" type="text/css">
  </head>

  <body>
    <header class="body-content">
      <?php echo printHeader(); ?>
    </header>

    <main class="body-content">
      <?php
        if( isset($_GET['e']) ){
          $html = "<div class=\"error\">";

          $e = $_GET['e'];
          if($e == 1){ $html .= "You must be logged in to access this page."; }
          if($e == 2){ $html .= "You have been logged out."; }

          $html .= "</div>";
          echo $html;
        }
      ?>

      <form id="login" action="authenticate.php" method="post">
        <fieldset>
          <legend>Existing User Login</legend>
          <?php
            // display errors from login
            if( isset($_GET['e']) ){
              $html = "<div class=\"error\">";

              $e = $_GET['e'];
              if($e == 11){ $html .= "User does not exist."; }
              if($e == 12){ $html .= "Incorrect password."; }

              $html .= "</div>";
              echo $html;
            }
          ?>
          <p id="form-username">
            Enter username: <input id="username" name="username" type="text">
          </p>

          <p id="form-password">
            Enter password: <input id="password" name="password" type="password">
          </p>

          <p id="form-submit">
            <button type="submit">Login</button>
          </p>
        </fieldset>
      </form>

      <br>

      <form id="add-new-user" action="adduser.php" method="post">
        <fieldset>
          <legend>Add New User</legend>
          <?php
            // display errors from login
            if( isset($_GET['e']) ){
              $html = "<div class=\"error\">";

              $e = $_GET['e'];
              if($e == 21){ $html .= "Please fill out all fields"; }
              if($e == 22){ $html .= "Passwords do not match."; }

              $html .= "</div>";
              echo $html;
            }
            else if( isset($_GET['u']) ){
              $html = "<div class=\"message\">User successfully added.</div>";
              echo $html;
            }
          ?>
          <p id="form2-username">
            Enter username: <input id="new-username" name="new-username" type="text">
          </p>

          <p id="form2-password">
            Enter password: <input id="new-password" name="new-password" type="password">
          </p>

          <p id="form2-password-confirm">
            Confirm password: <input id="new-password-confirm" name="new-password-confirm" type="password">
          </p>

          <p id="form2-submit">
            <button type="submit">Add User</button>
          </p>
        </fieldset>
      </form>
    </main>

    <footer class="body-content">
      <?php echo printFooter(); ?>
    </footer>
  </body>
</html>
