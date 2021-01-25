INSERT INTO languages(id, name) VALUES(1, "english");
INSERT INTO languages(id, name) VALUES(2, "deutsch");
INSERT INTO languages(id, name) VALUES(3, "français");

INSERT INTO words(name) VALUES ("-"); -- Should be the first word

-- Units categories
INSERT INTO words(name) VALUES ("unit_none");
INSERT INTO words(name) VALUES ("unit_ingredient");
INSERT INTO words(name) VALUES ("unit_time");


INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="-"),
    (SELECT id FROM words WHERE name="-"));
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="-"),
    (SELECT id FROM words WHERE name="-"));
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
  VALUES (2, (SELECT id FROM words WHERE name="h"), "S");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="h"), "h");
INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="hour"),
          (SELECT id FROM words WHERE name="unit_time"),
          (SELECT id FROM words WHERE name="h"));


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




-- HTML

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

INSERT INTO words(name) VALUES ("egg");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="egg"), "Ei");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="egg"), "oeuf");

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




INSERT INTO words(name) VALUES ("Carrots cake");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Carrots cake"), "Karottenkuchen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Carrots cake"), "Gâteau aux carottes");

INSERT INTO recipes(id_word,
                    time_total, time_preparation, time_crafting, time_backing,
                    quantity, difficulty, annoyance, threads)
  VALUES ((SELECT id FROM words WHERE name="Carrots cake"), 120, 0, 60, 60, "8 personnes", 2, 4, 4);


INSERT INTO words(name) VALUES ("Pancakes (Crêpes)");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Pancakes (Crêpes)"), "Pfankuchen (Crêpes)");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Pancakes (Crêpes)"), "Crêpes");

INSERT INTO recipes(id_word, time_total, time_preparation, time_crafting, time_backing,
                    quantity, difficulty, annoyance, threads)
  VALUES ((SELECT id FROM words WHERE name="Pancakes (Crêpes)"), 140, 90, 5, 45, 20, 1, 1, 1);


INSERT INTO requirements(id_recipe, id_ingredient, unit, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="egg")),
          4, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="-")));

INSERT INTO requirements(id_recipe, id_ingredient, unit, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="flour")),
          500, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="gram")));

INSERT INTO requirements(id_recipe, id_ingredient, unit, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="milk")),
          1, (SELECT id FROM units WHERE id=(SELECT id FROM words WHERE name="liter")));

INSERT INTO requirements(id_recipe, id_ingredient, unit, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="bier")),
          "1/4", (SELECT id FROM units WHERE id=(SELECT id FROM words WHERE name="liter")));

INSERT INTO requirements(id_recipe, id_ingredient, unit, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="oil")),
          3, (SELECT id FROM units WHERE id=(SELECT id FROM words WHERE name="teaspoon")));



INSERT INTO words(name) VALUES ("Mix everything");
INSERT INTO steps(id_language, id_recipe, num, description)
 VALUES ((SELECT id FROM languages WHERE id=1),
         (SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
         1, last_insert_rowid());

INSERT INTO words(name) VALUES ("Wait at least one hour or destroy any lump");
INSERT INTO steps(id_language, id_recipe, num, description)
 VALUES ((SELECT id FROM languages WHERE id=1),
         (SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
         2, last_insert_rowid());


INSERT INTO words(name) VALUES ("It is much easier to just let it rest ~4h");
INSERT INTO notes(id_language, id_recipe, description)
 VALUES ((SELECT id FROM languages WHERE id=1),
         (SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
         last_insert_rowid());
