CREATE TABLE test (
   id_test INT AUTO_INCREMENT PRIMARY KEY,
   id_candidat INT NOT NULL,
   score DECIMAL(5,2),
   date_test DATE DEFAULT CURRENT_DATE,
   FOREIGN KEY (id_candidat) REFERENCES candidat(id_candidat)
);

CREATE TABLE entretien (
   id_entretien INT AUTO_INCREMENT PRIMARY KEY,
   id_candidat INT NOT NULL,
   date_entretien DATE,
   note DECIMAL(5,2),
   commentaire TEXT,
   FOREIGN KEY (id_candidat) REFERENCES candidat(id_candidat)
);

CREATE TABLE scoring (
   id_scoring INT AUTO_INCREMENT PRIMARY KEY,
   id_candidat INT NOT NULL,
   score_total DECIMAL(5,2),
   decision ENUM('retenu','liste_attente','refuse') DEFAULT 'liste_attente',
   FOREIGN KEY (id_candidat) REFERENCES candidat(id_candidat)
);


CREATE TABLE question (
   id_question INT AUTO_INCREMENT PRIMARY KEY,
   intitule TEXT NOT NULL,
   id_fonction INT,
   duree_max INT
);

CREATE TABLE choix (
   id_choix INT AUTO_INCREMENT PRIMARY KEY,
   id_question INT NOT NULL,
   texte VARCHAR(255) NOT NULL,
   est_correct BOOLEAN DEFAULT FALSE,
   FOREIGN KEY (id_question) REFERENCES question(id_question)
);

CREATE TABLE reponse (
   id_reponse INT AUTO_INCREMENT PRIMARY KEY,
   id_test INT NOT NULL,
   id_question INT NOT NULL,
   id_choix INT NOT NULL,
   FOREIGN KEY (id_test) REFERENCES test(id_test),
   FOREIGN KEY (id_question) REFERENCES question(id_question),
   FOREIGN KEY (id_choix) REFERENCES choix(id_choix)
);

ALTER TABLE test ADD COLUMN id_fonction INT NOT NULL;
ALTER TABLE entretien ADD COLUMN id_fonction INT NOT NULL;
ALTER TABLE scoring ADD COLUMN id_fonction INT NOT NULL;
alter table test add FOREIGN key (id_fonction) REFERENCES fonction(id_fonction);
alter table entretien add FOREIGN key (id_fonction) REFERENCES fonction(id_fonction);
alter table scoring add FOREIGN key (id_fonction) REFERENCES fonction(id_fonction);

create table variable (
   nb_question int,
   pourcentage_test DECIMAL(5,2),
   pourcentage_entretien DECIMAL(5,2),
   date_changement date
);

alter table annonce add column id_fonction int;
alter table annonce add FOREIGN key (id_fonction) REFERENCES fonction(id_fonction);

-- alter table question add FOREIGN key (id_fonction) REFERENCES fonction(id_fonction);
-- alter table choix add FOREIGN key (id_question) REFERENCES question(id_question);

-- SELECT distinct(q.id_question) FROM question q JOIN choix c ON c.id_question = q.id_question WHERE q.id_fonction = 1;
