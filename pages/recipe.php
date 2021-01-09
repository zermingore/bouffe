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
$query = "SELECT name FROM words WHERE id={$recipe['name']};";
$array['query'] = "$query";
$name = $db->querySingle($query, true)['name'];

if ($_GET['lg'] != '' && $_GET['lg'] != '1')
{
  $query = "SELECT name FROM translations WHERE id_language="
  . $_GET['lg'] . " AND id_word={$recipe['name']};";
  $array['query'] = "$query";
  $name = $db->querySingle($query, true)['name'];
}

print("<h1>" . $name . "</h1>");
print("<hr/>");

?>
