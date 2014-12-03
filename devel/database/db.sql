PRAGMA foreign_keys = on;
/* drop all tables */
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Poll;
DROP TABLE IF EXISTS Question;
DROP TABLE IF EXISTS Answer;
DROP TABLE IF EXISTS Link;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS PollCategory;
DROP TABLE IF EXISTS Message;


/* Users */
CREATE TABLE IF NOT EXISTS User (
  idUser    INTEGER PRIMARY KEY,
  username  VARCHAR(16)     NOT NULL,
  name      VARCHAR         NOT NULL,
  town      VARCHAR         NOT NULL,
  password  VARCHAR         NOT NULL,
  email     VARCHAR UNIQUE  NOT NULL,
  ocupation VARCHAR         NOT NULL,
  fotograph VARCHAR,
  CHECK (length(password) > 8),
  CHECK (length(username) > 6)
);

/* Polls */
CREATE TABLE IF NOT EXISTS Poll (
  idPoll         INTEGER PRIMARY KEY,
  title          VARCHAR(85) NOT NULL,
  data_post      DATE DEFAULT CURRENT_DATE,
  fotograph      VARCHAR     NOT NULL,
  idCreator      INTEGER REFERENCES User ON DELETE CASCADE,
  pollPermission VARCHAR CHECK (pollPermission LIKE 'public' OR pollPermission LIKE 'private'),
  pollState      VARCHAR CHECK (pollState LIKE 'opened' OR pollState LIKE 'closed')
);

/* Questions */
CREATE TABLE IF NOT EXISTS Question (
  idQuestion INTEGER PRIMARY KEY,
  idPoll     INTEGER REFERENCES Poll ON DELETE CASCADE
);

/* Answers */
CREATE TABLE IF NOT EXISTS Answer (
  idAnswer     INTEGER PRIMARY KEY,
  idRespondent INTEGER REFERENCES User ON DELETE CASCADE,
  idQuestion   INTEGER REFERENCES Question ON DELETE CASCADE
);

/* Links */
CREATE TABLE IF NOT EXISTS Link (
  href     VARCHAR PRIMARY KEY  NOT NULL,
  homeLink VARCHAR              NOT NULL
);

/* Links to Polls */
CREATE TABLE IF NOT EXISTS LinkPoll (
  idPoll INTEGER,
  href   VARCHAR,
  FOREIGN KEY (idPoll) REFERENCES Poll ON DELETE CASCADE,
  FOREIGN KEY (href) REFERENCES Link ON DELETE CASCADE
);

/* Categories */
CREATE TABLE IF NOT EXISTS Category (
  idCategory INTEGER PRIMARY KEY,
  name       VARCHAR NOT NULL
);

/* Polls Categories */
CREATE TABLE IF NOT EXISTS PollCategory (
  idPoll     INTEGER,
  idCategory INTEGER,
  UNIQUE (idPoll, idCategory),
  FOREIGN KEY (idPoll) REFERENCES Poll ON DELETE CASCADE,
  FOREIGN KEY (idCategory) REFERENCES Category ON DELETE CASCADE
);
/* Messages */
CREATE TABLE IF NOT EXISTS Message (
  idMessage INTEGER PRIMARY KEY,
  sender    VARCHAR(16) REFERENCES User ON DELETE CASCADE,
  receiver  VARCHAR(16) REFERENCES User ON DELETE CASCADE,
  title     VARCHAR      NOT NULL,
  content   VARCHAR(140) NOT NULL
);


/* POPULATING DB */


/* id, username, name, town, password, email, ocupation, photograph */
INSERT INTO User
VALUES (1, 'luisreis', 'Luis Reis', 'Porto', 'projetoltw', 'luisreis@fe.up.pt', 'student', 'path');
INSERT INTO User
VALUES (2, 'joaocardoso', 'Joao Cardoso', 'Porto', 'projetoltw', 'joaocardoso@fe.up.pt', 'student', 'path');

/* id, title, data_post, photograph, idCreator, pollPermission, pollState */
INSERT INTO Poll VALUES (1, 'First Poll', '26-11-2014', 'path', 1, 'public', 'opened');

/* id, Poll */
INSERT INTO Question VALUES (1, 1);

/* id, Respondant, Question */
INSERT INTO Answer VALUES (1, 1, 1);

/* href, link */
INSERT INTO Link VALUES ('http://abola.pt/nnh/ver.aspx?id=482248', 'abola.pt');

/* Poll, link */
INSERT INTO LinkPoll VALUES (1, 'http://abola.pt/nnh/ver.aspx?id=482248');

/* id, name */
INSERT INTO Category VALUES (1, 'Desporto');

/* Poll, Category */
INSERT INTO PollCategory VALUES (1, '1');

/* id, Sender, Receiver, title, content */
INSERT INTO Message VALUES (1, 1, 2, 'sem titulo', 'mensagem generica');



