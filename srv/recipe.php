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
$query = "SELECT name FROM words WHERE id={$recipe['id_word']};";
$name = $db->querySingle($query, true)['name'];


// Title + summary (if any)
echo("<h1>" . $h->fetchWord($name) . "</h1>");
if (isset($recipe['summary']))
{
  $query = "SELECT name FROM words WHERE id={$recipe['summary']};";
  $summary = $db->querySingle($query, true)['name'];
  $print_summary = $h->fetchWord($summary);
  print("<h3>$print_summary</h3>");
}
print("<hr/>");

// Read time
// TODO Time units
print("<h2>" . $h->fetchWord("Time") . "</h2>");
print("<ul>");
$time_total = $recipe['time_preparation'] + $recipe['time_crafting'] +  $recipe['time_backing'];
print("  <li>" . $h->fetchWord("Time total") . ": " . $time_total
      . " " . $h->fetchWord("min.") . "</li>");

if ($recipe['time_preparation'] != 0)
{
  print("  <li>" . $h->fetchWord("Time preparation") . ": " . $recipe['time_preparation']
    . " " . $h->fetchWord("min.") . "</li>");
}

if ($recipe['time_crafting'] != 0)
{
  print("  <li>" . $h->fetchWord("Time crafting") . ": " . $recipe['time_crafting']
    . " " . $h->fetchWord("min.") . "</li>");
}

if ($recipe['time_backing'] != 0)
{
  print("  <li>" . $h->fetchWord("Time backing") . ": ". $recipe['time_backing']
    . " " . $h->fetchWord("min.") . "</li>");
}

print("</ul>");
print("<hr/>");


print("<h2>" . $h->fetchWord("Metadata") . "</h2>");
print("<ul>");
print("  <li>" . $h->fetchWord("For") . ": " . $recipe['quantity'] . "</li>");
print("  <li>" . $h->fetchWord("Difficulty") . ": " . $recipe['difficulty'] . "</li>");
print("  <li>" . $h->fetchWord("Ideal number of cooks") . ": " . $recipe['threads'] . "</li>");

$flags = [ "Vegetarian", "Vegan" ];
foreach ($flags as $flag)
{
  $lower = strtolower($flag);
  if (isset($recipe[$lower]) && $recipe[$lower] == true)
  {
    echo("<li>" . $h->fetchWord($flag) . "</li>");
  }
}

if (isset($recipe['origin']) && $recipe['origin'] > 1)
{
  echo("<li>" . $h->fetchWord("Origin")
       . ": " . $h->fetchWord($recipe['origin']) . "</li>");
}


print("</ul>");
print("<hr/>");


print("<h2>" . $h->fetchWord("Ingredients") . "</h2>");
print("<ul>");


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
    $query = "SELECT id_symbol FROM units WHERE id={$requirement['id_unit']};";
    $id_symbol = $db->querySingle($query);

    $query_name = "SELECT name FROM words WHERE id={$id_symbol};";
    $unit_name = $db->querySingle($query_name);

    $h->fetchWord($unit_name);

    if ($unit_name != "-")
    {
      print("  <li>$ingredient_name ({$requirement['quantity']} $unit_name)</li>");
    }
    else
    {
      print("  <li>$ingredient_name ({$requirement['quantity']})</li>");
    }
  }
  else
  {
    print("  <li>$ingredient_name</li>");
  }
}
print("</ul>");
print("<hr/>");


// Notes: display nothing if there's none
$query = "SELECT * FROM notes WHERE id_recipe={$recipe['id']}";
$check_empty = $db->querySingle($query);
if (!empty($check_empty))
{
  print("<h2>" . $h->fetchWord("Notes") . "</h2>");
  print("<hr/>");

  $query = "SELECT * FROM notes WHERE id_recipe={$recipe['id']} "
    . "AND id_language={$_SESSION['language']}";
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

$query = "SELECT * FROM steps WHERE id_recipe={$recipe['id']} "
  . "AND id_language={$_SESSION['language']}; ORDER BY num";
$result = $db->query($query);
print("<h2>" . "$nb_steps" . " $word_step</h2>");
print("<ul>");
while ($step = $result->fetchArray())
{
  print("  <li>{$step['num']}/$nb_steps - "
    . $h->fetchWord($step['description'], true) . "</li>");
}
print("</ul>");


echo "<hr>";
echo "<a href=/srv/edit_recipe.php?id=" . $_GET['id'] . ">"
  . $h->fetchWord("edit") . "</a><br/>";

include "footer.php";

?>
