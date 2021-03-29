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

  $summary_id = $h->addWordAndOrTranslations(
    array($_POST["summary_1"], $_POST["summary_2"], $_POST["summary_3"]));

  $origin_id = $h->addWordAndOrTranslations(
    array($_POST["origin_1"], $_POST["origin_2"], $_POST["origin_3"]));

  $query = "INSERT INTO recipes(
    id_word,
    summary,
    time_preparation, time_crafting, time_backing, quantity,
    difficulty, annoyance, threads, vegetarian, vegan, origin) VALUES("
    . "'" . $name_id . "', '" . $summary_id . "', '"
    . $_POST['time_preparation'] . "', '"
    . $_POST['time_crafting'] . "', '" . $_POST['time_backing'] . "', '"
    . $_POST['difficulty'] . "', '" . $_POST['annoyance'] . "', '"
    . $_POST['threads'] . "', '" . $_POST['quantity'] . ", "
    . $_POST['vegetarian'] . ", " . $_POST['vegan'] . ", "
    . $origin_id . "');";
  $db->query($query);
  $id_recipe = $db->lastInsertRowID();


  echo "Ingredients:<br/>";
  $db_ingredients;
  if ($_SESSION["language"] == "1")
  {
    $db_ingredients = $db->query("SELECT * FROM words WHERE id IN (SELECT id FROM ingredients);");
  }
  else
  {
    $db_ingredients = $db->query(
        "SELECT * FROM translations WHERE id_language = " . $_SESSION['language']
      . " AND id_word IN (SELECT id FROM ingredients);");
  }

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
    $id_word = -1;
    while ($res = $db_ingredients->fetchArray())
    {
      if ($res['name'] == $ingredient_name)
      {
        $id_word = $res['id_word'];

        $ingredient_found = 1;
        break;
      }
    }

    // Insert the ingredient name only if it does not exist yet
    if (!$ingredient_found)
    {
      if ($_SESSION["language"] == "1")
      {
        $query = "INSERT INTO words('name') VALUES('" . $ingredient_name . "');";
        $db->querySingle($query);
        $query = "INSERT INTO ingredients('id') VALUES('" . $db->lastInsertRowID() . "');";
        $db->querySingle($query);
      }
      else
      {
        if ($id_word != -1) // word found based on its translation
        {
          $query = "INSERT INTO translations('id_language', 'id_word', 'name') VALUES('"
            . $_SESSION["language"] . "' '" . $id_word . "' '" . $ingredient_name . "');";
        }
        else
        {
          // Word not found; add a place-holder based on its translation in 'words'
          $query = "INSERT INTO words('name') VALUES('TR__" . $ingredient_name . "');";
        }
        $db->querySingle($query);
        $id_word = $db->lastInsertRowID();

        $query = "INSERT INTO ingredients('id') VALUES('" . $id_word . "');";
        $db->querySingle($query);
      }

      $ingredient_id = $db->lastInsertRowID();
    }


    // Fetch the ingredient id
    if (!isset($ingredient_id))
    {
      $ingredient_id = $db->querySingle(
        "SELECT * FROM ingredients WHERE id IN (SELECT id FROM words WHERE "
        . "name='" . $ingredient_name . "' or name='TR__" . $ingredient_name . "')");
    }

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


  // TODO place-holder if one translation array is larger than the default language one

  $types = ["steps", "notes"];
  foreach ($types as $type)
  {
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
