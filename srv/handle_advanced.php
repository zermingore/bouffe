<html>
<?php
  include "header.php";
  echo "<pre>post:"; print_r($_POST); echo "</pre><hr/>";

  $db_file = "../db/db";
  $db = new SQLite3("$db_file");
  $h = new Helper($db_file);
?>
<body>


<?php
if (isset($_POST["user_name"]) && !empty($_POST["user_name"]))
{
  $user_name = $_POST["user_name"];
  echo "Inserting new user [$user_name]<br/>";

  $query = "INSERT INTO users('name') VALUES('" . $user_name . "');";
  $db->query($query);
}


$add_qty_unit = true;
$nb_languages = $h->getNbLanguages();

// Every translation must be set to add a quantity
for ($lg_idx = 1; $lg_idx <= $nb_languages; $lg_idx++)
{
    if (!isset($_POST["qty_unit_name_$lg_idx"])
        || empty($_POST["qty_unit_name_$lg_idx"]))
    {
        $add_qty_unit = false;
        break;
    }
}

if ($add_qty_unit == true)
{
    echo "Inserting new quantity ";
    for ($lg_idx = 1; $lg_idx <= $nb_languages; $lg_idx++)
    {
        echo "[$qty_unit_name_$lg_idx] ";
    }
    echo "<br/>(symbol: [$qty_unit_symbol])<br/>";

    // Insert default language
    $query = "INSERT INTO words('name') VALUES('"
      . $_POST["qty_unit_name_1"] . "'";
    $this->db->querySingle($query);
    $qty_word_id = $this->db->lastInsertRowID();

    // Add translations
    for ($lg_idx = 1; $lg_idx <= $nb_languages; $lg_idx++)
    $query = "INSERT INTO translations('id_language', 'id_word', 'name')"
      . "VALUES('" . $lg_idx
        . ", " . $qty_word_id
        . ", " . $_POST["qty_unit_name_$lg_idx"] . "');";
    $this->db->querySingle($query);

    // Insert the unit itself
    // Handling only ingredient units type
    // TODO Don't hard-code ingredient category id
    // TODO Handle Symbols
    $query = "INSERT INTO units('id_word', 'id_type', 'id_symbol') VALUES('"
        . $qty_word_id . '3' . '1' . "');";
    $db->query($query);
}


include "footer.php";
?>

</body>
</html>
