<html>
<body>

<!-- Refresh page warning -->
<script type='text/javascript'>
  window.onbeforeunload = function()
  {
    return "Abort the recipe creation?";
  };
</script>


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
  return;
}

// Fetch recipe name
$query = "SELECT name FROM words WHERE id={$recipe['name']};";
$name = $db->querySingle($query, true)['name'];


// Title + summary (if any)
echo("<h1>" .  $h->fetchword("Making") . ": " . $h->fetchWord($name) . "</h1>");
if (isset($recipe['summary']) && $recipe['summary'])
{
  $query = "SELECT name FROM words WHERE id={$recipe['summary']};";
  $result = $db->querySingle($query, true);
  if ($result)
  {
    $summary = $result['name'];
    print("<h3>" . $h->fetchWord($summary) . "</h3>");
  }
}



print("<hr/>");
print("<h2>" . $h->fetchWord("Ingredients") . "</h2>");
print("<ul>");

// Fetch ingredients from 'requirements' table
$query = "SELECT * FROM requirements WHERE id_recipe={$recipe['id']};";
$result = $db->query($query);
while ($requirement = $result->fetchArray())
{
  $query = "SELECT name FROM words WHERE id={$requirement['id_ingredient']};";
  $ingredient_name = $h->fetchWord($db->querySingle($query));

  if ($requirement['id_unit'] != "")
  {
    $query = "SELECT id_symbol FROM units WHERE id={$requirement['id_unit']};";
    $id_symbol = $db->querySingle($query);

    $query_name = "SELECT name FROM words WHERE id={$id_symbol};";
    $unit_name = $db->querySingle($query_name);

    $h->fetchWord($unit_name);

    if ($unit_name != "-")
    {
      print("  <li>$ingredient_name ({$requirement['quantity']} $unit_name)"
        . " <input type='checkbox'></li>");
    }
    else
    {
      print("  <li>$ingredient_name ({$requirement['quantity']})"
        . " <input type='checkbox'></li>");
    }
  }
  else
  {
    print("  <li>$ingredient_name</li>");
  }
}
print("</ul>");
print("<hr/>");


// Notes: display nothing if there is no notes
$query = "SELECT * FROM notes WHERE id_recipe={$recipe['id']}";
$check_empty = $db->querySingle($query);
if (!empty($check_empty))
{
  print("<h2>" . $h->fetchWord("Notes") . "</h2>");

  $query = "SELECT * FROM notes WHERE id_recipe={$recipe['id']}";
  $result = $db->query($query);
  print("<ul>");
  while ($note = $result->fetchArray())
  {
    print("  <li>" . $h->fetchWord($note['description'], true) . "</li>");
  }
  print("</ul>");
  print("<hr/>");
}


// Instructions steps
$nb_steps = $db->querySingle(
  "SELECT MAX(num) FROM steps WHERE id_recipe={$recipe['id']};");
$word_step = $h->fetchWord("Steps");

$query = "SELECT * FROM steps WHERE id_recipe={$recipe['id']} ORDER BY num";
$result = $db->query($query);

print("<h2>" . "$nb_steps" . " $word_step</h2>");
print("<ul>");
while ($step = $result->fetchArray())
{
  print("  <li id=step_{$step['num']}>{$step['num']}/$nb_steps - "
    . $h->fetchWord($step['description'], true));

  echo("<input id='chk_step_{$step['num']}' type='checkbox' . onclick='updateSteps()'>");
  echo("</li>");
}
print("</ul>");

?>


<hr>
<form name="mainForm"
      method="post"
      action="<?php $h->updateRecipeHistory($recipe['id']); echo("/index.html"); ?>"
      onsubmit="return validateForm()">

  <?php echo "<input type='submit' value=' " . $h->fetchWord("Done") . "'>" ?>
</form>




<script type='text/javascript'>
  function updateSteps()
  {
    var i = 1;
    while (true)
    {
      var checkbox_idx = "chk_step_" + i;
      var checkbox = document.getElementById(checkbox_idx);
      if (checkbox == null)
      {
        break;
      }

      var elt = document.getElementById("step_" + i)
      if (checkbox.checked)
      {
        elt.style.setProperty("text-decoration", "line-through");
      }
      else
      {
        elt.style.setProperty("text-decoration", "");
      }

      i++;
    }
  }
</script>


</body>
</html>
