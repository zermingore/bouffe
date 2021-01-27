<?php

  class Helper
  {
    public function __construct(string $db_path)
    {
      $this->db = new SQLite3($db_path);
    }


    public function fetchWord(string $word)
    {
      $language_id = $_SESSION["language"];

      // Default language
      if ($language_id == "1")
      {
        return $word;
      }

      // Sanity check
      if ($language_id != "2" && $language_id != "3")
      {
        echo "Invalid language " . $language_id . "<br/>";
        return "___";
      }

      // Fetch the appropriate translation
      $query = "SELECT name from translations where id_language='"
        . $language_id . "' and id_word = "
        . "(SELECT id FROM words WHERE name='" . $word . "')";

      // echo $query;
      $text =  $this->db->querySingle($query);

      if ($text == "")
      {
        echo "[ERROR: missing word $word in language $language_id] <br/>";
        return $word;
      }
      return $text;
    }


    private $db;
  }

?>
