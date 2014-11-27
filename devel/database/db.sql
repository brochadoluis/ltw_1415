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

/* Links to Polls */
CREATE TABLE IF NOT EXISTS LinkPoll (
  idPoll INTEGER,
  href   VARCHAR,
  FOREIGN KEY (idPoll) REFERENCES Poll ON DELETE CASCADE,
  FOREIGN KEY (href) REFERENCES Link ON DELETE CASCADE
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
INSERT INTO Link VALUES ('http://abola.pt/nnh/ver.aspx?id=482248', 'abola.pt');

/* Poll, link */
INSERT INTO LinkPoll VALUES (1, 'http://abola.pt/nnh/ver.aspx?id=482248');

/* id, name */
INSERT INTO Category VALUES (DEFAULT, 'Desporto');

/* Poll, Category */
INSERT INTO PollCategory VALUES (1, '1');

/* id, Sender, Receiver, title, content */
INSERT INTO Message VALUES (DEFAULT, 1, 2, 'sem titulo', 'mensagem generica');


/* SELECTS, UPDATES AND TRIGGERS */

/* Find user by username */
SELECT
  *
FROM User
WHERE username = 'filetez';

/* Find poll by category */
SELECT
  Poll.idPoll,
  Poll.title,
  Poll
FROM PollCategory, Poll, Category
WHERE PollCategory.idPoll = Poll.idPoll AND PollCategory.name = Category.name AND Category.name LIKE 'Desporto';

/* Find links to poll */
SELECT
  Poll.idPoll,
  Link.homeLink
FROM Poll, Link, LinkPoll
WHERE Poll.idPoll = LinkPoll.idPoll AND LinkPoll.href = Link.href AND Poll.idPoll = 1;

/* Messages sent by user X */
SELECT
  User.name,
  User.username,
  Message.title,
  Message.content
FROM User, Message
WHERE Message.sender = User.username AND Message.receiver != User.username AND User.idUser LIKE 1;

/* Messages received by user Y */
SELECT
  User.name,
  User.username,
  Message.title,
  Message.content
FROM User, Message
WHERE Message.sender != User.username AND Message.receiver = User.username AND User.idUser LIKE 2;

/* POLL UPDATE */

/* Private Poll */
UPDATE Poll
SET pollPermission = 'private'
WHERE idPoll LIKE '1';

/* Closed Poll */
UPDATE Poll
SET pollState = 'closed'
WHERE idPoll LIKE '1';

/* Update user's password */
UPDATE User
SET password = 'passhypersegura'
WHERE idUser LIKE '2';

/* TRANSACTIONS */

/* login */
SELECT
  username,
  password
FROM User
WHERE User.username LIKE 'something' AND User.password LIKE 'validpass';

/* Register */
BEGIN TRANSACTION;
SELECT
  username,
  password
FROM User
WHERE User.username LIKE 'something' AND User.password LIKE 'validpass';
INSERT INTO User
VALUES (DEFAULT, 'filetez', 'Joao Filetes', 'Ali acola', '987654321', 'welele@fe.up.pt', 'student', 'path');
COMMIT;

/* searches */
SELECT
  Poll.idPoll
FROM Poll
WHERE Poll.title LIKE '%something%';
SELECT
  Poll.idPoll
FROM Poll
WHERE Poll.data_post LIKE '2014-01-23';
SELECT
  User.username
FROM User
WHERE User.username LIKE '%user1%';

/* Poll from Category X */
SELECT
  Poll.idPoll
FROM Poll, PollCategory
WHERE PollCategory.name LIKE 'name' AND Poll.idPoll = PollCategory.idPoll;

/* Post */
BEGIN TRANSACTION;
INSERT INTO Poll VALUES (DEFAULT, title, data, 'path', '1', 'public', 'opened');
COMMIT;

/* send message */
BEGIN;
SELECT
  username
FROM User
WHERE username = 'user1';
SELECT
  username
FROM User
WHERE username = 'user2';
INSERT INTO Menssage VALUES (DEFAULT, 'user1', 'user2', 'title', 'content');
COMMIT;


