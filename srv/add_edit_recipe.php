<html>
<body>

<?php
  include "header.php";

  $db_file = "../db/db";
  $db = new SQLite3("$db_file");
  $h = new Helper($db_file);

  $g_mode_edit = isset($_GET['id']);

  if ($g_mode_edit)
  {
    // Fetch recipe
    $recipe_id = $_GET['id'];
    $query = "SELECT * FROM recipes WHERE id=" . $recipe_id . ";";
    $recipe = $db->querySingle($query, true);

    // Sanity check
    if (!$recipe['id'])
    {
      print("Unable to find the recipe id:" . $recipe_id . "<br/>");
      return;
    }

    // Recipe data
    $name = "";
    if (isset($recipe["id_word"]))
    {
      // Fetch recipe name
      $query = "SELECT name FROM words WHERE id={$recipe['id_word']};";
      $tmp = $db->querySingle($query, true)['name'];
      $name = $h->fetchWord($tmp);
    }

    $summary = "";
    if (isset($recipe["summary"]))
    {
      $query = "SELECT name FROM words WHERE id={$recipe['summary']};";
      $summary = $db->querySingle($query, true)['name'];
    }

    $time_preparation = $recipe["time_preparation"];
    $time_crafting = $recipe["time_crafting"];
    $time_backing = $recipe["time_backing"];

    $quantity = $recipe["quantity"];
    $quantity_unit = $recipe["quantity_unit"];

    $difficulty = $recipe["difficulty"];
    $annoyance = $recipe["annoyance"];
    $threads = $recipe["threads"];


    echo("<h1>" . $h->fetchWord("edit") . ": $name</h1>");
  }
  else
  {
    $recipe_id = 0;
    $name = "";
    $summary = "";
    $origin = "";

    $time_preparation = "";
    $time_crafting = "";
    $time_backing = "";

    $quantity = "";
    $quantity_unit = "";

    $difficulty = "3";
    $annoyance = "3";
    $threads = "1";

    echo("<h1>" . $h->fetchWord("Add a recipe") . "</h1>");
  }
?>


<form name="mainForm"
      method="post"
      action="<?php echo("handle_add_edit_recipe.php?id=$recipe_id"); ?>"
      onsubmit="return validateForm()">

  <hr/>
  <?php
    $short = ": <input type='text' name=";
    echo($h->fetchWord("Name") . "$short'name_" . $_SESSION["language"]
         . "' value='" .  $name . "'><br/>");
    echo($h->fetchWord("Summary") . "$short'summary_" . $_SESSION["language"]
         . "' value='$summary'>");
  ?>

  <br/><br/>
  <?php
    echo("<h3>" . $h->fetchWord("Time") . "</h3>");
    echo($h->fetchWord("Time preparation") . "$short'time_preparation' value='$time_preparation'><br/>");
    echo($h->fetchWord("Time crafting") . "$short'time_crafting' value='$time_crafting'><br/>");
    echo($h->fetchWord("Time backing") . "$short'time_backing' value='$time_backing'><br/>");
  ?>


  <br/><br/>
  <?php echo("<h3>" . $h->fetchWord("Metadata") . "</h3>"); ?>
  <?php
    function addInputField($i, $name, $check)
    {
      $i > 5 ? $value = "5+" : $value = $i;

      if ($i == $check)
        echo('<input type="radio" name="' . $name . '" value="' . $i . '" checked="true">' . $value);
      else
        echo('<input type="radio" name="' . $name . '" value="' . $i . '">' . $value);
    }


    echo($h->fetchWord("Difficulty") . "<br/>");
    for ($i = 1; $i < 7; $i++)
    {
      addInputField($i, "difficulty", $difficulty);
    }

    echo("<br/><br/>");
    echo($h->fetchWord("Annoyance") . "<br/>");
    for ($i = 1; $i < 7; $i++)
    {
      addInputField($i, "annoyance", $annoyance);
    }

    echo("<br/><br/>");
    echo($h->fetchWord("Ideal number of cooks") . "<br/>");
    for ($i = 1; $i < 7; $i++)
    {
      addInputField($i, "threads", $threads);
    }
    echo("<br/>");


    echo("<br/><br/>");
    $checkbox_names = [ "Vegetarian", "Vegan" ];
    foreach ($checkbox_names as $chk_name)
    {
      $check = "";
      if (isset($recipe[$chk_name]) && $recipe[$chk_name] == true)
      {
        $check = "checked='true'";
      }
      echo('<input name="' . strtolower($chk_name) . '" value="0" type="hidden">');
      echo('<input name="' . strtolower($chk_name) . '" type="checkbox" id="'
           . $chk_name . '" ' . $check . ' onclick="' . $chk_name . 'Check()">');
      echo('<label for="' . $chk_name . '">' . $h->fetchWord($chk_name) . "</label><br/>");
    }
    echo("<br/><br/>");


    $origin = "";
    if (isset($recipe["id_word"]))
    {
      // Fetch recipe name
      $query = "SELECT name FROM words WHERE id={$recipe['origin']};";
      $tmp = $db->querySingle($query, true)['name'];
      $origin = $h->fetchWord($tmp);
    }

    echo($h->fetchWord("Origin")
        . ": <input type='text' name='origin_" . $_SESSION["language"]
        . "' value='" .  $origin . "'><br/>");
  ?>

  <script src=js/checkboxes.js>
  </script>

  <br/><br/>
  <?php
    echo($h->fetchWord("For") . "$short'quantity' value='$quantity'>");
    echo("$quantity_unit<br/>");
  ?>

  <br/><br/>
  <hr/>
  <?php echo("<h2>" . $h->fetchWord("Ingredients") . "</h2>"); ?>

  <div>
    <div id="g_ingredients_container"/>

    <script type='text/javascript'>
      var g_ingredients_number = 0; // global
      var g_ingredients_container = document.getElementById("g_ingredients_container");
      var g_max_ingredients = 30;


      function removeIngredient(id)
      {
        if (g_ingredients_number < 1)
        {
          return;
        }

        document.getElementById("ingredient_container_" + id).remove();
        g_max_ingredients--;
      }


      function addIngredientField(quantity, unit_str, name)
      {
        if (g_ingredients_number > g_max_ingredients - 1)
        {
          alert("Too many ingredients (max: " + g_max_ingredients + ")");
          return;
        }

        g_ingredients_number++;
        var current_id = g_ingredients_number;
        var ingredient_container = g_ingredients_container.appendChild(document.createElement("div"));
        ingredient_container.id = "ingredient_container_" + current_id;

        ingredient_container.appendChild(document.createElement("br"));

        // Append a node
        var prefix = "ingredient_" + g_ingredients_number;
        var ingredient = ingredient_container.appendChild(document.createTextNode(prefix));

        // Quantity <input> element
        var ingredient_qty = document.createElement("input");
        ingredient_qty.type = "text";
        ingredient_qty.name = "ingredient_" + g_ingredients_number + "_qty";
        if (quantity)
        {
          ingredient_qty.value = quantity;
        }
        ingredient_container.appendChild(ingredient_qty);

        // Quantity unit <select> element
        var ingredient_unit = document.createElement("select");
        ingredient_unit.type = "text";
        ingredient_unit.name = prefix + "_qty_unit";
        var unit = ingredient_container.appendChild(ingredient_unit);

        quantity_list = <?php
          $db_file = "../db/db";
          $db = new SQLite3("$db_file");

          $id_unit_ingredient = $db->querySingle("SELECT id FROM words WHERE name='unit_ingredient'");
          $id_unit_none = $db->querySingle("SELECT id FROM words WHERE name='unit_none'");

          if (!isset($_SESSION["language"]) || $_SESSION["language"] == "1")
          {
            $query = "SELECT * FROM words WHERE"
            . " id IN (SELECT id_word FROM units WHERE (id_type="
            . $id_unit_ingredient . " OR id_type=" . $id_unit_none . "))";
          }
          else
          {
            $query = "SELECT * FROM translations WHERE id_language="
            . $_SESSION["language"]
            . " AND id_word IN (SELECT id_word FROM units WHERE (id_type="
            . $id_unit_ingredient . " OR id_type=" . $id_unit_none . "))";
          }

          $list = $db->query($query);
          $list->reset();

          $txt = [];
          while ($res = $list->fetchArray())
          {
            $txt[] = $res['name'];
          }

          echo json_encode($txt);
        ?>;


        for (x in quantity_list)
        {
          quantity = document.createElement("option");
          quantity.value = quantity_list[x];
          quantity.label = quantity_list[x];

          if (unit_str == quantity.value)
            quantity.selected = "selected";
          unit.appendChild(quantity);
        }


        // Name <input> element
        var ingredient_name = document.createElement("input");
        ingredient_name.type = "text";
        ingredient_name.name = prefix + "_name";
        if (name)
        {
          ingredient_name.value = name;
        }
        ingredient_container.appendChild(ingredient_name);

        var removeButton = document.createElement("button");
        removeButton.innerText = " x ";
        removeButton.type = "button"; // Do not submit the form
        removeButton.onclick = function() { removeIngredient(current_id) };
        ingredient_container.appendChild(removeButton);
      }
    </script>

    <button type="button" id="filldetails" onclick="addIngredientField()">
      <?php echo($h->fetchWord("Add an ingredient")); ?>
      <br/>
    </button>

    <!-- Ingredients header (TODO CSS) -->
    <div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?php
        echo($h->fetchWord("Quantity") . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
        echo($h->fetchWord("Unit") . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
        echo($h->fetchWord("Name") . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
      ?>
      <hr/>
    </div>


    <!-- Add already existing ingredients -->
    <?php
    $id_unit_ingredient = $db->querySingle("SELECT id FROM words WHERE name='unit_ingredient'");
    $id_unit_none = $db->querySingle("SELECT id FROM words WHERE name='unit_none'");

    if (!isset($_SESSION["language"]) || $_SESSION["language"] == "1")
    {
      $query = "SELECT * FROM words WHERE"
      . " id IN (SELECT id_word FROM units WHERE (id_type="
      . $id_unit_ingredient . " OR id_type=" . $id_unit_none . "))";
    }
    else
    {
      $query = "SELECT * FROM translations WHERE id_language="
      . $_SESSION["language"]
      . " AND id_word IN (SELECT id_word FROM units WHERE (id_type="
      . $id_unit_ingredient . " OR id_type=" . $id_unit_none . "))";
    }

    $units_list = $db->query($query);
    $units_list->reset();

    // Fetch ingredients from 'requirements' table
    $query = "SELECT * FROM requirements WHERE id_recipe={$recipe_id};";
    $result = $db->query($query);
    while ($requirement = $result->fetchArray())
    {
      $query = "SELECT name FROM words WHERE id={$requirement['id_ingredient']};";
      $ingredient_name = $db->querySingle($query);
      $ingredient_name = $h->fetchWord($ingredient_name);

      if ($requirement['id_unit'] != "")
      {
        $query = "SELECT id_word FROM units WHERE id={$requirement['id_unit']};";
        $id_symbol = $db->querySingle($query);

        $query_name = "SELECT name FROM words WHERE id={$id_symbol};";
        $unit_name = $db->querySingle($query_name);

        $unit_name = $h->fetchWord($unit_name);
      }

      echo("<script> addIngredientField("
        . "'" . $requirement['quantity'] . "', "
        . "'" . $unit_name . "', "
        . "'" . $ingredient_name . "'); </script>");
    }
  ?>
  </div>


  <br/><br/>
  <hr/>


  <!-- Instructions steps -->
  <?php
    $word_step = $h->fetchWord("Steps");

    $query = "SELECT * FROM steps WHERE id_recipe={$recipe_id}; ORDER BY num";
    $result = $db->query($query);
    print("<h2>$word_step</h2>");
    print("<ul>");
    $steps = "";
    while ($step = $result->fetchArray())
    {
      $query = "SELECT name FROM words WHERE id={$step['description']};";
      $description = $db->querySingle($query);

      // fancy display; use later with steps re-ordering support
      // echo("<input type='text' name=step_{$step['num']} value='". $description . "'><br/>");
      $steps = $steps . $description . "\n";
    }
    print("</ul>");

    echo($h->fetchWord("1 per line") . "<br/>");
    echo("<textarea name='steps_" . $_SESSION['language']
         . "' rows='5' cols='80'>" . $steps . "</textarea><br/>");
  ?>


  <!-- Notes -->
  <br/><br/>
  <hr/>
  <?php
    $word_note = $h->fetchWord("Notes");

    $query = "SELECT * FROM notes WHERE id_recipe={$recipe_id}; ORDER BY num";
    $result = $db->query($query);
    print("<h2>$word_note</h2>");
    print("<ul>");
    $notes = "";
    while ($note = $result->fetchArray())
    {
      $query = "SELECT name FROM words WHERE id={$note['description']};";
      $description = $db->querySingle($query);

      // fancy display; use later with notes re-ordering support
      // echo("<input type='text' name=note_{$note['num']} value='". $description . "'><br/>");
      $notes = $notes . $description . "\n";
    }
    print("</ul>");

    echo($h->fetchWord("1 per line") . "<br/>");
    echo("<textarea name='notes_" . $_SESSION['language']
         . "' rows='5' cols='80'>" . $notes . "</textarea><br/>");
  ?>


  <br/><br/>
  <hr/>
  <?php
    if ($g_mode_edit)
    {
      echo("<input type='submit' value='" . $h->fetchWord("Edit the recipe") . "'>");
    }
    else
    {
      echo("<input type='submit' value='" . $h->fetchWord("Add the recipe") . "'>");
    }
  ?>

  <br/><br/>
  <hr/>
  <?php
    echo("<h3>" . $h->fetchWord("Translations") . "</h3>");
    $languages = $h->getLanguages();

    // TODO: Avoid copy-pastes
    // $sections = [ "Name", "Summary" ];

    $query = "SELECT name FROM words WHERE id={$recipe_id};";

    if ($g_mode_edit)
    {
      $translations = $h->fetchTranslations($db->querySingle($query, true)['name']);
    }
    $word_translations = $h->fetchTranslations("Name");
    for ($i = 1; $i <= 3; $i++)
    {
      if ($_SESSION['language'] == $i)
      {
        continue;
      }

      $tr = "";
      if (isset($translations) && isset($translations[$i]))
      {
        $tr = $translations[$i];
      }
      echo($word_translations[$i] . " ($languages[$i]): "
           . "<input type='text' name='name_$i' value='" . $tr . "'><br/>");
    }
    echo("<br/>");


    if (isset($recipe['summary']))
    {
      $query = "SELECT name FROM words WHERE id={$recipe['summary']};";
      $translations = $h->fetchTranslations($db->querySingle($query, true)['name']);
    }
    $word_translations = $h->fetchTranslations("Summary");
    for ($i = 1; $i <= 3; $i++)
    {
      if ($_SESSION['language'] == $i)
      {
        continue;
      }

      $tr = "";
      if (isset($translations) && isset($translations[$i]))
      {
        $tr = $translations[$i];
      }
      echo($word_translations[$i] . " ($languages[$i]): "
           . "<input type='text' name='summary_$i' value='" . $tr . "'><br/>");
    }
    echo("<br/>");


    if (isset($recipe['summary']))
    {
      $query = "SELECT name FROM words WHERE id={$recipe['origin']};";
      $translations = $h->fetchTranslations($db->querySingle($query, true)['name']);
    }
    $word_translations = $h->fetchTranslations("Origin");
    for ($i = 1; $i <= 3; $i++)
    {
      if ($_SESSION['language'] == $i)
      {
        continue;
      }

      $tr = "";
      if (isset($translations) && isset($translations[$i]))
      {
        $tr = $translations[$i];
      }
      echo($word_translations[$i] . " ($languages[$i]): "
          . "<input type='text' name='origin_$i' value='" . $tr . "'><br/>");
    }
    echo("<br/><br/>");


    $translations = $h->fetchTranslations("Steps");
    foreach ($translations as $id_lg => $steps)
    {
      echo($steps . " ($languages[$id_lg]): "
          . "<textarea name='steps_$id_lg' rows='5' cols='80'></textarea><br/>");
    }

    $translations = $h->fetchTranslations("Notes");
    foreach ($translations as $id_lg => $notes)
    {
      echo($notes . " ($languages[$id_lg]): "
           . "<textarea name='notes_$id_lg' rows='5' cols='80'></textarea><br/>");
    }
  ?>

  <br/><br/>
  <hr/>
  <?php
    if ($g_mode_edit)
    {
      echo("<input type='submit' value='" . $h->fetchWord("Edit the recipe") . "'>");
    }
    else
    {
      echo("<input type='submit' value='" . $h->fetchWord("Add the recipe") . "'>");
    }
  ?>

</form>

<?php include "footer.php"; ?>

</body>
</html>
