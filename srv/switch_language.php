<?php
  session_start();

  switch ($_POST["language"])
  {
    case "English":
      $_SESSION["language"] = "1";
      break;

    case "Deutsch":
      $_SESSION["language"] = "2";
      break;

    case "Français":
      $_SESSION["language"] = "3";
      break;

      default:
        die("[IMPLEMENTATION ERROR] Invalid language " . $_POST["language"]);
        break;
  }

  header('Location: ../index.html');
  exit;
?>
