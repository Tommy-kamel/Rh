INSERT INTO fonction (nom_fonction) VALUES
('Securite');



INSERT INTO question (intitule, id_fonction, duree_max) VALUES
('Quel est le rôle principal des RH ?', 1, 60),
('Que signifie la GPEC ?', 1, 60),
('Quelle est la durée légale du travail hebdomadaire ?', 1, 60),
('Que fait un responsable paie ?', 1, 60),
('Quel est l\’objectif du recrutement ?', 1, 60),

('Que mesure l\’OEE en production ?', 2, 60),
('Qu\’est-ce qu\’un poste de travail ?', 2, 60),
('À quoi sert un plan de production ?', 2, 60),
('Que signifie la maintenance préventive ?', 2, 60),
('Qu\’est-ce qu\’un goulot d\’étranglement ?', 2, 60),

('Que signifie B2B ?', 3, 60),
('Qu\’est-ce qu\’un CRM ?', 3, 60),
('Que fait un commercial terrain ?', 3, 60),
('Qu\’est-ce qu\’un devis ?', 3, 60),
('Qu\’est-ce qu\’une facture pro forma ?', 3, 60),

('Que signifie FIFO en gestion de stock ?', 4, 60),
('Qu\’est-ce qu\’un stock de sécurité ?', 4, 60),
('Pourquoi faire un inventaire ?', 4, 60),
('Qu\’est-ce qu\’un entrepôt ?', 4, 60),
('Qu\’est-ce que la rotation de stock ?', 4, 60),

('Qu\’est-ce qu\’une immobilisation ?', 5, 60),
('Que signifie amortissement ?', 5, 60),
('Donne un exemple d\’immobilisation incorporelle ?', 5, 60),
('Qu\’est-ce qu\’une durée d\’amortissement ?', 5, 60),
('Que signifie cession d\’immobilisation ?', 5, 60),

('Qu\’est-ce qu\’un plan d\’évacuation ?', 6, 60),
('À quoi sert un extincteur ?', 6, 60),
('Que signifie EPI ?', 6, 60),
('Pourquoi faire un exercice incendie ?', 6, 60),
('Qu\’est-ce que le RGPD protège ?', 6, 60);



INSERT INTO choix (id_question, texte, est_correct) VALUES
(1,'Gestion du personnel', TRUE),(1,'Production de biens', FALSE),(1,'Achat de machines', FALSE),(1,'Sécurité informatique', FALSE),
(1,'Gestion de stock', FALSE),(1,'Vente de produits', FALSE),(1,'Immobilisation des actifs', FALSE),(1,'Comptabilité financière', FALSE),

(2,'Gestion Prévisionnelle des Emplois et Compétences', TRUE),(2,'Gestion des Produits en Cours', FALSE),(2,'Grande Politique Économique Commerciale', FALSE),(2,'Gestion des Postes en Contrat', FALSE),
(2,'Gestion Prévisionnelle des Entreprises Commerciales', FALSE),(2,'Groupe Professionnel des Employés et Cadres', FALSE),(2,'Gestion des Patrimoines et Capitaux', FALSE),(2,'Gestion Prévisionnelle des Étudiants en CDD', FALSE),

(3,'35 heures', TRUE),(3,'20 heures', FALSE),(3,'48 heures', FALSE),(3,'10 heures', FALSE),
(3,'50 heures', FALSE),(3,'25 heures', FALSE),(3,'60 heures', FALSE),(3,'15 heures', FALSE),

(4,'Établir les bulletins de salaire', TRUE),(4,'Former les salariés', FALSE),(4,'Faire des ventes', FALSE),(4,'Surveiller la sécurité', FALSE),
(4,'Produire des biens', FALSE),(4,'Gérer les stocks', FALSE),(4,'Entretenir les machines', FALSE),(4,'Vérifier la conformité des produits', FALSE),

(5,'Attirer et sélectionner les meilleurs candidats', TRUE),(5,'Vendre des produits', FALSE),(5,'Réparer les machines', FALSE),(5,'Acheter des immobilisations', FALSE),
(5,'Sécuriser l\’entrepôt', FALSE),(5,'Établir des factures', FALSE),(5,'Stocker des marchandises', FALSE),(5,'Former des clients', FALSE);

INSERT INTO choix (id_question, texte, est_correct) VALUES
(6,'Gestion du personnel', TRUE),(6,'Production de biens', FALSE),(6,'Achat de machines', FALSE),(6,'Sécurité informatique', FALSE),
(6,'Gestion de stock', FALSE),(6,'Vente de produits', FALSE),(6,'Immobilisation des actifs', FALSE),(6,'Comptabilité financière', FALSE),

(7,'Gestion Prévisionnelle des Emplois et Compétences', TRUE),(7,'Gestion des Produits en Cours', FALSE),(7,'Grande Politique Économique Commerciale', FALSE),(7,'Gestion des Postes en Contrat', FALSE),
(7,'Gestion Prévisionnelle des Entreprises Commerciales', FALSE),(7,'Groupe Professionnel des Employés et Cadres', FALSE),(7,'Gestion des Patrimoines et Capitaux', FALSE),(7,'Gestion Prévisionnelle des Étudiants en CDD', FALSE),

(8,'85 heures', TRUE),(8,'20 heures', FALSE),(8,'48 heures', FALSE),(8,'10 heures', FALSE),
(8,'50 heures', FALSE),(8,'25 heures', FALSE),(8,'60 heures', FALSE),(8,'15 heures', FALSE),

(9,'Établir les bulletins de salaire', TRUE),(9,'Former les salariés', FALSE),(9,'Faire des ventes', FALSE),(9,'Surveiller la sécurité', FALSE),
(9,'Produire des biens', FALSE),(9,'Gérer les stocks', FALSE),(9,'Entretenir les machines', FALSE),(9,'Vérifier la conformité des produits', FALSE),

(10,'Attirer et sélectionner les meilleurs candidats', TRUE),(10,'Vendre des produits', FALSE),(10,'Réparer les machines', FALSE),(10,'Acheter des immobilisations', FALSE),
(10,'Sécuriser l\’entrepôt', FALSE),(10,'Établir des factures', FALSE),(10,'Stocker des marchandises', FALSE),(10,'Former des clients', FALSE);

INSERT INTO choix (id_question, texte, est_correct) VALUES
(11,'Gestion du personnel', TRUE),(11,'Production de biens', FALSE),(11,'Achat de machines', FALSE),(11,'Sécurité informatique', FALSE),
(11,'Gestion de stock', FALSE),(11,'Vente de produits', FALSE),(11,'Immobilisation des actifs', FALSE),(11,'Comptabilité financière', FALSE),

(12,'Gestion Prévisionnelle des Emplois et Compétences', TRUE),(12,'Gestion des Produits en Cours', FALSE),(12,'Grande Politique Économique Commerciale', FALSE),(12,'Gestion des Postes en Contrat', FALSE),
(12,'Gestion Prévisionnelle des Entreprises Commerciales', FALSE),(12,'Groupe Professionnel des Employés et Cadres', FALSE),(12,'Gestion des Patrimoines et Capitaux', FALSE),(12,'Gestion Prévisionnelle des Étudiants en CDD', FALSE),

(13,'135 heures', TRUE),(13,'20 heures', FALSE),(13,'48 heures', FALSE),(13,'10 heures', FALSE),
(13,'50 heures', FALSE),(13,'25 heures', FALSE),(13,'60 heures', FALSE),(13,'15 heures', FALSE),

(14,'Établir les bulletins de salaire', TRUE),(14,'Former les salariés', FALSE),(14,'Faire des ventes', FALSE),(14,'Surveiller la sécurité', FALSE),
(14,'Produire des biens', FALSE),(14,'Gérer les stocks', FALSE),(14,'Entretenir les machines', FALSE),(14,'Vérifier la conformité des produits', FALSE),

(15,'Attirer et sélectionner les meilleurs candidats', TRUE),(15,'Vendre des produits', FALSE),(15,'Réparer les machines', FALSE),(15,'Acheter des immobilisations', FALSE),
(15,'Sécuriser l\’entrepôt', FALSE),(15,'Établir des factures', FALSE),(15,'Stocker des marchandises', FALSE),(15,'Former des clients', FALSE);

INSERT INTO choix (id_question, texte, est_correct) VALUES
(16,'Gestion du personnel', TRUE),(16,'Production de biens', FALSE),(16,'Achat de machines', FALSE),(16,'Sécurité informatique', FALSE),
(16,'Gestion de stock', FALSE),(16,'Vente de produits', FALSE),(16,'Immobilisation des actifs', FALSE),(16,'Comptabilité financière', FALSE),

(17,'Gestion Prévisionnelle des Emplois et Compétences', TRUE),(17,'Gestion des Produits en Cours', FALSE),(17,'Grande Politique Économique Commerciale', FALSE),(17,'Gestion des Postes en Contrat', FALSE),
(17,'Gestion Prévisionnelle des Entreprises Commerciales', FALSE),(17,'Groupe Professionnel des Employés et Cadres', FALSE),(17,'Gestion des Patrimoines et Capitaux', FALSE),(17,'Gestion Prévisionnelle des Étudiants en CDD', FALSE),

(18,'185 heures', TRUE),(18,'20 heures', FALSE),(18,'418 heures', FALSE),(18,'10 heures', FALSE),
(18,'50 heures', FALSE),(18,'25 heures', FALSE),(18,'60 heures', FALSE),(18,'15 heures', FALSE),

(19,'Établir les bulletins de salaire', TRUE),(19,'Former les salariés', FALSE),(19,'Faire des ventes', FALSE),(19,'Surveiller la sécurité', FALSE),
(19,'Produire des biens', FALSE),(19,'Gérer les stocks', FALSE),(19,'Entretenir les machines', FALSE),(19,'Vérifier la conformité des produits', FALSE),

(20,'Attirer et sélectionner les meilleurs candidats', TRUE),(20,'Vendre des produits', FALSE),(20,'Réparer les machines', FALSE),(20,'Acheter des immobilisations', FALSE),
(20,'Sécuriser l\’entrepôt', FALSE),(20,'Établir des factures', FALSE),(20,'Stocker des marchandises', FALSE),(20,'Former des clients', FALSE);

INSERT INTO choix (id_question, texte, est_correct) VALUES
(21,'Gestion du personnel', TRUE),(21,'Production de biens', FALSE),(21,'Achat de machines', FALSE),(21,'Sécurité informatique', FALSE),
(21,'Gestion de stock', FALSE),(21,'Vente de produits', FALSE),(21,'Immobilisation des actifs', FALSE),(21,'Comptabilité financière', FALSE),

(22,'Gestion Prévisionnelle des Emplois et Compétences', TRUE),(22,'Gestion des Produits en Cours', FALSE),(22,'Grande Politique Économique Commerciale', FALSE),(22,'Gestion des Postes en Contrat', FALSE),
(22,'Gestion Prévisionnelle des Entreprises Commerciales', FALSE),(22,'Groupe Professionnel des Employés et Cadres', FALSE),(22,'Gestion des Patrimoines et Capitaux', FALSE),(22,'Gestion Prévisionnelle des Étudiants en CDD', FALSE),

(23,'235 heures', TRUE),(23,'20 heures', FALSE),(23,'423 heures', FALSE),(23,'10 heures', FALSE),
(23,'50 heures', FALSE),(23,'25 heures', FALSE),(23,'60 heures', FALSE),(23,'15 heures', FALSE),

(24,'Établir les bulletins de salaire', TRUE),(24,'Former les salariés', FALSE),(24,'Faire des ventes', FALSE),(24,'Surveiller la sécurité', FALSE),
(24,'Produire des biens', FALSE),(24,'Gérer les stocks', FALSE),(24,'Entretenir les machines', FALSE),(24,'Vérifier la conformité des produits', FALSE),

(25,'Attirer et sélectionner les meilleurs candidats', TRUE),(25,'Vendre des produits', FALSE),(25,'Réparer les machines', FALSE),(25,'Acheter des immobilisations', FALSE),
(25,'Sécuriser l\’entrepôt', FALSE),(25,'Établir des factures', FALSE),(25,'Stocker des marchandises', FALSE),(25,'Former des clients', FALSE);

INSERT INTO choix (id_question, texte, est_correct) VALUES
(26,'Gestion Prévisionnelle des Emplois et Compétences', TRUE),(26,'Gestion des Produits en Cours', FALSE),(26,'Grande Politique Économique Commerciale', FALSE),(26,'Gestion des Postes en Contrat', FALSE),
(26,'Gestion Prévisionnelle des Entreprises Commerciales', FALSE),(26,'Groupe Professionnel des Employés et Cadres', FALSE),(26,'Gestion des Patrimoines et Capitaux', FALSE),(26,'Gestion Prévisionnelle des Étudiants en CDD', FALSE),

(27,'275 heures', TRUE),(27,'20 heures', FALSE),(27,'427 heures', FALSE),(27,'10 heures', FALSE),
(27,'50 heures', FALSE),(27,'25 heures', FALSE),(27,'60 heures', FALSE),(27,'15 heures', FALSE),

(28,'Établir les bulletins de salaire', TRUE),(28,'Former les salariés', FALSE),(28,'Faire des ventes', FALSE),(28,'Surveiller la sécurité', FALSE),
(28,'Produire des biens', FALSE),(28,'Gérer les stocks', FALSE),(28,'Entretenir les machines', FALSE),(28,'Vérifier la conformité des produits', FALSE),

(29,'Attirer et sélectionner les meilleurs candidats', TRUE),(29,'Vendre des produits', FALSE),(29,'Réparer les machines', FALSE),(29,'Acheter des immobilisations', FALSE),
(29,'Sécuriser l\’entrepôt', FALSE),(29,'Établir des factures', FALSE),(29,'Stocker des marchandises', FALSE),(29,'Former des clients', FALSE),

(30,'Gestion du personnel', TRUE),(30,'Production de biens', FALSE),(30,'Achat de machines', FALSE),(30,'Sécurité informatique', FALSE),
(30,'Gestion de stock', FALSE),(30,'Vente de produits', FALSE),(30,'Immobilisation des actifs', FALSE),(30,'Comptabilité financière', FALSE);


-- INSERT INTO annonce (id_critere, date_depot_limite, poste_voulu) VALUES
-- (1, '2025-12-31', 'Développeur Web');

-- INSERT INTO candidat (id_annonce, nom, prenom, mail, telephone, niveau_etude, experience, date_de_naissance, adresse, date_candidature) VALUES
-- (1, 'Dupont', 'Jean', 'jean.dupont@example.com', '0123456789', 'Licence', 2, '1990-01-01', '123 Rue Exemple', '2025-09-16');

insert into variable VALUES (5, 40, 60, '2025-18-09');