<?php
  include_once 'header.php';
?>

<main>
  <h1>Sign-Up</h1>
  <form action='includes/signup.inc.php' method="post">
    <input type="text" name="name" placeholder="Name...">
    <input type="text" name="uid" placeholder="Username...">
    <input type="password" name="pwd" placeholder="Password...">
    <input type="password" name="pwdrepeat" placeholder="Repeat password...">
    <input type="text" name="email" placeholder="Email...">
    <button type="submit" name="submit">Sign up</button>
  </form>

  <?php
    if (isset($_GET["error"])) {
      switch ($_GET["error"]) {
        case "emptyinput":
          echo "<p>Please fill in all fields.</p>";
          break;
        case "invaliduid":
          echo "<p>Choose valid username.</p>";
          break;
        case "invalidemail":
          echo "<p>Choose valid email address.</p>";
          break;
        case "passwordsnotmatching":
          echo "<p>Passwords don't match.</p>";
          break;
        case "usernametaken":
          echo "<p>Username taken - please try another.</p>";
          break;
        case "stmtfailed":
          echo "<p>Something went wrong - please try again.</p>";
          break;
        case "none":
          echo "<p>Sign-up complete.</p>";
          break;
        default:
          break;
      }
    }
  ?>

</main>



<?php
  include_once 'footer.php';
?>
