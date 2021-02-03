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


INSERT INTO words(name) VALUES ("centiliter");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="centiliter"), "Centiliter");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="centiliter"), "centilitre");

INSERT INTO words(name) VALUES ("cL");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="cL"), "cL");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="cL"), "cL");

INSERT INTO units(id_word, id_type, id_symbol)
  VALUES ((SELECT id FROM words WHERE name="centiliter"),
          (SELECT id FROM words WHERE name="unit_ingredient"),
          (SELECT id FROM words WHERE name="cL"));



INSERT INTO words(name) VALUES ("second");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="second"), "Sekude");
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
  VALUES (2, (SELECT id FROM words WHERE name="glass"), "Glass");
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
INSERT INTO words(name) VALUES ("home");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="home"), "Startseite");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="home"), "Acceuil");


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
  VALUES (2, (SELECT id FROM words WHERE name="Time backing"), "Zeit kochen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Time backing"), "Temps cuisson");


INSERT INTO words(name) VALUES ("Metadata");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Metadata"), "Metadata");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Metadata"), "Metadata");

INSERT INTO words(name) VALUES ("Difficulty");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Difficulty"), "Schwerigkeit");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Difficulty"), "Difficulté");

INSERT INTO words(name) VALUES ("Annoyance");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Annoyance"), "Ärger");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Annoyance"), "Agacement");

INSERT INTO words(name) VALUES ("Ideal number of people");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Ideal number of people"), "Ideal Menge Köcher");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Ideal number of people"), "Nombre idéal de personnes");


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



INSERT INTO words(name) VALUES ("one per line");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="one per line"), "eins pro Linie");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="one per line"), "une par ligne");

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
  VALUES (2, (SELECT id FROM words WHERE name="red wine"), "Brühe");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="red wine"), "bouillon");

INSERT INTO words(name) VALUES ("puff pastry");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="red wine"), "Blätterteig");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="red wine"), "pâte feuilletée");




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


INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="egg")),
          4, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="-")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="flour")),
          500, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="gram")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="milk")),
          1, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="liter")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="bier")),
          "1/4", (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="liter")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Pancakes (Crêpes)")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="oil")),
          3, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="teaspoon")));



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





INSERT INTO words(name) VALUES ("Quenelle");
INSERT INTO ingredients(id) VALUES (last_insert_rowid());
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Quenelle"), "Grießklößchen");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Quenelle"), "Quenelle");

INSERT INTO recipes(id_word, time_total, time_preparation, time_crafting, time_backing,
                    quantity, difficulty, annoyance, threads)
  VALUES ((SELECT id FROM words WHERE name="Quenelle"), 45, 0, 15, 30, 8, 2, 3, 1);



INSERT INTO words(name) VALUES ("Bouchées à la reine");
INSERT INTO translations(id_language, id_word, name)
  VALUES (2, (SELECT id FROM words WHERE name="Bouchées à la reine"), "Königin Pasteten");
INSERT INTO translations(id_language, id_word, name)
  VALUES (3, (SELECT id FROM words WHERE name="Bouchées à la reine"), "Bouchées à la reine");

INSERT INTO recipes(id_word, time_total, time_preparation, time_crafting, time_backing,
                    quantity, difficulty, annoyance, threads)
  VALUES ((SELECT id FROM words WHERE name="Bouchées à la reine"), 90, 0, 90, 45, 6, 3, 4, 3);


INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="Quenelle")),
          8, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="-")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="chicken cutlet")),
          2, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="-")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="rump steak")),
          300, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="gram")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="mushroom")),
          "200", (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="gram")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="white wine")),
          "1", (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="glas")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="egg yolk")),
          3, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="-")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="flour")),
          3, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="tablespoon")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="butter")),
          45, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="gram")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="cream")),
          10, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="centiliter")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="broth")),
          3/4, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="liter")));

INSERT INTO requirements(id_recipe, id_ingredient, quantity, id_unit)
  VALUES ((SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
          (SELECT id FROM ingredients WHERE id=(SELECT id FROM words WHERE name="puff pastry")),
          2, (SELECT id FROM units WHERE id_word=(SELECT id FROM words WHERE name="-")));



INSERT INTO words(name) VALUES ("Prepare the quenelles (in a poultry broth); remove them");
INSERT INTO steps(id_language, id_recipe, num, description)
 VALUES ((SELECT id FROM languages WHERE id=1),
         (SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
         1, last_insert_rowid());

INSERT INTO words(name) VALUES ("Prepare (and cook) the dough basis");
INSERT INTO steps(id_language, id_recipe, num, description)
 VALUES ((SELECT id FROM languages WHERE id=1),
         (SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
         2, last_insert_rowid());

INSERT INTO words(name) VALUES ("Cut the meat in dices; the mushrooms and quenelles in slices");
INSERT INTO steps(id_language, id_recipe, num, description)
 VALUES ((SELECT id FROM languages WHERE id=1),
         (SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
         3, last_insert_rowid());

INSERT INTO words(name) VALUES ("Melt the butter; merge it with the broth (where the quenelles were); make it boil");
INSERT INTO steps(id_language, id_recipe, num, description)
VALUES ((SELECT id FROM languages WHERE id=1),
         (SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
         4, last_insert_rowid());

INSERT INTO words(name) VALUES ("Add the meat, mushrooms, quenelles");
INSERT INTO steps(id_language, id_recipe, num, description)
 VALUES ((SELECT id FROM languages WHERE id=1),
         (SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
         5, last_insert_rowid());

INSERT INTO words(name) VALUES ("Merge the egg yolks with the cream; add it to the broth; reduce the firepower");
INSERT INTO steps(id_language, id_recipe, num, description)
 VALUES ((SELECT id FROM languages WHERE id=1),
         (SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
         6, last_insert_rowid());



INSERT INTO words(name) VALUES ("Monthly bouffe January 2021; Ratings C|S: 4|4");
INSERT INTO notes(id_language, id_recipe, description)
 VALUES ((SELECT id FROM languages WHERE id=1),
         (SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
         last_insert_rowid());

INSERT INTO words(name) VALUES ("2 persons minimum");
INSERT INTO notes(id_language, id_recipe, description)
 VALUES ((SELECT id FROM languages WHERE id=1),
         (SELECT id FROM recipes WHERE id_word=(SELECT id FROM WORDS WHERE name="Bouchées à la reine")),
         last_insert_rowid());
