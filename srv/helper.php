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
      $query = "SELECT id_language, name FROM translations WHERE "
      . "id_word = (SELECT id FROM words WHERE name='" . $word . "')"
      . " AND id_language != " . $language_id;

      $ret = [];
      $result = $this->db->query($query);
      while ($translation = $result->fetchArray(SQLITE3_ASSOC))
      {
        $ret[$translation["id_language"]] = $translation["name"];
      }

      if ($language_id != "1")
      {
        $ret[1] = $word;
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
      $text = $this->db->querySingle($query);

      if ($text == NULL)
      {
        // Translation not found -> Try to find a place-holder in the DB
        $query = "SELECT name FROM words WHERE name='" . $word . "';";
        $text = $this->db->querySingle($query);
        if ($text != NULL && $text != false)
        {
          return $text . " (not translated)";
        }
      }

      if ($text == NULL) // Neither translation nor place-holder found
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



    public function getLanguages()
    {
      // Fetch the appropriate translation
      $query = "SELECT * from languages";

      $ret = [];
      $result = $this->db->query($query);
      while ($lg = $result->fetchArray(SQLITE3_ASSOC))
      {
        $ret[$lg["id"]] = $lg["name"];
      }

      return $ret;
    }



    /**
     * Add the given words list to the DB if they don't exist yet
     * 1st words($names[0]): default language translation (EN -> insert in "words" table)
     * 2nd .. nb_translations words: Added in translations words
     * NOTE: Add a place-holder in 'words' if only translations are provided ($names[0] not set)
     */
    public function addWordAndOrTranslations($names)
    {
      $nb_translations = 2;  // TODO Fetch from the DB

      // Return 0 if no name is set
      $name_found = false;
      echo("See me<br/>");
      for ($i = 0; $i <= $nb_translations; $i++)
      {
        if (isset($names[$i]) || $names[$i] != "")
        {
          $name_found = true;
          break;
        }
      }
      if (!$name_found)
      {
        echo("No name found<br/>");
        return 0;
      }


      // Insert the recipe name only if it does not exist yet
      if (isset($names[0]) && !empty($names[0]))
      {
        $query = "SELECT id FROM words WHERE name='" . $names[0] . "';";
        $name_id = $this->db->querySingle($query);
        if (empty($name_id))
        {
          $query = "INSERT INTO words('name') VALUES('" . $names[0] . "');";
          $this->db->querySingle($query);
          $name_id = $this->db->lastInsertRowID();
        }
      }

      // Insert a temporary name in order to add translations
      $place_holder = ""; // No 'Name' in any language -> don't add anything in the DB
      if (empty($name_id))
      {
        for ($i = 1; $i <= $nb_translations; $i++)
        {
          if (isset($names[$i]))
          {
            $place_holder .= "__" . $place_holder . $names[$i];
          }

          $query = "SELECT id_word FROM translations WHERE id_language='"
                  . ($i + 1) . "' AND name='" . $names[$i] . "'";

          $name_id = $this->db->querySingle($query);
          if (!empty($name_id))
          {
            break;
          }
        }
      }

      // If we cannot find the word based on its translations; Add a temporary one
      if (empty($name_id) && $place_holder != "")
      {
        $query = "INSERT INTO words('name') VALUES('TR" . $place_holder . "');";
        $this->db->querySingle($query);
        $name_id = $this->db->lastInsertRowID();
      }


      // Add translations if required
      for ($i = 1; $i <= 2; $i++) // TODO Clean foreach translation
      {
        if (!isset($names[$i]))
        {
          continue;
        }

        $query = "SELECT id FROM translations WHERE name='" . $names[$i] . "'"
          . " AND id_language = '" . ($i + 1) . "';";
        $tmp = $this->db->querySingle($query);
        if (empty($tmp))
        {
          $query = "INSERT INTO translations('id_language', 'id_word', 'name') VALUES('"
            . ($i + 1) . "', '" . $name_id . "', '" . $names[$i] . "');";

          if ($this->db->querySingle($query) === false)
          {
            echo("Failure running query [$query]<br/>");
          }
        }
      }

      return $name_id;
    }


    private $db;
  }

?>
