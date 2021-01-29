<?php

  class Helper
  {
    public function __construct(string $db_path)
    {
      $this->db = new SQLite3($db_path);
    }


    public function fetchWord($word)
    {
      if (gettype($word) == "string")
      {
        return $this->fetchWordByName($word);
      }

      if (gettype($word) == "integer")
      {
        return $this->fetchWordById($word);
      }
    }


    public function fetchWordByName(string $word)
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
        return "___" . $word . "___";
      }

      // Fetch the appropriate translation
      $query = "SELECT name from translations where id_language='"
        . $language_id . "' and id_word = "
        . "(SELECT id FROM words WHERE name='" . $word . "')";

      // echo $query;
      $text =  $this->db->querySingle($query);
      if ($text == NULL)
      {
        echo "Error: Unable to find word [" . $word . "]";
        return "___";
      }
      if ($text == false)
      {
        echo "Error trying to fetch word [" . $word . "]";
        return "___";
      }

      if ($text == "")
      {
        echo "ERROR: missing word [$word] in language [$language_id] <br/>";
        return $word;
      }
      return $text;
    }


    public function fetchWordById(int $id)
    {
      $query = "SELECT name from words where id='" . $id . "'";
      $text = $this->db->querySingle($query);
      if ($text == NULL)
      {
        echo "Unable to find word with id [" . $id . "]";
        return "___";
      }
      if ($text == false)
      {
        echo "Error trying to fetch word id [" . $id . "]";
        return "___";
      }

      $language_id = $_SESSION["language"];

      // Default language
      if ($language_id == "1")
      {
        return $text;
      }

      // Sanity check
      if ($language_id != "2" && $language_id != "3")
      {
        echo "Invalid language [" . $language_id . "]<br/>";
        return "___" . $text . "___";
      }

      // Fetch the appropriate translation
      $query = "SELECT name from translations where id_language='"
        . $language_id . "' and id_word = '" . $id . "'";

      // echo $query;
      $translation =  $this->db->querySingle($query);

      if ($translation == "")
      {
        echo "ERROR: missing word [$text] in language [$language_id] <br/>";
        return $text;
      }
      return $translation;
    }

    private $db;
  }

?>
