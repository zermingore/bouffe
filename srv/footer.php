  <hr/>

  <!-- Translation buttons -->
  <form method="post" action="/srv/switch_language.php">
    <input type="submit" name="language" value="English">
    <input type="submit" name="language" value="Deutsch">
    <input type="submit" name="language" value="Français">
  </form>

  <?php
    $p = dirname(__FILE__);
    $db_file = "$p/../db/db";
    $db = new SQLite3("$db_file");
    $h = new Helper($db_file);
    echo "<a href=/index.html>" . $h->fetchWord("home") . "</a><br/>";
  ?>

</body>
