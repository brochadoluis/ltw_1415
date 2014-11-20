/*drop de todas as tabelas*/
DROP TABLE IF EXISTS User CASCADE;
DROP TABLE IF EXISTS Poll CASCADE;
DROP TABLE IF EXISTS Question CASCADE;
DROP TABLE IF EXISTS Answer CASCADE;

CREATE TYPE permission AS ENUM ('public', 'private');


/* Users */
CREATE TABLE IF NOT EXISTS User (
	idUser		SERIAL PRIMARY KEY,
	username 	VARCHAR(16) 	NOT NULL
	name 		VARCHAR 		NOT NULL,
	localidade 	VARCHAR 		NOT NULL,
	passwor 	VARCHAR 		NOT NULL,
	email 		VARCHAR UNIQUE 	NOT NULL,
	ocupation 	VARCHAR 		NOT NULL,
	fotograph 	VARCHAR,
	CHECK (char_length(pass) > 8),
	CHECK (char_length(username) > 6)
);

/* Polls */
CREATE TABLE IF NOT EXISTS Poll (
	idPoll 		SERIAL PRIMARY KEY,
	title 		VARCHAR(85) 	NOT NULL,
	data_post 	DATE DEFAULT CURRENT_DATE,
	fotograph 	VARCHAR 		NOT NULL,
	idUser 		INTEGER REFERENCES User 	ON DELETE CASCADE
	idQuestion 	INTEGER REFERENCES Question ON DELETE CASCADE
	idAnswer 	INTEGER REFERENCES Answer 	ON DELETE CASCADE
	permissionPoll permission;
);

/* Questions */
CREATE TABLE IF NOT EXISTS Question (
	idQuestion 	SERIAL PRIMARY KEY,
	idPoll 		INTEGER REFERENCES Poll 	ON DELETE CASCADE
	idAnswer 	INTEGER REFERENCES Answer 	ON DELETE CASCADE
);

/* Answers */
CREATE TABLE IF NOT EXISTS Question (
	idAnswer 	SERIAL PRIMARY KEY,
	idQuestion 	INTEGER REFERENCES Question ON DELETE CASCADE
);

/* Links */
CREATE TABLE IF NOT EXISTS Link (
	href     VARCHAR PRIMARY KEY 	NOT NULL,
	homeLink VARCHAR             	NOT NULL
);

/* Categories */
CREATE TABLE IF NOT EXISTS Category (
	idCategory	SERIAL 	PRIMARY KEY,
	name 		VARCHAR NOT NULL
);

/* Polls Categories */
CREATE TABLE IF NOT EXISTS PollsCategory (
  idPoll 	INTEGER,
  name      VARCHAR,
  CONSTRAINT UNIQUE (idPoll, name), 
  FOREIGN KEY (idPoll) 	REFERENCES Poll 		ON DELETE CASCADE,
  FOREIGN KEY (name) 	REFERENCES Category 	ON DELETE CASCADE
);
/* Messages */
CREATE TABLE IF NOT EXISTS Message (
  idMessage 	SERIAL PRIMARY KEY,
  sender    	VARCHAR(16) REFERENCES User ON DELETE CASCADE,
  receiver   	VARCHAR(16) REFERENCES User ON DELETE CASCADE,
  title     	VARCHAR      NOT NULL,
  content   	VARCHAR(140) NOT NULL
);