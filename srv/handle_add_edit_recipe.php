<html>
<?php include "header.php"; echo "<pre>post:"; print_r($_POST); echo "</pre>";
?>
<body>


<?php
  if (!isset($_GET['id']))
  {
    echo("Add recipe");
    return;
  }
?>


<hr/>

<!-- TODO: (Re)Move the 'old' recipe -->

<?php
  $db_file = "../db/db";
  $db = new SQLite3("$db_file");


  // TODO Clean copy-pastes
  // Insert the recipe name / summary / origin only if they do not exist yet
  $query = "SELECT id FROM words WHERE name='" . $_POST['name_1'] . "';";
  $name_id = $db->querySingle($query);
  if (empty($name_id))
  {
    $str = $_POST['name_1'];
    if (empty($str))
    {
      // TODO no handy listing
      $str = "TR__" . $_POST['name_2'] . "__" . $_POST['name_3'];
    }
    $query = "INSERT INTO words('name') VALUES('" . $str . "');";
    $db->querySingle($query);
    $name_id=$db->lastInsertRowID();
  }

  $summary_id = $h->addWordAndOrTranslations(
    array($_POST["summary_1"], $_POST["summary_2"], $_POST["summary_3"]));

  $origin_id = $h->addWordAndOrTranslations(
    array($_POST["origin_1"], $_POST["origin_2"], $_POST["origin_3"]));


  $query = "REPLACE INTO recipes(
    id,
    id_word,
    summary,
    time_preparation, time_crafting, time_backing,
    quantity, difficulty, annoyance, threads, vegetarian, vegan, origin) VALUES("
    . "'" . $id_recipe . "', "
    . "'" . $name_id . "', '" . $summary_id . "', '"
    . $_POST['time_preparation'] . "', '"
    . $_POST['time_crafting'] . "', '" . $_POST['time_backing'] . "', '"
    . $_POST['difficulty'] . "', '" . $_POST['annoyance'] . "', '" . $_POST['threads'] . "', '"
    . $_POST['quantity'] . "', '" . $_POST['vegetarian'] . "', '" . $_POST['vegan'] . "', "
    . $origin_id . ");";
  $db->query($query);

  // Clear ingredients before adding the new ones
  $query = "DELETE FROM requirements WHERE id_recipe=$id_recipe;";
  $db->query($query);


  echo "Ingredients:<br/>";

  $db_ingredients = $db->query("SELECT * FROM words WHERE id IN (SELECT id FROM ingredients)");

  // TODO handle translations (searching by name...)
  for ($i = 1; $i <= count($_POST); $i++) // count($_POST) overkill but safe
  {
    if (!isset($_POST["ingredient_" . $i . "_name"]))
    {
      continue;
    }

    if (   !isset($_POST["ingredient_" . $i . "_qty"])
        || !isset($_POST["ingredient_" . $i . "_qty_unit"]))
    {
      echo "Ill-Formed ingredient:<br/>";
      echo "<pre>"; print_r($_POST); echo "</pre>";
      return;
    }

    $ingredient_name = $_POST["ingredient_" . $i . "_name"];
    $ingredient_found = 0;
    $db_ingredients->reset();
    while ($res = $db_ingredients->fetchArray())
    {
      if ($res['name'] == $ingredient_name)
      {
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
      "SELECT * FROM ingredients WHERE id IN (SELECT id FROM words WHERE name='"
      . $ingredient_name . "')");

    // Fetch the quantity unit id
    $quantity_unit_id = $db->querySingle(
      "SELECT * FROM units WHERE id_word IN (SELECT id FROM words WHERE name='"
      .  $_POST["ingredient_" . $i . "_qty_unit"] . "')");

    // Add the requirement
    $query =
      "INSERT INTO requirements('id_recipe', 'id_ingredient', 'quantity', 'id_unit') VALUES('"
      . $id_recipe . "','" . $ingredient_id . "', '"
      . $_POST["ingredient_" . $i . "_qty"] . "', '" . $quantity_unit_id . "');";
    $res = $db->query($query);

    if ($_POST["ingredient_" . $i . "_qty_unit"] != "-")
    {
      echo $ingredient_name . " (". $_POST["ingredient_" . $i . "_qty"]
      . " ". $_POST["ingredient_" . $i . "_qty_unit"] . ")<br/>";
    }
    else
    {
      echo $_POST["ingredient_" . $i . "_qty"] . " " . $ingredient_name . "<br/>";
    }
  }



  $types = ["steps", "notes"];
  foreach ($types as $type)
  {
    // Clear related entries before adding the new ones
    $query = "DELETE FROM $type WHERE id_recipe=$id_recipe;";
    $db->query($query);

    $word_ids = array(); // Keeping track of words index
    for ($lg_idx = 1; $lg_idx <= 3; $lg_idx++)
    {
      $items = preg_split(
        '/\n|\r/', $_POST[$type . '_' . $lg_idx], -1, PREG_SPLIT_NO_EMPTY);
      $i = 1;
      foreach ($items as $item)
      {
        if ($lg_idx == 1)
        {
          $query = "INSERT INTO words('name') VALUES('" . $item . "');";
          $db->querySingle($query);
          array_push($word_ids, $db->lastInsertRowID());
        }
        else
        {
          $query = "INSERT INTO translations('id_language', 'id_word', 'name') "
            . "VALUES('" . $lg_idx . "', '". $word_ids[$i - 1] . "', '" . $item . "');";
          $db->querySingle($query);
        }

        if ($type == "steps")
        {
          $query = "INSERT INTO " . $type
            . " ('id_language', 'id_recipe', 'num', 'description') VALUES('"
            . $lg_idx . "', '" . $id_recipe
            . "', '" . $i . "', '" . $word_ids[$i - 1] . "');";
        }
        elseif ($type == "notes")
        {
          $query = "INSERT INTO notes('id_language', 'id_recipe', 'description') VALUES('"
            . $lg_idx . "', '" . $id_recipe
            . "', '" . $word_ids[$i - 1] . "');";
        }
        else
        {
          echo("[IMPLEMENTATION ERROR] Invalid type [" . $type . "]<br/>");
          return;
        }

        $db->querySingle($query);
        ++$i;
      }
    }
  }



  include "footer.php";
?>


</body>
</html>
