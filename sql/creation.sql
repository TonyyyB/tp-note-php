DROP TABLE IF EXISTS A;
DROP TABLE IF EXISTS JOUEUR;

CREATE TABLE A (
  PRIMARY KEY (idj, score),
  idj   VARCHAR(42) NOT NULL,
  score INT NOT NULL
);

CREATE TABLE JOUEUR (
  PRIMARY KEY (idj),
  idj    VARCHAR(42) NOT NULL AUTO_INCREMENT,
  nom    VARCHAR(42),
  prenom VARCHAR(42)
);

ALTER TABLE A ADD FOREIGN KEY (idj) REFERENCES JOUEUR (idj);