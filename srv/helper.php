<?php

  class Helper
  {
    public function __construct(string $db_path)
    {
      $this->db = new SQLite3($db_path);
    }

    public function fetchWord($word, $accept_error = false)
    {
      if (gettype($word) == "string")
      {
        return $this->fetchWordByName($word, $accept_error);
      }

      if (gettype($word) == "integer")
      {
        return $this->fetchWordById($word, $accept_error);
      }
    }


    public function fetchTranslations($word)
    {
      $language_id = $_SESSION["language"];

      // Fetch the appropriate translation
      $query = "SELECT name FROM translations WHERE "
      . "id_word = (SELECT id FROM words WHERE name='" . $word . "')"
      . " AND id_language != " . $language_id;

      $ret = [];
      $result = $this->db->query($query);
      while ($translation = $result->fetchArray(SQLITE3_ASSOC))
      {
        array_push($ret, $translation["name"]);
      }

      if ($language_id != "1")
      {
        array_push($ret, $word);
      }

      return $ret;
    }


    public function fetchWordByName(string $word, $accept_error)
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
        if ($accept_error)
        {
          return "[TR] $word";
        }
        echo "Error: Unable to find word [" . $word . "]";
        return "__ $word __";
      }
      if ($text == false)
      {
        echo "Error trying to fetch word [" . $word . "]";
        return "___";
      }

      if ($text == "")
      {
        if ($accept_error)
        {
          return "[En] $word";
        }

        echo "ERROR: missing word [$word] in language [$language_id] <br/>";
        return $word;
      }
      return $text;
    }


    public function fetchWordById(int $id, $accept_error)
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
        if ($accept_error)
        {
          return "[En] $text";
        }

        echo "ERROR: missing word [$text] in language [$language_id] <br/>";
        return $text;
      }
      return $translation;
    }

    private $db;
  }

?>
