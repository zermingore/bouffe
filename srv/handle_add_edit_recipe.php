<html>
<?php
  include "header.php";
  echo "<pre>post:"; print_r($_POST); echo "</pre><hr/>";
?>
<body>


<?php
  $g_language = $_SESSION["language"];
  if (!isset($_GET['id']) || $_GET['id'] == 0)
  {
    echo("Add recipe<br/>");
    $g_mode_edit = false;
  }
  else
  {
    echo("Edit recipe " . $_GET['id'] . "<br/>");
    $g_mode_edit = true;
  }

  $db_file = "../db/db";
  $db = new SQLite3("$db_file");
  $h = new Helper($db_file);


  // Insert the recipe name / summary / origin only if they do not exist yet
  $name_id = $h->addWordAndOrTranslations(
    array($_POST["name_1"], $_POST["name_2"], $_POST["name_3"]));

  $summary_id = $h->addWordAndOrTranslations(
    array($_POST["summary_1"], $_POST["summary_2"], $_POST["summary_3"]));

  $origin_id = $h->addWordAndOrTranslations(
    array($_POST["origin_1"], $_POST["origin_2"], $_POST["origin_3"]));


  $common_fields = "id_word, summary,
    time_preparation, time_crafting, time_backing, quantity,
    difficulty, annoyance, threads, vegetarian, vegan, origin";

  $common_values = "'" . $name_id . "', '" . $summary_id . "', '"
    . $_POST['time_preparation'] . "', '"
    . $_POST['time_crafting'] . "', '" . $_POST['time_backing'] . "', '"
    . $_POST['quantity'] . "', '"
    . $_POST['difficulty'] . "', '" . $_POST['annoyance'] . "', '"
    . $_POST['threads'] . "', '"
    . $_POST['vegetarian'] . "', '" . $_POST['vegan'] . "', '"
    . $origin_id . "'";

  if ($g_mode_edit)
  {
    $id_recipe = $_GET['id'];

    $query = "REPLACE INTO recipes(id, " . $common_fields . ") VALUES("
      . "'" . $id_recipe . "', " . $common_values . ");";
    if (!$db->query($query))
    {
      echo("Issue in recipe replacement; request:<br/>" . $query . "<br/>");
    }

    // Clear ingredients before adding the new ones
    $query = "DELETE FROM requirements WHERE id_recipe=$id_recipe;";
    $db->query($query);
  }
  else
  {
    $query = "INSERT INTO recipes(" . $common_fields . ") VALUES("
        . $common_values . ");";
    $db->query($query);
    $id_recipe = $db->lastInsertRowID();
  }


  echo "Ingredients:<br/>";

  // Always refering to default language for the ingredients
  $db_ingredients = $db->query(
    "SELECT * FROM words WHERE id IN (SELECT id FROM ingredients);");

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
    $ingredient_qty_unit = $_POST["ingredient_" . $i . "_qty_unit"];

    // Fetch the default language ingredient name and quantity
    if ($g_language != 1)
    {
      $sections = [$ingredient_name, $ingredient_qty_unit];
      foreach ($sections as $section)
      {
        $id_word = $h->fetchWordFromTranslation($section);
        if (!$id_word)
        {
          // Insert a place-holder in the words table (and add the ingredient)
          $id_word = $h->fetchWordFromTranslation($section, true);
          if (!$id_word)
          {
            echo("Cannot fetch / insert [$section]<br/>");
            echo("Query: [$query]<br/>");
            continue;
          }
        }

        $query = "SELECT name FROM words WHERE id='$id_word'";
        $name = $db->querySingle($query);
        if (!$name)
        {
          echo("Cannot fetch / insert [$section]<br/>");
          echo("Query: [$query]<br/>");
          continue;
        }

        if ($section == $ingredient_name)
        {
          $ingredient_name = $name;
          $ingredient_id = $id_word;
        }
        else
        {
          $ingredient_qty_unit = $name;
        }
      }
    }
    else
    {
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
        $query = "INSERT INTO words('name') VALUES('$ingredient_name');";
        $db->querySingle($query);
        $id_word = $db->lastInsertRowID();

        $query = "INSERT INTO ingredients('id') VALUES('$id_word');";
        echo("$query");
        $db->querySingle($query);
        $ingredient_id = $id_word;
      }
    }

    echo("Ingredient data: [$ingredient_name] [$ingredient_qty_unit]<br/>");


    // Fetch the ingredient id
    if (!isset($ingredient_id) || empty($ingredient_id))
    {
      $ingredient_id = $db->querySingle(
        "SELECT * FROM ingredients WHERE id IN (SELECT id FROM words WHERE "
        . "name='$ingredient_name')");
    }


    // Fetch the quantity unit id
    $quantity_unit_id = $db->querySingle(
      "SELECT * FROM units WHERE id_word IN "
      . "(SELECT id FROM words WHERE name='" . $ingredient_qty_unit . "')");

    // Add the requirement
    $query = "INSERT INTO requirements("
      . "'id_recipe', 'id_ingredient', 'quantity', 'id_unit') VALUES('"
      . $id_recipe . "','" . $ingredient_id . "', '"
      . $_POST["ingredient_" . $i . "_qty"] . "', '"
      . $quantity_unit_id . "');";
    if ($db->query($query) == False)
    {
      echo("Error inserting requirement<br/>" . $query . "<br/>");
      continue;
    }

    if ($ingredient_qty_unit != "-")
    {
      echo($ingredient_name . " (". $_POST["ingredient_" . $i . "_qty"]
      . " ". $ingredient_qty_unit . ")<br/>");
    }
    else
    {
      echo($_POST["ingredient_" . $i . "_qty"]
        . " " . $ingredient_name . "<br/>");
    }

    unset($ingredient_id);
  }


  $types = ["steps", "notes"];
  foreach ($types as $type)
  {
    if ($g_mode_edit)
    {
      // Clear related entries before adding the new ones
      $query = "DELETE FROM $type WHERE id_recipe=$id_recipe;";
      $db->query($query);
    }

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
          $query = "INSERT INTO translations("
            . "'id_language', 'id_word', 'name') VALUES('"
            . $lg_idx . "', '". $word_ids[$i - 1] . "', '" . $item . "');";
          if (!$db->querySingle($query))
          {
            echo("Issue inserting translation; request:<br/>" . $query . "<br/>");
          }
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
          $query = "INSERT INTO " . $type
            . "('id_language', 'id_recipe', 'description') VALUES('"
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
