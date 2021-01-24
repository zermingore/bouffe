<?php

class Helper
{
  public function __construct(string $db_path)
  {
    $this->db = new SQLite3($db_path);
  }


  public function fetchWord(string $word)
  {
    // Default language
    if (!isset($_SESSION["language"]) || $_SESSION["language"] == "1")
    {
      echo "DEFAULT<br/>";
      return $word;
    }

    // Sanity check
    if ($_SESSION["language"] != "2" && $_SESSION["language"] != "3")
    {
      echo "Invalid language " . $_SESSION["language"] . "<br/>";
      return "___";
    }

    // Fetch the appropriate translation
    $query = "SELECT name from translations where id_language='"
      . $_SESSION["language"] . "' and id_word = "
      . "(SELECT id FROM words WHERE name='" . $word . "')";

    // echo $query;
    $text =  $this->db->querySingle($query);

    if ($text == "")
    {
      echo "ERROR: missing word<br/>";
    }
    return $text;
  }


  private $db;
}

?>
