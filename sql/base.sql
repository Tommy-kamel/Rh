DROP DATABASE IF EXISTS rh;
CREATE DATABASE rh;
USE rh;

CREATE TABLE criteres (
    id_critere INT PRIMARY KEY AUTO_INCREMENT,
    age_min INT,
    sexe VARCHAR(50),
    experience INT,
    diplome_requis VARCHAR(50),
    langues_maitrisees VARCHAR(50),
    age_max INT,
    lieu_a_proximite VARCHAR(100)
);

CREATE TABLE fonction(
   id_fonction INT PRIMARY KEY AUTO_INCREMENT,
   nom_fonction VARCHAR(50)
);

CREATE TABLE user (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    id_fonction INT,
    nom_utilisateur VARCHAR(50) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    FOREIGN KEY(id_fonction) REFERENCES fonction(id_fonction)
);

CREATE TABLE annonce (
    id_annonce INT PRIMARY KEY AUTO_INCREMENT,
    id_critere INT,
    date_depot_limite DATE,
    poste_voulu VARCHAR(50),
    FOREIGN KEY (id_critere) REFERENCES criteres(id_critere)
);

CREATE TABLE employe (
    id_employe INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    sexe VARCHAR(50),
    mail VARCHAR(50),
    telephone VARCHAR(50),
    date_naissance DATE,
    adresse VARCHAR(50)
);

CREATE TABLE contrat (
    id_contrat INT PRIMARY KEY AUTO_INCREMENT,
    id_employe INT,
    salaire DECIMAL(15,2),
    date_debut DATE,
    date_fin DATE
);

CREATE TABLE candidat (
    id_candidat INT PRIMARY KEY AUTO_INCREMENT,
    id_annonce INT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    mail VARCHAR(50),
    telephone VARCHAR(50),
    niveau_etude VARCHAR(50),
    experience INT,
    date_de_naissance DATE,
    adresse VARCHAR(50),
    sexe VARCHAR(50),
    photo VARCHAR(255),
    date_candidature DATE,
    FOREIGN KEY (id_annonce) REFERENCES annonce(id_annonce)
);

CREATE TABLE poste (
    id_poste INT PRIMARY KEY AUTO_INCREMENT,
    id_fonction INT,
    nom VARCHAR(50),
    FOREIGN KEY(id_fonction) REFERENCES fonction(id_fonction)
);  

CREATE TABLE niveau_exigence (
    id_niveau_exigence INT PRIMARY KEY AUTO_INCREMENT,
    id_annonce INT,
    type_critere VARCHAR(50), -- 'age', 'sexe', 'experience', 'diplome', 'langues', 'lieu'
    niveau VARCHAR(50), -- 'obligatoire', 'tolerable', 'pas_important'
    FOREIGN KEY (id_annonce) REFERENCES annonce(id_annonce) ON DELETE CASCADE
);

CREATE TABLE candidat_retenu (
    id_candidat_retenu INT PRIMARY KEY AUTO_INCREMENT,
    id_candidat INT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    mail VARCHAR(50),
    telephone VARCHAR(50),
    niveau_etude VARCHAR(50),
    experience INT,
    date_de_naissance DATE,
    adresse VARCHAR(50),
    sexe VARCHAR(50),
    photo VARCHAR(255),
    date_creation DATE,
    FOREIGN KEY (id_candidat) REFERENCES candidat(id_candidat) ON DELETE CASCADE
);

CREATE TABLE contrat_essai (
    id_contrat_essai INT PRIMARY KEY AUTO_INCREMENT,
/*     id_employe INT, */
    id_candidat_retenu INT,
    date_debut DATE,
    date_fin DATE,
    salaire DECIMAL(15,2),
    FOREIGN KEY(id_candidat_retenu) REFERENCES candidat_retenu(id_candidat_retenu)
);