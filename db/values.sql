INSERT INTO languages(id, name) VALUES(1, "english");
INSERT INTO languages(id, name) VALUES(2, "deutsch");
INSERT INTO languages(id, name) VALUES(3, "français");

INSERT INTO words(name) VALUES ("-"); -- Should be the first word

-- Units categories
INSERT INTO words(name) VALUES ("unit_none");
INSERT INTO words(name) VALUES ("unit_ingredient");
INSERT INTO words(name) VALUES ("unit_time");
INSERT INTO words(name) VALUES ("unit_quantity");


INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="-"), "-");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="-"), "-");
INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="-"),
    (SELECT id FROM words WHERE name="unit_none"),
    (SELECT id FROM words WHERE name="-"));


-- Units
INSERT INTO words(name) VALUES ("gram");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="gram"), "Gramm");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="gram"), "gramme");

INSERT INTO words(name) VALUES ("g");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="g"), "g");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="g"), "g");

INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="gram"),
          (SELECT id FROM words WHERE name="unit_ingredient"),
          (SELECT id FROM words WHERE name="g"));


INSERT INTO words(name) VALUES ("liter");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="liter"), "Liter");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="liter"), "litre");

INSERT INTO words(name) VALUES ("L");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="L"), "L");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="L"), "L");

INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="liter"),
          (SELECT id FROM words WHERE name="unit_ingredient"),
          (SELECT id FROM words WHERE name="L"));


INSERT INTO words(name) VALUES ("milliliter");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="milliliter"), "Milliliter");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="milliliter"), "millilitre");

INSERT INTO words(name) VALUES ("ml");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="ml"), "ml");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="ml"), "ml");

INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="milliliter"),
          (SELECT id FROM words WHERE name="unit_ingredient"),
          (SELECT id FROM words WHERE name="ml"));





INSERT INTO words(name) VALUES ("second");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="second"), "Sekunde");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="second"), "seconde");

INSERT INTO words(name) VALUES ("s");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="s"), "s");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="s"), "s");
INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="second"),
          (SELECT id FROM words WHERE name="unit_time"),
          (SELECT id FROM words WHERE name="s"));


INSERT INTO words(name) VALUES ("minute");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="minute"), "Minute");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="minute"), "minute");

INSERT INTO words(name) VALUES ("min.");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="min."), "min.");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="min."), "min.");
INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="minute"),
          (SELECT id FROM words WHERE name="unit_time"),
          (SELECT id FROM words WHERE name="min."));


INSERT INTO words(name) VALUES ("hour");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="hour"), "Stunde");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="hour"), "heure");

INSERT INTO words(name) VALUES ("h");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="h"), "Std.");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="h"), "h");
INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="hour"),
          (SELECT id FROM words WHERE name="unit_time"),
          (SELECT id FROM words WHERE name="h"));


INSERT INTO words(name) VALUES ("day");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="day"), "Tag");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="day"), "jour");

INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="day"),
          (SELECT id FROM words WHERE name="unit_time"),
          (SELECT id FROM words WHERE name="day"));


INSERT INTO words(name) VALUES ("night");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="night"), "Nacht");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="night"), "nuit");

INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="night"),
          (SELECT id FROM words WHERE name="unit_time"),
          (SELECT id FROM words WHERE name="night"));



INSERT INTO words(name) VALUES ("teaspoon");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="teaspoon"), "Teelöffel");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="teaspoon"), "Cuillère à café");

INSERT INTO words(name) VALUES ("tsp");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="tsp"), "TL");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="tsp"), "cc");

INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="teaspoon"),
          (SELECT id FROM words WHERE name="unit_ingredient"),
          (SELECT id FROM words WHERE name="tsp"));


INSERT INTO words(name) VALUES ("tablespoon");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="tablespoon"), "Esslöffel");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="tablespoon"), "Cuillère à soupe");

INSERT INTO words(name) VALUES ("tbsp");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="tbsp"), "EL");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="tbsp"), "cs");

INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="tablespoon"),
          (SELECT id FROM words WHERE name="unit_ingredient"),
          (SELECT id FROM words WHERE name="tbsp"));


INSERT INTO words(name) VALUES ("glass");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="glass"), "Glas");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="glass"), "verre");

INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="glass"),
          (SELECT id FROM words WHERE name="unit_ingredient"),
          (SELECT id FROM words WHERE name="glass"));




INSERT INTO words(name) VALUES ("persons");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="persons"), "Personen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="persons"), "personnes");

INSERT INTO words(name) VALUES ("pers.");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="pers."), "Pers.");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="pers."), "pers.");

INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="persons"),
          (SELECT id FROM words WHERE name="unit_quantity"),
          (SELECT id FROM words WHERE name="pers."));


INSERT INTO words(name) VALUES ("pieces");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="pieces"), "Stücke");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="pieces"), "parts");

INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="pieces"),
          (SELECT id FROM words WHERE name="unit_quantity"),
          (SELECT id FROM words WHERE name="pieces"));




-- HTML
INSERT INTO words(name) VALUES ("Home");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Home"), "Startseite");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Home"), "Acceuil");

INSERT INTO words(name) VALUES ("confirm");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="confirm"), "bestätigen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="confirm"), "confirmer");

INSERT INTO words(name) VALUES ("edit");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="edit"), "anpassen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="edit"), "modifier");

INSERT INTO words(name) VALUES ("Add note");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Add note"), "Notiz hinzufügen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Add note"), "Ajouter une note");

INSERT INTO words(name) VALUES ("Add step");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Add step"), "Schritt hinzufügen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Add step"), "Ajouter une étape");

INSERT INTO words(name) VALUES ("Edit the recipe");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Edit the recipe"), "Rezept anpassen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Edit the recipe"), "Modifier la recette");

INSERT INTO words(name) VALUES ("Recipes");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Recipes"), "Kochrezepte");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Recipes"), "Recettes");

INSERT INTO words(name) VALUES ("Add a recipe");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Add a recipe"), "Rezept hinzufügen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Add a recipe"), "Ajouter une recette");

INSERT INTO words(name) VALUES ("Translations");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Translations"), "Übersetzungen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Translations"), "Traductions");


-- Error messages
INSERT INTO words(name) VALUES ("Duration is not a number");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Duration is not a number"), "Zeitdauer ist kein Nummer");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Duration is not a number"), "Durée non numérique");

INSERT INTO words(name) VALUES ("Invalid duration");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Invalid duration"), "Ungültige Zeitdauer");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Invalid duration"), "Durée invalide");

INSERT INTO words(name) VALUES ("Negative duration");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Negative duration"), "Negative Zeitdauer");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Negative duration"), "Durée négative");

INSERT INTO words(name) VALUES ("Empty ingredient name");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Empty ingredient name"), "Leere Zutatenname");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Empty ingredient name"), "Nom de l'ingredient requis"); -- '


-- Add recipe

INSERT INTO words(name) VALUES ('Unit');
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name='Unit'), 'Einheit');
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name='Unit'), 'unité');

INSERT INTO words(name) VALUES ('Name');
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name='Name'), 'Name');
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name='Name'), 'Nom');

INSERT INTO words(name) VALUES ("Summary");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Summary"), "Zusammenfassung");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Summary"), "Résumé");

INSERT INTO words(name) VALUES ("Time");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Time"), "Zeit");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Time"), "Temps");


INSERT INTO words(name) VALUES ("Time total");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Time total"), "Zeit total");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Time total"), "Temps total");

INSERT INTO words(name) VALUES ("Time preparation");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Time preparation"), "Zeit Vorbereitung");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Time preparation"), "Temps de préparation");

INSERT INTO words(name) VALUES ("Time crafting");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Time crafting"), "Zeit Handwerk");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Time crafting"), "Temps crafting");

INSERT INTO words(name) VALUES ("Time backing");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Time backing"), "Zeit Zubereitung");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Time backing"), "Temps cuisson");


INSERT INTO words(name) VALUES ("Metadata");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Metadata"), "Metadata");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Metadata"), "Metadata");

INSERT INTO words(name) VALUES ("Difficulty");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Difficulty"), "Schwierigkeit");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Difficulty"), "Difficulté");

INSERT INTO words(name) VALUES ("Annoyance");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Annoyance"), "Nervigkeit");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Annoyance"), "Agacement");

INSERT INTO words(name) VALUES ("Ideal number of cooks");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Ideal number of cooks"), "Empfohlene Koch-Anzahl");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Ideal number of cooks"), "Nombre idéal de cuisiniers");

INSERT INTO words(name) VALUES ("Vegetarian");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Vegetarian"), "Vegetarisch");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Vegetarian"), "Végétarien");

INSERT INTO words(name) VALUES ("Vegan");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Vegan"), "Vegan");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Vegan"), "Vegan");

INSERT INTO words(name) VALUES ("Origin");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Origin"), "Ursprungsort");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Origin"), "Origine");


INSERT INTO words(name) VALUES ("For");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="For"), "Für");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="For"), "Pour");

INSERT INTO words(name) VALUES ("Quantity");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Quantity"), "Menge");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Quantity"), "Quantité");


INSERT INTO words(name) VALUES ("Ingredients");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Ingredients"), "Zutaten");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Ingredients"), "Ingrédients");

INSERT INTO words(name) VALUES ("Add an ingredient");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Add an ingredient"), "Zutat hinzufügen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Add an ingredient"), "Ajouter un ingrédient");


INSERT INTO words(name) VALUES ("Steps");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Steps"), "Schritte");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Steps"), "Étapes");

INSERT INTO words(name) VALUES ("Notes");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Notes"), "Anmerkungen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Notes"), "Remarques");



INSERT INTO words(name) VALUES ("Add the recipe");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Add the recipe"), "Rezept hinzufügen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Add the recipe"), "Ajouter la recette");



INSERT INTO words(name) VALUES ("1 per line");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="1 per line"), "1 pro Linie");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="1 per line"), "1 par ligne");

-- Ingredients

INSERT INTO words(name) VALUES ("milk");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="milk"), "Milch");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="milk"), "lait");

INSERT INTO words(name) VALUES ("flour");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="flour"), "Mehl");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="flour"), "farine");

INSERT INTO words(name) VALUES ("butter");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="butter"), "Butter");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="butter"), "beurre");

INSERT INTO words(name) VALUES ("egg");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="egg"), "Ei");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="egg"), "oeuf");

INSERT INTO words(name) VALUES ("egg yolk");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="egg yolk"), "Eigelb");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="egg yolk"), "jaune d'oeuf"); -- '

INSERT INTO words(name) VALUES ("egg white");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="egg white"), "Eiweiß");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="egg white"), "blanc d'oeuf"); -- '

INSERT INTO words(name) VALUES ("bier");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="bier"), "Bier");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="bier"), "bière");

INSERT INTO words(name) VALUES ("oil");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="oil"), "Öl");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="oil"), "huile");

INSERT INTO words(name) VALUES ("carrot");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="carrot"), "Karotte");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="carrot"), "carotte");

INSERT INTO words(name) VALUES ("lemon");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="lemon"), "Zitron");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="lemon"), "citron");

INSERT INTO words(name) VALUES ("chicken cutlet");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="chicken cutlet"), "Hunchenbrust");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="chicken cutlet"), "escalope de poulet");

INSERT INTO words(name) VALUES ("rump steak");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="rump steak"), "Rumpsteak");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="rump steak"), "rumsteck");

INSERT INTO words(name) VALUES ("mushroom");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="mushroom"), "Pilze");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="mushroom"), "champignons");

INSERT INTO words(name) VALUES ("cream");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="cream"), "Crème fraiche");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="cream"), "crème fraiche");

INSERT INTO words(name) VALUES ("white wine");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="white wine"), "Weißwein");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="white wine"), "vin blanc");

INSERT INTO words(name) VALUES ("red wine");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="red wine"), "Rotwein");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="red wine"), "vin rouge");

INSERT INTO words(name) VALUES ("broth");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="broth"), "Brühe");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="broth"), "bouillon");

INSERT INTO words(name) VALUES ("puff pastry");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="puff pastry"), "Blätterteig");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="puff pastry"), "pâte feuilletée");

INSERT INTO words(name) VALUES ("rusk");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="rusk"), "Zwieback");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="rusk"), "biscotte");


.read ../custom/db/custom_values.sql
.read ../custom/db/db.patch
