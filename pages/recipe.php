<?php


$db_file = "../db/db";
$db = new SQLite3("$db_file");


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

// Fetch recipe name
$query = "SELECT name FROM words WHERE id={$recipe['id_word']};";
$name = $db->querySingle($query, true)['name'];
if (isset($_GET['lg']) && $_GET['lg'] != '1')
{
  $query = "SELECT name FROM translations WHERE id_language="
  . $_GET['lg'] . " AND id_word={$recipe['name']};";
  $name = $db->querySingle($query, true)['name'];
}


// View
print("<h1>" . $name . "</h1>");
print("<hr/>");

// Summary
// print("<h2>Summary</h2>"); // TODO
// print("<hr/>")

// Read time
// TODO Translations
// TODO Time units
print("<h2>Time</h2>");
print("<ul>");
print("  <li>Total: " . $recipe['time_total'] . " min</li>");
print("  <li>crafting: " . $recipe['time_crafting'] . " min</li>");
print("  <li>backing: " . $recipe['time_backing'] . " min</li>");
print("</ul>");
print("<hr/>");


print("<h2>Metadata</h2>");
print("<ul>");
print("  <li>Quantity: " . $recipe['quantity'] . "</li>");
print("  <li>Difficulty: " . $recipe['difficulty'] . "</li>");
print("  <li>Annoyance: " . $recipe['annoyance'] . "</li>");
print("  <li>Threads: " . $recipe['threads'] . "</li>");
print("</ul>");
print("<hr/>");


print("<h2>Ingredients</h2>");
print("<ul>");


// Fetch ingredients from 'requirements' table
$query = "SELECT * FROM requirements WHERE id_recipe={$recipe['id']};";
$result = $db->query($query);
while ($requirement = $result->fetchArray())
{
  $query = "SELECT name FROM words WHERE id={$requirement['id_ingredient']};";
  $ingredient_name = $db->querySingle($query);

  // TODO handle translations
  if ($requirement['id_quantity_unit'] != "")
  {
    $query = "SELECT symbol FROM quantities WHERE id_word={$requirement['id_quantity_unit']};";
    $unit = $db->querySingle($query);
    print("  <li>$ingredient_name ({$requirement['quantity']}$unit)</li>");
  }
}
print("</ul>");
print("<hr/>");


// print("<h2>Notes</h2>"); // TODO
// print("<hr/>")


// Instructions steps
$nb_steps = $db->querySingle("SELECT COUNT(*) FROM steps;");

$query = "SELECT * FROM steps WHERE id_recipe={$recipe['id']}; ORDER BY num";
$result = $db->query($query);
print("<h2>" . "$nb_steps" . " steps</h2>");
print("<ul>");
while ($step = $result->fetchArray())
{
  $query = "SELECT name FROM words WHERE id={$step['description']};";
  $description = $db->querySingle($query);

  print("  <li>{$step['num']}/$nb_steps - $description</li>");
}
print("</ul>");
print("<hr/>");

?>
