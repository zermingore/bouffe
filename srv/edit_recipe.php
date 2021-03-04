<html>
<body>

<?php
  include "header.php";

  $db_file = "../db/db";
  $db = new SQLite3("$db_file");

  $h = new Helper($db_file);

  // Fetch recipe
  $query = "SELECT * FROM recipes WHERE id=" . $_GET['id'] . ";";
  $recipe = $db->querySingle($query, true);

  // Sanity check
  if (!$recipe['id'])
  {
    print("Unable to find the recipe id:" . $_GET['id'] . "<br/>");
    // TODO link home page
    return;
  }


  // Recipe data
  $name = "";
  if (isset($recipe["id_word"]))
  {
    $query = "SELECT name FROM words WHERE id={$recipe['id_word']};";
    $name = $db->querySingle($query, true)['name'];
  }

  $summary = "";
  if (isset($recipe["summary"]))
  {
    $query = "SELECT name FROM words WHERE id={$recipe['summary']};";
    $summary = $db->querySingle($query, true)['name'];
  }

  $time_total = $recipe['time_total'];
  $time_preparation = $recipe["time_preparation"];
  $time_crafting = $recipe["time_crafting"];
  $time_backing = $recipe["time_backing"];

  $quantity = $recipe["quantity"];
  $quantity_unit = $recipe["quantity_unit"];

  $difficulty = $recipe["difficulty"];
  $annoyance = $recipe["annoyance"];
  $threads = $recipe["threads"];


  echo("<h1>" . $h->fetchWord("edit") . ": $name</h1>");
?>


<form method="post" action="handle_edit_recipe.php?id={$_GET['id']}"> <!-- call add with an edit flag -->

  <hr/>
  <?php
    $short = ": <input type='text' name=";
    echo($h->fetchWord("Name") . "$short'name' value='" .  $name . "'><br/>");
    echo($h->fetchWord("Summary") . "$short'summary' value='$summary'>");
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
  ?>


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


      function addIngredientField()
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
          unit.appendChild(quantity);
        }


        // Name <input> element
        var ingredient_name = document.createElement("input");
        ingredient_name.type = "text";
        ingredient_name.name = prefix + "_name";
        ingredient_container.appendChild(ingredient_name);

        if (g_ingredients_number > 1)
        {
          var removeButton = document.createElement("button");
          removeButton.innerText = " x ";
          removeButton.type = "button"; // Do not submit the form
          removeButton.onclick = function() { removeIngredient(current_id) };
          ingredient_container.appendChild(removeButton);
        }
      }
    </script>

    <!-- TODO support add / rm ingredient -->
    <!-- <button type="button" id="filldetails" onclick="addIngredientField()">
      <?php echo($h->fetchWord("Add an ingredient")); ?>
      <br/>
    </button> -->

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

    <!-- <script> addIngredientField(); </script> -->
    <!-- Add first ingredient fields -->
  </div>


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
    $query = "SELECT * FROM requirements WHERE id_recipe={$recipe['id']};";
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

      // Quantity
      echo("<input type='text' name=ingredient_quantity_{$i} value='". $requirement['quantity'] . "'>");

      // Unit
      echo("<select id=ingredient_unit_name_{$i} value='tmp'>");
      while ($u = $units_list->fetchArray())
      {
        if ($unit_name == $u['name'])
        {
          echo("  <option value=${u['name']} selected=selected>" . $u['name'] . "</option>");
        }
        else
        {
          echo("  <option value=${u['name']}>" . $u['name'] . "</option>");
        }
      }
      echo("</select>");

      // Name
      echo("<input type='text' name=ingredient_name_{$i} value='". $ingredient_name . "'><br/>");
    }
    print("</ul>");
    print("<hr/>");
  ?>


  <br/><br/>
  <hr/>


  <!-- Instructions steps -->
  <?php
    $word_step = $h->fetchWord("Steps");

    $query = "SELECT * FROM steps WHERE id_recipe={$recipe['id']}; ORDER BY num";
    $result = $db->query($query);
    print("<h2>$word_step</h2>");
    print("<ul>");
    while ($step = $result->fetchArray())
    {
      $query = "SELECT name FROM words WHERE id={$step['description']};";
      $description = $db->querySingle($query);

      echo("<input type='text' name=step_{$step['num']} value='". $description . "'><br/>");
    }
    print("</ul>");
  ?>


  <!-- Notes -->
  <br/><br/>
  <hr/>
  <?php
    $word_note = $h->fetchWord("Notes");

    $query = "SELECT * FROM notes WHERE id_recipe={$recipe['id']}; ORDER BY num";
    $result = $db->query($query);
    print("<h2>$word_note</h2>");
    print("<ul>");
    while ($note = $result->fetchArray())
    {
      $query = "SELECT name FROM words WHERE id={$note['description']};";
      $description = $db->querySingle($query);

      echo("<input type='text' name=note_{$note['num']} value='". $description . "'><br/>");
    }
    print("</ul>");
  ?>


  <br/><br/>
  <hr/>
  <?php echo("<input type='submit' value='" . $h->fetchWord("Edit the recipe") . "'>"); ?>

  </form>

  <?php include "footer.php"; ?>

</body>
</html>
