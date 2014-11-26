/* drop all tables */
DROP TABLE IF EXISTS User CASCADE;
DROP TABLE IF EXISTS Poll CASCADE;
DROP TABLE IF EXISTS Question CASCADE;
DROP TABLE IF EXISTS Answer CASCADE;
DROP TABLE IF EXISTS Link CASCADE;
DROP TABLE IF EXISTS Category CASCADE;
DROP TABLE IF EXISTS PollCategory CASCADE;
DROP TABLE IF EXISTS Message CASCADE;


CREATE TYPE permission AS ENUM ('public', 'private');
CREATE TYPE state AS ENUM ('opened', 'closed');


/* Users */
CREATE TABLE IF NOT EXISTS User (
  idUser   SERIAL PRIMARY KEY,
  username VARCHAR(16)     NOT NULL,
  name     VARCHAR         NOT NULL,
  town     VARCHAR NOT NULL,
  password VARCHAR NOT NULL,
  email    VARCHAR UNIQUE  NOT NULL,
	ocupation 	VARCHAR 		NOT NULL,
	fotograph 	VARCHAR,
	CHECK (char_length(pass) > 8),
	CHECK (char_length(username) > 6)
);

/* Polls */
CREATE TABLE IF NOT EXISTS Poll (
  idPoll         SERIAL PRIMARY KEY,
  title          VARCHAR(85) NOT NULL,
  data_post      DATE DEFAULT CURRENT_DATE,
  fotograph      VARCHAR     NOT NULL,
  idCreator      INTEGER REFERENCES User ON DELETE CASCADE,
  pollPermission permission,
  pollState      state

);

/* Questions */
CREATE TABLE IF NOT EXISTS Question (
	idQuestion 	SERIAL PRIMARY KEY,
  idPoll INTEGER REFERENCES Poll ON DELETE CASCADE
);

/* Answers */
CREATE TABLE IF NOT EXISTS Answer (
  idAnswer     SERIAL PRIMARY KEY,
  idRespondent INTEGER REFERENCES User ON DELETE CASCADE,
  idQuestion   INTEGER REFERENCES Question ON DELETE CASCADE
);

/* Links */
CREATE TABLE IF NOT EXISTS Link (
	href     VARCHAR PRIMARY KEY 	NOT NULL,
	homeLink VARCHAR             	NOT NULL
);

/* Categories */
CREATE TABLE IF NOT EXISTS Category (
	idCategory	SERIAL 	PRIMARY KEY,
  name VARCHAR NOT NULL
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
  idMessage 	SERIAL PRIMARY KEY,
  sender   VARCHAR(16) REFERENCES User ON DELETE CASCADE,
  receiver VARCHAR(16) REFERENCES User ON DELETE CASCADE,
  title    VARCHAR      NOT NULL,
  content  VARCHAR(140) NOT NULL
);


/* POPULATING DB */


/* id, username, name, town, password, email, ocupation, photograph */
INSERT INTO User
VALUES (DEFAULT, 'luisreis', 'Luis Reis', 'Porto', 'projetoltw', 'luisreis@fe.up.pt', 'student', 'path');
INSERT INTO User
VALUES (DEFAULT, 'joaocardoso', 'Joao Cardoso', 'Porto', 'projetoltw', 'joaocardoso@fe.up.pt', 'student', 'path');

/* id, title, data_post, photograph, idCreator, pollPermission, pollState */
INSERT INTO Poll VALUES (DEFAULT, 'First Poll', '26-11-2014', 'path', 1, 'public', 'opened');

/* id, Poll */
INSERT INTO Question VALUES (DEFAULT, 1);

/* id, Respondant, Question */
INSERT INTO Answer VALUES (DEFAULT, 1, 1);

/* href, link */
INSERT INTO Link VALUES ('http://qualquercoisa', 'site');

/* id, name */
INSERT INTO Category VALUES (DEFAULT, 'Desporto');

/* Poll, Category */
INSERT INTO PollCategory VALUES (1, '1');

/* id, Sender, Receiver, title, content */
INSERT INTO Message VALUES (DEFAULT, 1, 2, 'sem titulo', 'mensagem generica');


/* TRIGGERS */