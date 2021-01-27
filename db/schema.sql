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

  FOREIGN KEY(id) REFERENCES words(id)
);



CREATE TABLE units(
  id INTEGER PRIMARY KEY,
  id_word INTEGER NOT NULL,
  id_type INTEGER NOT NULL,
  id_symbol INTEGER NOT NULL,

  FOREIGN KEY(id_word) REFERENCES words(id)
  FOREIGN KEY(id_type) REFERENCES words(id)
  FOREIGN KEY(id_symbol) REFERENCES words(id)
);



CREATE TABLE requirements(
  id_recipe INTEGER NOT NULL,
  id_ingredient INTEGER NOT NULL,
  quantity INTEGER,
  id_unit INTEGER,

  FOREIGN KEY(id_ingredient) REFERENCES ingredients(id)
  FOREIGN KEY(id_unit) REFERENCES units(id)
);



CREATE TABLE steps(
  id INTEGER PRIMARY KEY,
  id_language INTEGER NOT NULL,
  id_recipe INTEGER NOT NULL,
  num INTEGER NOT NULL,
  description INTEGER NOT NULL,

  FOREIGN KEY(description) REFERENCES words(id)
  FOREIGN KEY(id_recipe) REFERENCES recipes(id)
);



CREATE TABLE notes(
  id INTEGER PRIMARY KEY,
  id_language INTEGER NOT NULL,
  id_recipe INTEGER NOT NULL,
  description INTEGER NOT NULL,

  FOREIGN KEY(description) REFERENCES words(id)
  FOREIGN KEY(id_recipe) REFERENCES recipes(id)
);



CREATE TABLE recipes(
  id INTEGER PRIMARY KEY,
  id_word INTEGER NOT NULL,
  summary INTEGER,

  time_total,       -- minutes
  time_preparation, -- minutes
  time_crafting,    -- minutes
  time_backing,     -- minutes

  quantity INTEGER DEFAULT 1,
  quantity_unit INTEGER,
  difficulty INTEGER,
  annoyance INTEGER,
  threads INTEGER,

  FOREIGN KEY(id_word) REFERENCES words(id)
  FOREIGN KEY(summary) REFERENCES translations(id)
  FOREIGN KEY(quantity_unit) REFERENCES units(id)
);



.read values.sql



COMMIT;
