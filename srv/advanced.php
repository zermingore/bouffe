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


  <h3>Delete recipe</h3>


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
