<html>
<?php include "header.php"; ?>
<body>


Recipe __<?php echo($_POST["name_" . $_SESSION['language']]); ?>__<br/>

time crafting: <?php "time_crafting"?><br/>
time backing: <?php "time_backing"?><br/>

Quantity: <?php echo $_POST["quantity"]?><br/>

Difficulty: <?php echo $_POST["difficulty"]?><br/>
Annoyance: <?php echo $_POST["annoyance"]?><br/>
Threads: <?php echo $_POST["threads"]?><br/>

Steps: <?php echo $_POST["steps_" . $_SESSION['language']]?><br/>
Notes: <?php echo $_POST["notes_" . $_SESSION['language']]?><br/>

<?php echo "<pre>"; print_r($_POST); echo "</pre>"; ?>

<hr/>

<?php
  $db_file = "../db/db";
  $db = new SQLite3("$db_file");
  $h = new Helper($db_file);

  $name_id = $h->addWordAndOrTranslations(
    array($_POST["name_1"], $_POST["name_2"], $_POST["name_3"]));

  // Insert the recipe summary only if it does not exist yet
  $query = "SELECT id FROM words WHERE name='" . $_POST['summary'] . "';";
  $summary_id = $db->querySingle($query);
  if (empty($summary_id))
  {
    $query = "INSERT INTO words('name') VALUES('" . $_POST['summary'] . "');";
    $db->querySingle($query);
    $summary_id=$db->lastInsertRowID();
  }

  $query = "INSERT INTO recipes(
    id_word,
    summary,
    time_preparation, time_crafting, time_backing,
    quantity, difficulty, annoyance, threads) VALUES("
    . "'" . $name_id . "', '" . $summary_id . "', '"
    . $_POST['time_preparation'] . "', '"
    . $_POST['time_crafting'] . "', '" . $_POST['time_backing'] . "', '"
    . $_POST['difficulty'] . "', '" . $_POST['annoyance'] . "', '" . $_POST['threads'] . "', '"
    . $_POST['quantity']
    . "');";
  $db->query($query);
  $id_recipe = $db->lastInsertRowID();


  echo "Ingredients:<br/>";
  $db_ingredients;
  if ($_SESSION["language"] == "1")
  {
    $db_ingredients = $db->query("SELECT * FROM words WHERE id IN (SELECT id FROM ingredients);");
    echo("<pre>"); print_r($db_ingredients); echo("</pre>");
  }
  else
  {
    echo("else");
    $db_ingredients = $db->query(
        "SELECT * FROM translations WHERE id_language = " . $_SESSION['language']
      . " AND id_word IN (SELECT id FROM ingredients);");
  }

  echo("<pre>"); print_r($db_ingredients); echo("</pre>");

  // TODO handle translations (searching by name...)
  for ($i = 1; $i <= count($_POST); $i++)
  {
    if (!isset($_POST["ingredient_" . $i . "_name"]))
    {
      continue;
    }

    if (!isset($_POST["ingredient_" . $i . "_qty"]) || !isset($_POST["ingredient_" . $i . "_qty_unit"]))
    {
      echo "Ill-Formed ingredient:<br/>";
      echo "<pre>"; print_r($_POST); echo "</pre>";
      return;
    }


    $ingredient_name = $_POST["ingredient_" . $i . "_name"];
    $ingredient_found = 0;
    $db_ingredients->reset();
    echo("<pre>"); print_r($db_ingredients); echo("</pre>");
    while ($res = $db_ingredients->fetchArray())
    {
      if ($res['name'] == $ingredient_name)
      {
        // echo $_POST["ingredient_" . $i . "_name"] . " already in DB!<br/>";

        $ingredient_found = 1;
        break;
      }
    }

    // Insert the ingredient name only if it does not exist yet
    if (!$ingredient_found)
    {
      $query = "INSERT INTO words('name') VALUES('" . $ingredient_name . "');";
      $db->querySingle($query);
      $query = "INSERT INTO ingredients('id') VALUES('" . $db->lastInsertRowID() . "');";
      $db->querySingle($query);
    }


    // Fetch the ingredient id
    $ingredient_id = $db->querySingle(
      "SELECT * FROM ingredients WHERE id IN (SELECT id FROM words WHERE name='" . $ingredient_name . "')");

    // Fetch the quantity unit id
    $quantity_unit_id = $db->querySingle(
      "SELECT * FROM units WHERE id_word IN (SELECT id FROM words WHERE name='" . $_POST["ingredient_" . $i . "_qty_unit"] . "')");

    // Add the requirement
    $query = "INSERT INTO requirements('id_recipe', 'id_ingredient', 'quantity', 'id_unit') VALUES('"
      . $id_recipe . "','" . $ingredient_id . "', '" . $_POST["ingredient_" . $i . "_qty"] . "', '" . $quantity_unit_id . "');";
    $db->query($query);


    if ($_POST["ingredient_" . $i . "_qty_unit"] != "-")
    {
      echo $ingredient_name . " (". $_POST["ingredient_" . $i . "_qty"] . " ". $_POST["ingredient_" . $i . "_qty_unit"] . ")<br/>";
    }
    else
    {
      echo $_POST["ingredient_" . $i . "_qty"] . " " . $ingredient_name . "<br/>";
    }
  }



  $steps = preg_split('/\n|\r/', $_POST['steps'], -1, PREG_SPLIT_NO_EMPTY);
  $i = 1;
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




  // Translations handling

  $steps = preg_split('/\n|\r/', $_POST['steps'], -1, PREG_SPLIT_NO_EMPTY);
  $i = 1;
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




  include "footer.php";
?>


</body>
</html>
