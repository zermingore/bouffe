<html>
<body>

<h1>Add recipe</h1>

<form method="post" action="handle_add_recipe.php">

  <hr/>
  Name: <input type="text" name="name"><br/>
  Summary: <input type="text" name="summary">

  <br/><br/>
  <h3>Time</h3>
  time total: <input type="text" name="time_total"><br/>
  time preparation: <input type="text" name="time_preparation"><br/>
  time crafting: <input type="text" name="time_crafting"><br/>
  time backing: <input type="text" name="time_backing"><br/>

  <br/><br/>
  Difficulty:<br/>
  <input type="radio" name="difficulty" value="1">1
  <input type="radio" name="difficulty" value="2">2
  <input type="radio" name="difficulty" value="3" checked="checked">3
  <input type="radio" name="difficulty" value="4">4
  <input type="radio" name="difficulty" value="5">5
  <input type="radio" name="difficulty" value="6">5+

  <br/><br/>
  Annoyance:<br/>
  <input type="radio" name="annoyance" value="1">1
  <input type="radio" name="annoyance" value="2">2
  <input type="radio" name="annoyance" value="3" checked="checked">3
  <input type="radio" name="annoyance" value="4">4
  <input type="radio" name="annoyance" value="5">5
  <input type="radio" name="annoyance" value="6">5+

  <br/><br/>
  Threads (ideal number of people working together):<br/>
  <input type="radio" name="threads" value="1" checked="checked">1
  <input type="radio" name="threads" value="2">2
  <input type="radio" name="threads" value="3">3
  <input type="radio" name="threads" value="4">4
  <input type="radio" name="threads" value="5">5
  <input type="radio" name="threads" value="6">5+

  <br/><br/>
  Quantity: <input type="text" name="quantity"><br/>

  <br/><br/>
  <hr/>
  <h3>Ingredients</h3>

  <div>
    <button type="button" id="filldetails" onclick="addIngredientField()">
      Add an ingredient
    </button>

    <div id="g_ingredients_container"/>


    <script type='text/javascript'>
      var g_ingredients_number = 0; // global
      var g_ingredients_container = document.getElementById("g_ingredients_container");
      var g_max_ingredients = 30;

      function addIngredientField()
      {
        if (g_ingredients_number > g_max_ingredients - 1)
        {
          alert("Too many ingredients (max: " + g_max_ingredients + ")");
          return;
        }

        g_ingredients_number++;

        // Append a node
        var prefix = "Ingredient " + g_ingredients_number;
        var ingredient = g_ingredients_container.appendChild(document.createTextNode(prefix));

        // Quantity <input> element
        var ingredient_qty = document.createElement("input");
        ingredient_qty.type = "text";
        ingredient_qty.name = "ingredient" + g_ingredients_number + "_qty";
        g_ingredients_container.appendChild(ingredient_qty);

        // Quantity unit <select> element
        var ingredient_unit = document.createElement("select");
        ingredient_unit.type = "text";
        ingredient_unit.name = "ingredient" + g_ingredients_number + "_qty_unit";
        var unit = g_ingredients_container.appendChild(ingredient_unit);

        quantity_list = <?php
          $db_file = "../db/db";
          $db = new SQLite3("$db_file");

          $list = $db->query("select * from words where id in (select id_word from quantities)");
          $ingredient_found = 0;
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
        ingredient_name.name = "ingredient" + g_ingredients_number + "_name";
        g_ingredients_container.appendChild(ingredient_name);


        g_ingredients_container.appendChild(document.createElement("br"));
      }
    </script>
  </div>

  <br/><br/>
  <hr/>
  <h3>Steps</h3>
  Steps (One per line):<br/>
  <textarea name="steps" rows="5" cols="80"></textarea>

  <br/><br/>
  <hr/>
  Notes (one per line):<br/>
  <textarea name="notes" rows="5" cols="80"></textarea>

  <br/><br/>
  <hr/>
  <input type="submit" value="Add">

  </form>

</body>
</html>
