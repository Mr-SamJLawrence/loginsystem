<?php
  include_once 'header.php';
?>

<main>
  <h1>Log In</h1>
  <form action='includes/login.inc.php' method="post">
    <input type="text" name="uid" placeholder="Username/Email...">
    <input type="password" name="pwd" placeholder="Password...">
    <button type="submit" name="submit">Log In</button>
  </form>

  <?php
    if (isset($_GET["error"])) {
      switch ($_GET["error"]) {
        case "emptyinput":
          echo "<p>Please fill in all fields.</p>";
          break;
        case "wronglogina":
          echo "<p>Incorrect login A.</p>";
          break;
        case "wrongloginb":
          echo "<p>Incorrect login B.</p>";
          break;
        case "none":
          echo "<p>Logged in.</p>";
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
