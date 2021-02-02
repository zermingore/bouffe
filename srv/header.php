<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <?php
    session_start();
    if (!isset($_SESSION["language"]))
    {
      $_SESSION["language"] = "1";
    }

    include "helper.php";
  ?>
</head>
<br/>

</head>


<body>
  <?php echo "<a href=/index.html>home</a><br/>"; ?>

  <!-- Translation buttons -->
  <form method="post" action="srv/switch_language.php">
    <input type="submit" name="language" value="English">
    <input type="submit" name="language" value="Deutsch">
    <input type="submit" name="language" value="Français">
  </form>

  <hr/>
