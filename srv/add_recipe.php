<html>
<body>

<?php
  include "header.php";

  $db_file = "../db/db";
  $db = new SQLite3("$db_file");

  $h = new Helper($db_file);
  echo("<h3>" . $h->fetchWord("Add a recipe") . "</h3>");
?>
<p class="error_report"></p>


<script>
function validateForm()
{
  // Times consistency
  var error_msg = "";
  var times_list = ["time_preparation", "time_crafting", "time_backing"]
  for (var time in times_list)
  {
    var val = document.forms["mainForm"][times_list[time]].value;
    if (!isNaN(val) && val != "")
    {
      if (val < 0)
      {
        error_msg += "Negative time in " + times_list[time] + "<br/>";
      }
    }
  }

  // At least one valid ingredient
  if (g_ingredients_number < 1)
  {
    error_msg += "No ingredient provided<br/>";
  }
  for (var i = 1; i <= g_ingredients_number; ++i)
  {
    if (document.getElementById("ingredient_input_field_" + i).value == "")
    {
      error_msg += "Empty ingredient " + i + "<br/>";
    }
  }


  // On error, display error message and return an error
  if (error_msg != "")
  {
    alert(error_msg.replace(/(?:<br\/>|<br\/>)/g, '\n'));

    list = document.getElementsByClassName("error_report");
    for (elt in list)
    {
      list[elt].innerHTML = error_msg;
    }

    return false;
  }

  return true;
}
</script>

<form name="mainForm" method="post" action="handle_add_recipe.php" onsubmit="return validateForm()">

  <hr/>
  <?php
    echo($h->fetchWord("Name")
      . ": <input type='text' name='name_" . $_SESSION["language"] . "' required><br/>");
    echo($h->fetchWord("Summary")
      . ": <input type='text' name='summary_" . $_SESSION["language"] . "'>");
  ?>

  <br/><br/>
  <?php
    echo("<h3>" . $h->fetchWord("Time") . "</h3>");
    echo($h->fetchWord("Time preparation") . ": <input type='text' name='time_preparation'><br/>");
    echo($h->fetchWord("Time crafting") . ": <input type='text' name='time_crafting'><br/>");
    echo($h->fetchWord("Time backing") . ": <input type='text' name='time_backing'><br/>");
  ?>

  <br/><br/>
  <?php
    echo("<h3>" . $h->fetchWord("Metadata") . "</h3>");
    echo($h->fetchWord("Difficulty") . "<br/>");
  ?>
  <input type="radio" name="difficulty" value="1">1
  <input type="radio" name="difficulty" value="2">2
  <input type="radio" name="difficulty" value="3" checked="checked">3
  <input type="radio" name="difficulty" value="4">4
  <input type="radio" name="difficulty" value="5">5
  <input type="radio" name="difficulty" value="6">5+

  <br/><br/>
  <?php echo($h->fetchWord("Annoyance") . "<br/>"); ?>
  <input type="radio" name="annoyance" value="1">1
  <input type="radio" name="annoyance" value="2">2
  <input type="radio" name="annoyance" value="3" checked="checked">3
  <input type="radio" name="annoyance" value="4">4
  <input type="radio" name="annoyance" value="5">5
  <input type="radio" name="annoyance" value="6">5+

  <br/><br/>
  <?php echo($h->fetchWord("Ideal number of cooks") . "<br/>"); ?>
  <input type="radio" name="threads" value="1" checked="checked">1
  <input type="radio" name="threads" value="2">2
  <input type="radio" name="threads" value="3">3
  <input type="radio" name="threads" value="4">4
  <input type="radio" name="threads" value="5">5
  <input type="radio" name="threads" value="6">5+

  <br/><br/>
  <input name="vegetarian" value="0" type="hidden">
  <input name="vegetarian" type="checkbox" id="vegetarian">
  <label for="vegetarian"><?php echo($h->fetchWord("vegetarian")); ?></label><br/>

  <input name="vegan" value="0" type="hidden">
  <input name="vegan" type="checkbox" id="vegan">
  <label for="vegan"><?php echo($h->fetchWord("vegan")); ?></label><br/>

  <?php echo($h->fetchWord("Origin")
      . ": <input type='text' name='origin_" . $_SESSION["language"] . "'>"); ?>

  <br/><br/>
  <?php
    echo($h->fetchWord("For") . ": <input type='text' name='quantity'><br/>");
  ?>

  <br/><br/>
  <hr/>
  <?php echo("<h3>" . $h->fetchWord("Ingredients") . "</h3>"); ?>

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
            $query = "SELECT name FROM words WHERE"
            . " id IN (SELECT id_word FROM units WHERE (id_type="
            . $id_unit_ingredient . " OR id_type=" . $id_unit_none . "))";
          }
          else
          {
            $query = "SELECT name FROM translations WHERE id_language="
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
        ingredient_name.id = "ingredient_input_field_" + g_ingredients_number;
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

    <script> addIngredientField(); </script> <!-- Add first ingredient fields -->
  </div>

  <br/><br/>
  <hr/>
  <?php
    echo($h->fetchWord("Steps") . " (". $h->fetchWord("1 per line") . ")<br/>");
    echo('<textarea name="steps_' . $_SESSION['language'] . '" rows="5" cols="80"></textarea>');
  ?>

  <br/><br/>
  <hr/>
  <?php
    echo($h->fetchWord("Notes") . " (". $h->fetchWord("1 per line") . ")<br/>");
    echo('<textarea name="notes_' . $_SESSION['language'] . '" rows="5" cols="80"></textarea>');
  ?>

  <br/><br/>
  <hr/>
  <p class="error_report"></p>
  <?php echo("<input type='submit' value='" . $h->fetchWord("Add the recipe") . "'>"); ?>

  <br/><br/>
  <hr/>
  <?php
    echo("<h3>" . $h->fetchWord("Translations") . "</h3>");
    $languages = $h->getLanguages();

    // TODO: Avoid copy-pastes
    $translations = $h->fetchTranslations("Name");
    foreach ($translations as $id_lg => $name)
    {
      echo($name . " ($languages[$id_lg]): "
           . "<input type='text' name='name_$id_lg'><br/>");
    }

    $translations = $h->fetchTranslations("Summary");
    foreach ($translations as $id_lg => $summary)
    {
      echo($summary . " ($languages[$id_lg]): "
           . "<input type='text' name='summary_$id_lg'><br/>");
    }

    $translations = $h->fetchTranslations("Origin");
    foreach ($translations as $id_lg => $origin)
    {
      echo($origin . " ($languages[$id_lg]): "
           . "<input type='text' name='origin_$id_lg'><br/>");
    }

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
  <p class="error_report"></p>
  <?php echo("<input type='submit' value='" . $h->fetchWord("Add the recipe") . "'>"); ?>

  </form>

  <?php include "footer.php"; ?>

</body>
</html>
