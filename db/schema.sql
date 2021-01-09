pragma foreign_keys = on;

BEGIN TRANSACTION;

CREATE table version(major, minor, patch);
INSERT INTO version VALUES(0, 0, 1);



CREATE TABLE languages(
  id INTEGER PRIMARY KEY,
  name TEXT NOT NULL
);



CREATE TABLE words(
  id INTEGER PRIMARY KEY,
  name TEXT NOT NULL
);



CREATE TABLE translations(
  id INTEGER PRIMARY KEY,
  id_language INTEGER NOT NULL,
  id_word INTEGER NOT NULL,
  name TEXT NOT NULL,

  FOREIGN KEY(id_language) REFERENCES languages(id),
  FOREIGN KEY(id_word) REFERENCES words(id)
);



CREATE TABLE ingredients(
  id INTEGER PRIMARY KEY,

  FOREIGN KEY(id) REFERENCES translations(id)
);



CREATE TABLE quantities(
  id INTEGER PRIMARY KEY,
  id_word INTEGER NOT NULL,
  symbol TEXT,

  FOREIGN KEY(id_word) REFERENCES words(id)
);



CREATE TABLE requirements(
  id_recipe INTEGER PRIMARY KEY,
  id_ingredient INTEGER NOT NULL,
  quantity INTEGER,
  id_quantity_unit INTEGER,

  FOREIGN KEY(id_ingredient) REFERENCES ingredients(id)
);



CREATE TABLE steps(
  id INTEGER PRIMARY KEY,
  id_recipe INTEGER NOT NULL,
  num INTEGER NOT NULL,
  description INTEGER NOT NULL,

  FOREIGN KEY(description) REFERENCES translations(id)
  FOREIGN KEY(id_recipe) REFERENCES recipe(id)
);



CREATE TABLE recipes(
  id INTEGER PRIMARY KEY,
  name INTEGER NOT NULL,
  description INTEGER,
  time_total,       -- minutes
  time_preparation, -- minutes
  time_crafting,    -- minutes
  time_backing,     -- minutes

  FOREIGN KEY(name) REFERENCES translations(id)
  FOREIGN KEY(description) REFERENCES translations(id)
);



.read values.sql



COMMIT;
