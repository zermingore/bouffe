<html>
<body>


<!-- Refresh page warning -->
<script type='text/javascript'>
  window.onbeforeunload = function()
  {
    return "Changes will be lost";
  };
</script>


<?php
  include "header.php";

  $db_file = "../db/db";
  $db = new SQLite3("$db_file");
  $h = new Helper($db_file);
?>


<form name="mainForm"
  method="post"
  action="handle_advanced.php"
  onsubmit="return validateForm()">

  <h3>Add ingredient unit</h3>


  <h3>Add user</h3>
  <?php
    echo($h->fetchWord("Name") . ": <input type='text' name='user_name'><br/>");
  ?>


  <h3>Add ingredient quantity unit</h3>
  <?php
    echo("Warning: *every* field required<br/>"); // TODO Fetch translations

    $nb_languages = $h->getNbLanguages();
    $languages = $h->getLanguages();
    for ($lg_idx = 1; $lg_idx <= $nb_languages; $lg_idx++)
    {
      echo($h->fetchWord("Name") . " - " . $languages[$lg_idx]
        . ": <input type='text' name='qty_unit_name_$lg_idx'"
        . "'><br/>");
    }
  ?>



  <br/><br/>
  <hr/>
  <?php
    echo("<input type='submit' value='" . $h->fetchWord("confirm") . "'>");
  ?>

</form>


<?php
  include "footer.php";
?>


</body>
</html>
