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

$lg = 1;
if (isset($_GET['lg']))
{
  $lg = $_GET['lg'];
  # TODO check language_table['$_GET['lg']'] exists
}


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
  . "'" . $name_id . "', '" . $summary_id . "', '"
  . $_POST['time_total'] . "', '" . $_POST['time_preparation'] . "', '"
  . $_POST['time_crafting'] . "', '" . $_POST['time_backing'] . "', '"
  . $_POST['difficulty'] . "', '" . $_POST['annoyance'] . "', '" . $_POST['threads'] . "', '"
  . $_POST['quantity']
  . "');";
print("query: $query");
$db->query($query);
$id_recipe = $db->lastInsertRowID();

$db_ingredients = $db->query("select * from words where id in (select id from ingredients)");

$ingredients = preg_split('/\n|\r/', $_POST['ingredients'], -1, PREG_SPLIT_NO_EMPTY);
foreach ($ingredients as $ingredient)
{
  $ingredient_found = 0;
  $db_ingredients->reset();
  while ($res = $db_ingredients->fetchArray())
  {
    if ($res['name'] == $ingredient)
    {
      $ingredient_found = 1;
      break;
    }
  }

  // Insert the ingredient name only if it does not exist yet
  if (!$ingredient_found)
  {
    print("Inserting not yet existing ingredient " . $ingredient . "<br/>");

    $query = "INSERT INTO words('name') VALUES('" . $ingredient . "');";
    $db->querySingle($query);
    $query = "INSERT INTO ingredients('id') VALUES('" . $db->lastInsertRowID() . "');";
    $db->querySingle($query);
  }
}


$steps = preg_split('/\n|\r/', $_POST['steps'], -1, PREG_SPLIT_NO_EMPTY);
$i = 0;
foreach ($steps as $step)
{
  $query = "INSERT INTO words('name') VALUES('" . $step . "');";
  $db->querySingle($query);

  $query = "INSERT INTO steps('id_language', 'id_recipe', 'num', 'description') VALUES('"
    . $lg . "', '" . $id_recipe
    . "', '" . $i . "', '" . $db->lastInsertRowID() . "');";
  $db->querySingle($query);

  ++$i;
}


$notes = preg_split('/\n|\r/', $_POST['notes'], -1, PREG_SPLIT_NO_EMPTY);
foreach ($notes as $note)
{
  $query = "INSERT INTO words('name') VALUES('" . $note . "');";
  $db->querySingle($query);

  $query = "INSERT INTO notes('id_language', 'id_recipe', 'description') VALUES('"
    . $lg . "', '" . $id_recipe
    . "', '" . $db->lastInsertRowID() . "');";
  $db->querySingle($query);
}

?>


</body>
</html>
