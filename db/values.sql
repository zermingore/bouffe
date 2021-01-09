INSERT INTO languages(id, name) VALUES(1, "english");
INSERT INTO languages(id, name) VALUES(2, "deutsch");
INSERT INTO languages(id, name) VALUES(3, "français");

INSERT INTO translations(id_language, content) VALUES (1, 'gram');
INSERT INTO quantities(id_translation, symbol) VALUES (last_insert_rowid(), "g");
INSERT INTO translations(id_language, content) VALUES (2, 'Gramm');
INSERT INTO quantities(id_translation, symbol) VALUES (last_insert_rowid(), "g");
INSERT INTO translations(id_language, content) VALUES (3, 'gramme');
INSERT INTO quantities(id_translation, symbol) VALUES (last_insert_rowid(), "g");

INSERT INTO translations(id_language, content) VALUES (1, 'liter');
INSERT INTO quantities(id_translation, symbol) VALUES (last_insert_rowid(), "L");
INSERT INTO translations(id_language, content) VALUES (2, 'Liter');
INSERT INTO quantities(id_translation, symbol) VALUES (last_insert_rowid(), "L");
INSERT INTO translations(id_language, content) VALUES (3, 'litre');
INSERT INTO quantities(id_translation, symbol) VALUES (last_insert_rowid(), "L");

INSERT INTO translations(id_language, content) VALUES (1, 'minutes');
INSERT INTO quantities(id_translation, symbol) VALUES (last_insert_rowid(), "min");
INSERT INTO translations(id_language, content) VALUES (2, 'Minuten');
INSERT INTO quantities(id_translation, symbol) VALUES (last_insert_rowid(), "min");
INSERT INTO translations(id_language, content) VALUES (3, 'minutes');
INSERT INTO quantities(id_translation, symbol) VALUES (last_insert_rowid(), "min");

INSERT INTO translations(id_language, content) VALUES (1, 'hours');
INSERT INTO quantities(id_translation, symbol) VALUES (last_insert_rowid(), "h");
INSERT INTO translations(id_language, content) VALUES (2, 'Stunde');
INSERT INTO quantities(id_translation, symbol) VALUES (last_insert_rowid(), "h");
INSERT INTO translations(id_language, content) VALUES (3, 'heures');
INSERT INTO quantities(id_translation, symbol) VALUES (last_insert_rowid(), "h");



INSERT INTO translations(id_language, content) VALUES (1, 'milk');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (2, 'Milch');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (3, 'lait');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());

INSERT INTO translations(id_language, content) VALUES (1, 'flour');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (2, 'Mehl');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (3, 'farine');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());

INSERT INTO translations(id_language, content) VALUES (1, 'eggs');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (2, 'Eier');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (3, 'oeufs');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());

INSERT INTO translations(id_language, content) VALUES (1, 'bier');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (2, 'Bier');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (3, 'bière');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());

INSERT INTO translations(id_language, content) VALUES (1, 'oil');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (2, 'Öl');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (3, 'huile');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());

INSERT INTO translations(id_language, content) VALUES (1, 'carrots');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (2, 'Karotten');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (3, 'carottes');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());

INSERT INTO translations(id_language, content) VALUES (1, 'lemons');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (2, 'Zitronen');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (3, 'citrons');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());



INSERT INTO translations(id_language, content) VALUES (1, 'Pancakes (Crêpes)');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (2, 'Pfankuchen (Crêpes)');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, content) VALUES (3, 'Crêpes');
INSERT INTO ingredients(id) VALUES (last_insert_rowid());

INSERT INTO translations(id_language, content) VALUES (1, 'Carrots cake');
INSERT INTO recipes(name) VALUES (last_insert_rowid());
