pragma foreign_keys = on;

BEGIN TRANSACTION;

CREATE table version(major, minor, patch);
INSERT INTO version VALUES(0, 0, 1);



CREATE TABLE languages(
  id INTEGER NOT NULL,
  name TEXT
);



CREATE TABLE translations(
  id INTEGER NOT NULL,
  id_language INTEGER NOT NULL,
  content TEXT,

  FOREIGN KEY(id_language) REFERENCES languages(id)
);



CREATE TABLE ingredients(
  id INTEGER NOT NULL,
  name INTEGER,

  FOREIGN KEY(name) REFERENCES translations(id)
);



CREATE TABLE quantities(
  id INTEGER NOT NULL,
  name INTEGER NOT NULL,
  symbol TEXT,

  FOREIGN KEY(name) REFERENCES translations(id)
);



CREATE TABLE requirements(
  id_recipe INTEGER NOT NULL,
  id_ingredient INTEGER NOT NULL,
  quantity INTEGER,
  id_quantity_unit INTEGER
);



CREATE TABLE steps(
  id INTEGER NOT NULL,
  id_recipe INTEGER NOT NULL,
  num INTEGER NOT NULL,
  description INTEGER NOT NULL,

  FOREIGN KEY(description) REFERENCES translations(id)
  FOREIGN KEY(id_recipe) REFERENCES recipe(id)
);



CREATE TABLE recipe(
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



COMMIT;
