<html>
<body>


Recipe __<?php echo $_POST["name"]; ?>__<br?>

time total: <?php "time_total"?><br/>
time crafting: <?php "time_crafting"?><br/>
time backing: <?php "time_backing"?><br/>

Quantity: <?php echo $_POST["quantity"]?><br/>

Difficulty: <?php echo $_POST["difficulty"]?><br/>
Annoyance: <?php echo $_POST["annoyance"]?><br/>
Threads: <?php echo $_POST["threads"]?><br/>

Ingredients: <?php echo $_POST["ingredients"]?><br/>
Steps: <?php echo $_POST["steps"]?><br/>
Notes: <?php echo $_POST["notes"]?><br/>


<hr/>

<?php
$db_file = "../db/db";
$db = new SQLite3("$db_file");


// Insert the recipe name only if it does not exist yet
$query = "SELECT id FROM words WHERE name='" . $_POST['name'] . "';";
$name_id = $db->querySingle($query);
if (empty($name_id))
{
  $query = "INSERT INTO words('name') VALUES('" . $_POST['name'] . "');";
  $db->querySingle($query);
  $name_id=$db->lastInsertRowID();
}


// Insert the recipe summary only if it does not exist yet
$query = "SELECT id FROM words WHERE name='" . $_POST['summary'] . "';";
$summary_id = $db->querySingle($query);
if (empty($summary_id))
{
  $query = "INSERT INTO words('name') VALUES('" . $_POST['summary'] . "');";
  $db->querySingle($query);
  $summary_id=$db->lastInsertRowID();
}

// print_r($_POST);

$query = "INSERT INTO recipes(
  id_word,
  summary,
  time_total, time_preparation, time_crafting, time_backing,
  quantity, difficulty, annoyance, threads) VALUES("
  . $name_id . ", " . $summary_id . ", "
  . $_POST['time_total'] . ", " . $_POST['time_preparation'] . ", "
  . $_POST['time_crafting'] . ", " . $_POST['time_backing'] . ", "
  . $_POST['difficulty'] . ", " . $_POST['annoyance'] . ", " . $_POST['threads'] . ", "
  . $_POST['quantity']
  . ");";

print("query: $query");
$db->query($query);

?>


</body>
</html>
