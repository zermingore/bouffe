<html>
<body>

<?php
  include "header.php";

  $db_file = "../db/db";
  $db = new SQLite3("$db_file");

  $h = new Helper($db_file);
  echo("<h3>" . $h->fetchWord("Add a recipe") . "</h3>");
?>

<form method="post" action="handle_add_recipe.php">

  <hr/>
  <?php
    echo($h->fetchWord("Name") . ": <input type='text' name='name'><br/>");
    echo($h->fetchWord("Summary") . ": <input type='text' name='summary'>");
  ?>

  <br/><br/>
  <?php
    echo("<h3>" . $h->fetchWord("Time") . "</h3>");
    echo($h->fetchWord("Time total") . ": <input type='text' name='time_total'><br/>");
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
  <?php echo($h->fetchWord("Steps") . " (". $h->fetchWord("1 per line") . ")<br/>"); ?>
  <textarea name="steps" rows="5" cols="80"></textarea>

  <br/><br/>
  <hr/>
  <?php echo($h->fetchWord("Notes") . " (". $h->fetchWord("1 per line") . ")<br/>"); ?>
  <textarea name="notes" rows="5" cols="80"></textarea>

  <br/><br/>
  <hr/>
  <?php echo("<input type='submit' value='" . $h->fetchWord("Add the recipe") . "'>"); ?>

  </form>

  <?php include "footer.php"; ?>

</body>
</html>
