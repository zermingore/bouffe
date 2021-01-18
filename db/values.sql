INSERT INTO languages(id, name) VALUES(1, "english");
INSERT INTO languages(id, name) VALUES(2, "deutsch");
INSERT INTO languages(id, name) VALUES(3, "français");


INSERT INTO words(name) VALUES ("gram");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="gram"), "Gramm");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="gram"), "gramme");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (1, (SELECT id from words where name="gram"), "g");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (2, (SELECT id from words where name="gram"), "g");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (3, (SELECT id from words where name="gram"), "g");

INSERT INTO words(name) VALUES ("liter");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="liter"), "Liter");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="liter"), "litre");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (1, (SELECT id from words where name="liter"), "L");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (2, (SELECT id from words where name="liter"), "L");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (3, (SELECT id from words where name="liter"), "L");

INSERT INTO words(name) VALUES ("minute");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="minute"), "Minuten");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="minute"), "minute");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (1, (SELECT id from words where name="minute"), "min");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (2, (SELECT id from words where name="minute"), "min");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (3, (SELECT id from words where name="minute"), "min");

INSERT INTO words(name) VALUES ("hour");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="hour"), "Stunde");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="hour"), "heure");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (1, (SELECT id from words where name="hour"), "h");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (2, (SELECT id from words where name="hour"), "h");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (3, (SELECT id from words where name="hour"), "h");

INSERT INTO words(name) VALUES ("teaspoon");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="teaspoon"), "Teelöffel");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="teaspoon"), "Cuillère à café");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (1, (SELECT id from words where name="teaspoon"), "tsp");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (2, (SELECT id from words where name="teaspoon"), "TL");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (3, (SELECT id from words where name="teaspoon"), "cc");

-- None
INSERT INTO words(name) VALUES ("-");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="-"), "-");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="-"), "-");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (1, (SELECT id from words where name="-"), "-");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (2, (SELECT id from words where name="-"), "-");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (3, (SELECT id from words where name="-"), "-");



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


INSERT INTO requirements(id_recipe, id_ingredient, quantity)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="egg")), 4);

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_quantity_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="flour")),
          500, (SELECT id FROM quantities WHERE id=(SELECT id FROM words WHERE name="gram")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_quantity_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="milk")),
          1, (SELECT id FROM quantities WHERE id=(SELECT id FROM words WHERE name="liter")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_quantity_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="bier")),
          "1/4", (SELECT id FROM quantities WHERE id=(SELECT id FROM words WHERE name="liter")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_quantity_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="oil")),
          3, (SELECT id FROM quantities WHERE id=(SELECT id FROM words WHERE name="teaspoon")));



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
