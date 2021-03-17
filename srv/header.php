<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="icon" href="/custom/favicon.png">

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


<body>
<?php
    $p = dirname(__FILE__);
    $db_file = "$p/../db/db";
    $db = new SQLite3("$db_file");
    $h = new Helper($db_file);
    echo "<a href=/index.html>" . $h->fetchWord("Home") . "</a><br/>";
  ?>

  <!-- Translation buttons -->
  <form method="post" action="/srv/switch_language.php">
    <input type="submit" name="language" value="English">
    <input type="submit" name="language" value="Deutsch">
    <input type="submit" name="language" value="Français">
  </form>

  <hr/>
