PRAGMA foreign_keys = on;

/* drop all tables */
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Poll;
DROP TABLE IF EXISTS Question;
DROP TABLE IF EXISTS Answer;
DROP TABLE IF EXISTS Vote;
DROP TABLE IF EXISTS Link;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS PollCategory;
DROP TABLE IF EXISTS Message;


/* Users */
CREATE TABLE IF NOT EXISTS User (
  idUser    INTEGER PRIMARY KEY,
  username  VARCHAR(16)     NOT NULL,
  name      VARCHAR         NOT NULL,
  password  VARCHAR         NOT NULL,
  email     VARCHAR UNIQUE  NOT NULL,
  CHECK (length(password) > 8),
  CHECK (length(username) > 6)
);

/* Polls */
CREATE TABLE IF NOT EXISTS Poll (
  idPoll         INTEGER PRIMARY KEY,
  title          VARCHAR(85) NOT NULL,
  data_post      DATE DEFAULT CURRENT_DATE,
  pic VARCHAR NOT NULL,
  idCreator      INTEGER REFERENCES User ON DELETE CASCADE,
  pollPermission VARCHAR CHECK (pollPermission LIKE 'public' OR pollPermission LIKE 'private'),
  pollState      VARCHAR CHECK (pollState LIKE 'opened' OR pollState LIKE 'closed')
);

/* Questions */
CREATE TABLE IF NOT EXISTS Question (
  idQuestion INTEGER PRIMARY KEY,
  idPoll   INTEGER REFERENCES Poll ON DELETE CASCADE,
  question VARCHAR
);

/* Answers */
CREATE TABLE IF NOT EXISTS Answer (
  idAnswer     INTEGER PRIMARY KEY,
  idQuestion INTEGER REFERENCES Question ON DELETE CASCADE,
  answer     VARCHAR,
  Votes      INTEGER
);

/* Votes */
CREATE TABLE IF NOT EXISTS Vote (
  idQuestion   INTEGER REFERENCES Question ON DELETE CASCADE, /* para verificar que um user só tem 1 voto por pergunta vê-se pela relacao idAnswer-idRespondent */
  idRespondent INTEGER REFERENCES User ON DELETE CASCADE,
  idAnswer     INTEGER REFERENCES Answer ON DELETE CASCADE,
  vote         INTEGER NOT NULL,
  CHECK (vote = 1)
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


/* id, username, name, password, email, ,  */
INSERT INTO User
VALUES (1, 'luisreis', 'Luis Reis', 'projetoltw', 'luisreis@fe.up.pt');
INSERT INTO User
VALUES (2, 'joaocardoso', 'Joao Cardoso', 'projetoltw', 'joaocardoso@fe.up.pt');

/* id, title, data_post, pic, idCreator, pollPermission, pollState */
INSERT INTO Poll VALUES (1, 'First Poll', '26-11-2014', 'path', 1, 'public', 'opened');

/* id, Poll */
INSERT INTO Question VALUES (1, 1, 'Quem gosta deste site?');

/* id, Question, Answer */
INSERT INTO Answer VALUES (1, 1, 'Eu');
INSERT INTO Answer VALUES (2, 1, 'Eu Nao');

/* idQuestion, idRespondant, idAnswer, vote */
INSERT INTO Vote VALUES (1, 1, 1, 1);
INSERT INTO Vote VALUES (1, 2, 2, 1);

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



