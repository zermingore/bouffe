<html>
<?php
  include "header.php";
  echo "<pre>post:"; print_r($_POST); echo "</pre><hr/>";

  $db_file = "../db/db";
  $db = new SQLite3("$db_file");
  $h = new Helper($db_file);
?>
<body>


<?php
if (isset($_POST["user_name"]) && !empty($_POST["user_name"]))
{
  $user_name = $_POST["user_name"];
  echo "Inserting new user [$user_name]<br/>";

  $query = "INSERT INTO users('name') VALUES('" . $user_name . "');";
  $db->query($query);
}



include "footer.php";
?>

</body>
</html>
