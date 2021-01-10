<?php


$db_file = "../db/db";
$db = new SQLite3("$db_file");


// Fetch recipe
$query = "SELECT * FROM recipes WHERE id=" . $_GET['id'] . ";";
$array['dbhandle'] = $db;
$array['query'] = "$query";
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
$array['query'] = "$query";
$name = $db->querySingle($query, true)['name'];

if (isset($_GET['lg']) && $_GET['lg'] != '1')
{
  $query = "SELECT name FROM translations WHERE id_language="
  . $_GET['lg'] . " AND id_word={$recipe['name']};";
  $array['query'] = "$query";
  $name = $db->querySingle($query, true)['name'];
}


// View
print("<h1>" . $name . "</h1>");
print("<hr/>");


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


// TODO Integrate in the DB
// print("<h2>Metadata</h2>");
// print("<ul>");
// print("  <li>Quantity: 20</li>");
// print("  <li>Difficulty: 1</li>");
// print("  <li>Annoyance: 1</li>");
// print("  <li>Threads: 1</li>");
// print("</ul>");
// print("<hr/>");


// print("<h2>Notes</h2>"); // TODO
// print("<hr/>")


print("<h2>Ingredients</h2>");
print("<ul>");


// Fetch ingredients from 'requirements' table
$query = "SELECT * FROM requirements WHERE id_recipe={$recipe['id']};";
$array['query'] = "$query";
$result = $db->query($query);
while ($requirement = $result->fetchArray())
{
  $query = "SELECT name FROM words WHERE id={$requirement['id_ingredient']};";
  $array['query'] = "$query";
  $ingredient_name = $db->querySingle($query);

  $query = "SELECT symbol FROM quantities WHERE id_word={$requirement['id_quantity_unit']};";
  $array['query'] = "$query";
  $unit = $db->querySingle($query); // TODO handle translations

  print("  <li>$ingredient_name ({$requirement['quantity']}$unit)</li><br/>");
}
print("</ul>");
print("<hr/>");


print("<h2>Steps</h2>");
print("<ul>");
// TODO Fetch steps from 'steps' table
// print("  <li>$step</li>");
print("</ul>");

?>
