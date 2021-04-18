<span>Nav-bar</span>
<nav>
  <a href="index.php">Index</a> |
  <?php
    if (isset($_SESSION["useruid"])) {
      echo "<a href='profile.php'>Profile Page</a> |";
      echo "<a href='logout.php'>Log Out</a>";
    } else {
      echo "<a href='signup.php'>Sign Up</a> |";
      echo "<a href='login.php'>Log In</a>";
    }
  ?>
</nav>
