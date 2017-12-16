DROP TABLE tache;
DROP TABLE liste;
DROP TABLE users;


CREATE TABLE users (
	username varchar(30) NOT NULL PRIMARY KEY,
	password varchar(255) NOT NULL
);

CREATE TABLE liste (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nom varchar(30) NOT NULL,
	username varchar(30),
	CONSTRAINT FOREIGN KEY (username) REFERENCES users(username) 
);

CREATE TABLE tache (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idListe int(11) NOT NULL,
  nom varchar(30) NOT NULL,
  description varchar(300) DEFAULT NULL,
  dateAjout datetime NOT NULL,
  dateFin datetime DEFAULT NULL,
  CONSTRAINT FOREIGN KEY (idListe) REFERENCES liste(id)
);


