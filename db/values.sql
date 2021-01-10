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

INSERT INTO words(name) VALUES ("minutes");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="minutes"), "Minuten");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="minutes"), "minutes");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (1, (SELECT id from words where name="minutes"), "min");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (2, (SELECT id from words where name="minutes"), "min");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (3, (SELECT id from words where name="minutes"), "min");

INSERT INTO words(name) VALUES ("hours");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="hours"), "Stunden");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="hours"), "heures");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (1, (SELECT id from words where name="hours"), "h");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (2, (SELECT id from words where name="hours"), "h");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (3, (SELECT id from words where name="hours"), "h");

INSERT INTO words(name) VALUES ("teaspoon");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="teaspoon"), "Teelöffel");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="teaspoon"), "Cuillère à café");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (1, (SELECT id from words where name="teaspoon"), "tsp");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (2, (SELECT id from words where name="teaspoon"), "TL");
INSERT INTO quantities(id_language, id_word, symbol) VALUES (3, (SELECT id from words where name="teaspoon"), "cc");



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

INSERT INTO words(name) VALUES ("eggs");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="eggs"), "Eier");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="eggs"), "oeufs");

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

INSERT INTO words(name) VALUES ("carrots");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="carrots"), "Karotten");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="carrots"), "carottes");

INSERT INTO words(name) VALUES ("lemons");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="lemons"), "Zitronen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="lemons"), "citrons");




INSERT INTO words(name) VALUES ("Carrots cake");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Carrots cake"), "Karottenkuchen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Carrots cake"), "Gâteau aux carottes");

INSERT INTO recipes(name, time_total, time_preparation, time_crafting, time_backing)
  VALUES ((SELECT id FROM words WHERE name="Carrots cake"), 75, 0, 60, 60);


INSERT INTO words(name) VALUES ("Pancakes (Crêpes)");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Pancakes (Crêpes)"), "Pfankuchen (Crêpes)");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Pancakes (Crêpes)"), "Crêpes");

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_quantity_unit)
  VALUES ((SELECT id FROM recipes WHERE name="Pancakes (Crêpes)"),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="oil")),
          3, (SELECT id FROM quantities WHERE id=(SELECT id FROM words WHERE name="teaspoon")));
