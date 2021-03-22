  <hr/>

  <!-- Translation buttons -->
  <?php
    $get = "";
    $delim = "?"; // URL arguments delimiter
    foreach ($_GET as $p => $val)
    {
      $get = $get . $delim . $p . "=" . $val;
      $delim = "&";
    }

    echo("<form method='post' action='/srv/switch_language.php?src="
         . $_SERVER['PHP_SELF'] . $get . "'>");
  ?>
    <input type="submit" name="language" value="English">
    <input type="submit" name="language" value="Deutsch">
    <input type="submit" name="language" value="Français">
  </form>

  <?php
    $p = dirname(__FILE__);
    $db_file = "$p/../db/db";
    $db = new SQLite3("$db_file");
    $h = new Helper($db_file);
    echo "<a href=/index.html>" . $h->fetchWord("Home") . "</a><br/>";
  ?>

</body>
