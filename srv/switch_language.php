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
      die("[IMPLEMENTATION ERROR] switch_language: Invalid language ["
          . $_POST["language"] . "]");
      break;
  }

  if (!isset($_GET["src"]) || $_GET["src"] == "")
  {
    die("[IMPLEMENTATION ERROR] switch_language: No redirection page");
    // header('Location: ../index.html');
  }
  else
  {
    header('Location: ../' . $_GET["src"]);
  }
?>
