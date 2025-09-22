-- INSERT INTO fonction (nom_fonction) VALUES
-- ('Securite');



-- INSERT INTO question (intitule, id_fonction, duree_max) VALUES
-- ('Quel est le rôle principal des RH ?', 1, 60),
-- ('Que signifie la GPEC ?', 1, 60),
-- ('Quelle est la durée légale du travail hebdomadaire ?', 1, 60),
-- ('Que fait un responsable paie ?', 1, 60),
-- ('Quel est l\ objectif du recrutement ?', 1, 60),

-- ('Que mesure l\ OEE en production ?', 2, 60),
-- ('Qu\ est-ce qu\ un poste de travail ?', 2, 60),
-- ('À quoi sert un plan de production ?', 2, 60),
-- ('Que signifie la maintenance préventive ?', 2, 60),
-- ('Qu\ est-ce qu\ un goulot d\ étranglement ?', 2, 60),

-- ('Que signifie B2B ?', 3, 60),
-- ('Qu\ est-ce qu\ un CRM ?', 3, 60),
-- ('Que fait un commercial terrain ?', 3, 60),
-- ('Qu\ est-ce qu\ un devis ?', 3, 60),
-- ('Qu\ est-ce qu\ une facture pro forma ?', 3, 60),

-- ('Que signifie FIFO en gestion de stock ?', 4, 60),
-- ('Qu\ est-ce qu\ un stock de sécurité ?', 4, 60),
-- ('Pourquoi faire un inventaire ?', 4, 60),
-- ('Qu\ est-ce qu\ un entrepôt ?', 4, 60),
-- ('Qu\ est-ce que la rotation de stock ?', 4, 60),

-- ('Qu\ est-ce qu\ une immobilisation ?', 5, 60),
-- ('Que signifie amortissement ?', 5, 60),
-- ('Donne un exemple d\ immobilisation incorporelle ?', 5, 60),
-- ('Qu\ est-ce qu\ une durée d\ amortissement ?', 5, 60),
-- ('Que signifie cession d\ immobilisation ?', 5, 60),

-- ('Qu\ est-ce qu\ un plan d\ évacuation ?', 6, 60),
-- ('À quoi sert un extincteur ?', 6, 60),
-- ('Que signifie EPI ?', 6, 60),
-- ('Pourquoi faire un exercice incendie ?', 6, 60),
-- ('Qu\ est-ce que le RGPD protège ?', 6, 60);



-- INSERT INTO choix (id_question, texte, est_correct) VALUES
-- (1,'Gestion du personnel', TRUE),(1,'Production de biens', FALSE),(1,'Achat de machines', FALSE),(1,'Sécurité informatique', FALSE),
-- (1,'Gestion de stock', FALSE),(1,'Vente de produits', FALSE),(1,'Immobilisation des actifs', FALSE),(1,'Comptabilité financière', FALSE),

-- (2,'Gestion Prévisionnelle des Emplois et Compétences', TRUE),(2,'Gestion des Produits en Cours', FALSE),(2,'Grande Politique Économique Commerciale', FALSE),(2,'Gestion des Postes en Contrat', FALSE),
-- (2,'Gestion Prévisionnelle des Entreprises Commerciales', FALSE),(2,'Groupe Professionnel des Employés et Cadres', FALSE),(2,'Gestion des Patrimoines et Capitaux', FALSE),(2,'Gestion Prévisionnelle des Étudiants en CDD', FALSE),

-- (3,'35 heures', TRUE),(3,'20 heures', FALSE),(3,'48 heures', FALSE),(3,'10 heures', FALSE),
-- (3,'50 heures', FALSE),(3,'25 heures', FALSE),(3,'60 heures', FALSE),(3,'15 heures', FALSE),

-- (4,'Établir les bulletins de salaire', TRUE),(4,'Former les salariés', FALSE),(4,'Faire des ventes', FALSE),(4,'Surveiller la sécurité', FALSE),
-- (4,'Produire des biens', FALSE),(4,'Gérer les stocks', FALSE),(4,'Entretenir les machines', FALSE),(4,'Vérifier la conformité des produits', FALSE),

-- (5,'Attirer et sélectionner les meilleurs candidats', TRUE),(5,'Vendre des produits', FALSE),(5,'Réparer les machines', FALSE),(5,'Acheter des immobilisations', FALSE),
-- (5,'Sécuriser l\ entrepôt', FALSE),(5,'Établir des factures', FALSE),(5,'Stocker des marchandises', FALSE),(5,'Former des clients', FALSE);

-- INSERT INTO choix (id_question, texte, est_correct) VALUES
-- (6,'Gestion du personnel', TRUE),(6,'Production de biens', FALSE),(6,'Achat de machines', FALSE),(6,'Sécurité informatique', FALSE),
-- (6,'Gestion de stock', FALSE),(6,'Vente de produits', FALSE),(6,'Immobilisation des actifs', FALSE),(6,'Comptabilité financière', FALSE),

-- (7,'Gestion Prévisionnelle des Emplois et Compétences', TRUE),(7,'Gestion des Produits en Cours', FALSE),(7,'Grande Politique Économique Commerciale', FALSE),(7,'Gestion des Postes en Contrat', FALSE),
-- (7,'Gestion Prévisionnelle des Entreprises Commerciales', FALSE),(7,'Groupe Professionnel des Employés et Cadres', FALSE),(7,'Gestion des Patrimoines et Capitaux', FALSE),(7,'Gestion Prévisionnelle des Étudiants en CDD', FALSE),

-- (8,'85 heures', TRUE),(8,'20 heures', FALSE),(8,'48 heures', FALSE),(8,'10 heures', FALSE),
-- (8,'50 heures', FALSE),(8,'25 heures', FALSE),(8,'60 heures', FALSE),(8,'15 heures', FALSE),

-- (9,'Établir les bulletins de salaire', TRUE),(9,'Former les salariés', FALSE),(9,'Faire des ventes', FALSE),(9,'Surveiller la sécurité', FALSE),
-- (9,'Produire des biens', FALSE),(9,'Gérer les stocks', FALSE),(9,'Entretenir les machines', FALSE),(9,'Vérifier la conformité des produits', FALSE),

-- (10,'Attirer et sélectionner les meilleurs candidats', TRUE),(10,'Vendre des produits', FALSE),(10,'Réparer les machines', FALSE),(10,'Acheter des immobilisations', FALSE),
-- (10,'Sécuriser l\ entrepôt', FALSE),(10,'Établir des factures', FALSE),(10,'Stocker des marchandises', FALSE),(10,'Former des clients', FALSE);

-- INSERT INTO choix (id_question, texte, est_correct) VALUES
-- (11,'Gestion du personnel', TRUE),(11,'Production de biens', FALSE),(11,'Achat de machines', FALSE),(11,'Sécurité informatique', FALSE),
-- (11,'Gestion de stock', FALSE),(11,'Vente de produits', FALSE),(11,'Immobilisation des actifs', FALSE),(11,'Comptabilité financière', FALSE),

-- (12,'Gestion Prévisionnelle des Emplois et Compétences', TRUE),(12,'Gestion des Produits en Cours', FALSE),(12,'Grande Politique Économique Commerciale', FALSE),(12,'Gestion des Postes en Contrat', FALSE),
-- (12,'Gestion Prévisionnelle des Entreprises Commerciales', FALSE),(12,'Groupe Professionnel des Employés et Cadres', FALSE),(12,'Gestion des Patrimoines et Capitaux', FALSE),(12,'Gestion Prévisionnelle des Étudiants en CDD', FALSE),

-- (13,'135 heures', TRUE),(13,'20 heures', FALSE),(13,'48 heures', FALSE),(13,'10 heures', FALSE),
-- (13,'50 heures', FALSE),(13,'25 heures', FALSE),(13,'60 heures', FALSE),(13,'15 heures', FALSE),

-- (14,'Établir les bulletins de salaire', TRUE),(14,'Former les salariés', FALSE),(14,'Faire des ventes', FALSE),(14,'Surveiller la sécurité', FALSE),
-- (14,'Produire des biens', FALSE),(14,'Gérer les stocks', FALSE),(14,'Entretenir les machines', FALSE),(14,'Vérifier la conformité des produits', FALSE),

-- (15,'Attirer et sélectionner les meilleurs candidats', TRUE),(15,'Vendre des produits', FALSE),(15,'Réparer les machines', FALSE),(15,'Acheter des immobilisations', FALSE),
-- (15,'Sécuriser l\ entrepôt', FALSE),(15,'Établir des factures', FALSE),(15,'Stocker des marchandises', FALSE),(15,'Former des clients', FALSE);

-- INSERT INTO choix (id_question, texte, est_correct) VALUES
-- (16,'Gestion du personnel', TRUE),(16,'Production de biens', FALSE),(16,'Achat de machines', FALSE),(16,'Sécurité informatique', FALSE),
-- (16,'Gestion de stock', FALSE),(16,'Vente de produits', FALSE),(16,'Immobilisation des actifs', FALSE),(16,'Comptabilité financière', FALSE),

-- (17,'Gestion Prévisionnelle des Emplois et Compétences', TRUE),(17,'Gestion des Produits en Cours', FALSE),(17,'Grande Politique Économique Commerciale', FALSE),(17,'Gestion des Postes en Contrat', FALSE),
-- (17,'Gestion Prévisionnelle des Entreprises Commerciales', FALSE),(17,'Groupe Professionnel des Employés et Cadres', FALSE),(17,'Gestion des Patrimoines et Capitaux', FALSE),(17,'Gestion Prévisionnelle des Étudiants en CDD', FALSE),

-- (18,'185 heures', TRUE),(18,'20 heures', FALSE),(18,'418 heures', FALSE),(18,'10 heures', FALSE),
-- (18,'50 heures', FALSE),(18,'25 heures', FALSE),(18,'60 heures', FALSE),(18,'15 heures', FALSE),

-- (19,'Établir les bulletins de salaire', TRUE),(19,'Former les salariés', FALSE),(19,'Faire des ventes', FALSE),(19,'Surveiller la sécurité', FALSE),
-- (19,'Produire des biens', FALSE),(19,'Gérer les stocks', FALSE),(19,'Entretenir les machines', FALSE),(19,'Vérifier la conformité des produits', FALSE),

-- (20,'Attirer et sélectionner les meilleurs candidats', TRUE),(20,'Vendre des produits', FALSE),(20,'Réparer les machines', FALSE),(20,'Acheter des immobilisations', FALSE),
-- (20,'Sécuriser l\ entrepôt', FALSE),(20,'Établir des factures', FALSE),(20,'Stocker des marchandises', FALSE),(20,'Former des clients', FALSE);

-- INSERT INTO choix (id_question, texte, est_correct) VALUES
-- (21,'Gestion du personnel', TRUE),(21,'Production de biens', FALSE),(21,'Achat de machines', FALSE),(21,'Sécurité informatique', FALSE),
-- (21,'Gestion de stock', FALSE),(21,'Vente de produits', FALSE),(21,'Immobilisation des actifs', FALSE),(21,'Comptabilité financière', FALSE),

-- (22,'Gestion Prévisionnelle des Emplois et Compétences', TRUE),(22,'Gestion des Produits en Cours', FALSE),(22,'Grande Politique Économique Commerciale', FALSE),(22,'Gestion des Postes en Contrat', FALSE),
-- (22,'Gestion Prévisionnelle des Entreprises Commerciales', FALSE),(22,'Groupe Professionnel des Employés et Cadres', FALSE),(22,'Gestion des Patrimoines et Capitaux', FALSE),(22,'Gestion Prévisionnelle des Étudiants en CDD', FALSE),

-- (23,'235 heures', TRUE),(23,'20 heures', FALSE),(23,'423 heures', FALSE),(23,'10 heures', FALSE),
-- (23,'50 heures', FALSE),(23,'25 heures', FALSE),(23,'60 heures', FALSE),(23,'15 heures', FALSE),

-- (24,'Établir les bulletins de salaire', TRUE),(24,'Former les salariés', FALSE),(24,'Faire des ventes', FALSE),(24,'Surveiller la sécurité', FALSE),
-- (24,'Produire des biens', FALSE),(24,'Gérer les stocks', FALSE),(24,'Entretenir les machines', FALSE),(24,'Vérifier la conformité des produits', FALSE),

-- (25,'Attirer et sélectionner les meilleurs candidats', TRUE),(25,'Vendre des produits', FALSE),(25,'Réparer les machines', FALSE),(25,'Acheter des immobilisations', FALSE),
-- (25,'Sécuriser l\ entrepôt', FALSE),(25,'Établir des factures', FALSE),(25,'Stocker des marchandises', FALSE),(25,'Former des clients', FALSE);

-- -- INSERT INTO annonce (id_critere, date_depot_limite, poste_voulu) VALUES
-- -- (1, '2025-12-31', 'Développeur Web');

-- -- INSERT INTO candidat (id_annonce, nom, prenom, mail, telephone, niveau_etude, experience, date_de_naissance, adresse, date_candidature) VALUES
-- -- (1, 'Dupont', 'Jean', 'jean.dupont@example.com', '0123456789', 'Licence', 2, '1990-01-01', '123 Rue Exemple', '2025-09-16');

-- insert into variable VALUES (5, 40, 60, '2025-18-09');












INSERT INTO fonction (nom_fonction) VALUES
('Securite');

-- Insert questions with at least 8 per function
INSERT INTO question (intitule, id_fonction, duree_max) VALUES
-- Ressources Humaines (id_fonction = 1)
('Quel est le rôle principal des RH ?', 1, 60),
('Que signifie la GPEC ?', 1, 60),
('Quelle est la durée légale du travail hebdomadaire ?', 1, 60),
('Que fait un responsable paie ?', 1, 60),
('Quel est l objectif du recrutement ?', 1, 60),
('Qu est-ce qu un entretien annuel ?', 1, 60),
('Que signifie la formation continue ?', 1, 60),
('Pourquoi établir un plan de carrière ?', 1, 60),
-- Production (id_fonction = 2)
('Que mesure l OEE en production ?', 2, 60),
('Qu est-ce qu un poste de travail ?', 2, 60),
('À quoi sert un plan de production ?', 2, 60),
('Que signifie la maintenance préventive ?', 2, 60),
('Qu est-ce qu un goulot d étranglement ?', 2, 60),
('Qu est-ce que le lean manufacturing ?', 2, 60),
('Pourquoi utiliser un diagramme de Pareto ?', 2, 60),
('Qu est-ce qu une chaîne de production ?', 2, 60),
-- Achat et vente (id_fonction = 3)
('Que signifie B2B ?', 3, 60),
('Qu est-ce qu un CRM ?', 3, 60),
('Que fait un commercial terrain ?', 3, 60),
('Qu est-ce qu un devis ?', 3, 60),
('Qu est-ce qu une facture pro forma ?', 3, 60),
('Qu est-ce qu une prospection ?', 3, 60),
('Pourquoi négocier avec un fournisseur ?', 3, 60),
('Qu est-ce qu un bon de commande ?', 3, 60),
-- Gestion de stock (id_fonction = 4)
('Que signifie FIFO en gestion de stock ?', 4, 60),
('Qu est-ce qu un stock de sécurité ?', 4, 60),
('Pourquoi faire un inventaire ?', 4, 60),
('Qu est-ce qu un entrepôt ?', 4, 60),
('Qu est-ce que la rotation de stock ?', 4, 60),
('Qu est-ce que le réapprovisionnement ?', 4, 60),
('Que signifie LIFO en gestion de stock ?', 4, 60),
('Qu est-ce qu un code-barres ?', 4, 60),
-- Gestion d immobilisation (id_fonction = 5)
('Qu est-ce qu une immobilisation ?', 5, 60),
('Que signifie amortissement ?', 5, 60),
('Donne un exemple d immobilisation incorporelle ?', 5, 60),
('Qu est-ce qu une durée d amortissement ?', 5, 60),
('Que signifie cession d immobilisation ?', 5, 60),
('Qu est-ce qu une immobilisation corporelle ?', 5, 60),
('Pourquoi déprécier une immobilisation ?', 5, 60),
('Qu est-ce qu une dotation aux amortissements ?', 5, 60),
-- Securite (id_fonction = 6)
('Qu est-ce qu un plan d évacuation ?', 6, 60),
('À quoi sert un extincteur ?', 6, 60),
('Que signifie EPI ?', 6, 60),
('Pourquoi faire un exercice incendie ?', 6, 60),
('Qu est-ce que le RGPD protège ?', 6, 60),
('Qu est-ce qu un registre de sécurité ?', 6, 60),
('Pourquoi installer des détecteurs de fumée ?', 6, 60),
('Qu est-ce qu une analyse des risques ?', 6, 60);

-- Insert choices for question 1 (Ressources Humaines - Rôle principal)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(1, 'Gestion du personnel', TRUE),
(1, 'Production de biens', FALSE),
(1, 'Achat de machines', FALSE),
(1, 'Sécurité informatique', FALSE),
(1, 'Gestion de stock', FALSE),
(1, 'Vente de produits', FALSE),
(1, 'Immobilisation des actifs', FALSE),
(1, 'Comptabilité financière', FALSE);

-- Insert choices for question 2 (Ressources Humaines - GPEC)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(2, 'Gestion Prévisionnelle des Emplois et Compétences', TRUE),
(2, 'Gestion des Produits en Cours', FALSE),
(2, 'Grande Politique Économique Commerciale', FALSE),
(2, 'Gestion des Postes en Contrat', FALSE),
(2, 'Gestion Prévisionnelle des Entreprises Commerciales', FALSE),
(2, 'Groupe Professionnel des Employés et Cadres', FALSE),
(2, 'Gestion des Patrimoines et Capitaux', FALSE),
(2, 'Gestion Prévisionnelle des Étudiants en CDD', FALSE);

-- Insert choices for question 3 (Ressources Humaines - Durée légale)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(3, '35 heures', TRUE),
(3, '20 heures', FALSE),
(3, '48 heures', FALSE),
(3, '10 heures', FALSE),
(3, '50 heures', FALSE),
(3, '25 heures', FALSE),
(3, '60 heures', FALSE),
(3, '15 heures', FALSE);

-- Insert choices for question 4 (Ressources Humaines - Responsable paie)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(4, 'Établir les bulletins de salaire', TRUE),
(4, 'Former les salariés', FALSE),
(4, 'Faire des ventes', FALSE),
(4, 'Surveiller la sécurité', FALSE),
(4, 'Produire des biens', FALSE),
(4, 'Gérer les stocks', FALSE),
(4, 'Entretenir les machines', FALSE),
(4, 'Vérifier la conformité des produits', FALSE);

-- Insert choices for question 5 (Ressources Humaines - Recrutement)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(5, 'Attirer et sélectionner les meilleurs candidats', TRUE),
(5, 'Vendre des produits', FALSE),
(5, 'Réparer les machines', FALSE),
(5, 'Acheter des immobilisations', FALSE),
(5, 'Sécuriser l entrepôt', FALSE),
(5, 'Établir des factures', FALSE),
(5, 'Stocker des marchandises', FALSE),
(5, 'Former des clients', FALSE);

-- Insert choices for question 6 (Ressources Humaines - Entretien annuel)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(6, 'Évaluer les performances et fixer des objectifs', TRUE),
(6, 'Planifier la production', FALSE),
(6, 'Contrôler les stocks', FALSE),
(6, 'Négocier avec les fournisseurs', FALSE),
(6, 'Maintenir les équipements', FALSE),
(6, 'Créer des devis', FALSE),
(6, 'Gérer les finances', FALSE),
(6, 'Sécuriser les données', FALSE);

-- Insert choices for question 7 (Ressources Humaines - Formation continue)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(7, 'Développement des compétences des employés', TRUE),
(7, 'Achat de matériel', FALSE),
(7, 'Gestion des stocks', FALSE),
(7, 'Vente de produits', FALSE),
(7, 'Maintenance des machines', FALSE),
(7, 'Établissement des factures', FALSE),
(7, 'Planification de la production', FALSE),
(7, 'Contrôle qualité', FALSE);

-- Insert choices for question 8 (Ressources Humaines - Plan de carrière)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(8, 'Accompagner l évolution professionnelle des employés', TRUE),
(8, 'Planifier les ventes', FALSE),
(8, 'Gérer les immobilisations', FALSE),
(8, 'Organiser la sécurité', FALSE),
(8, 'Contrôler les stocks', FALSE),
(8, 'Maintenir les équipements', FALSE),
(8, 'Négocier les contrats', FALSE),
(8, 'Évaluer les fournisseurs', FALSE);

-- Insert choices for question 9 (Production - OEE)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(9, 'Efficacité globale des équipements', TRUE),
(9, 'Taux de productivité des employés', FALSE),
(9, 'Coût total de production', FALSE),
(9, 'Niveau de stock disponible', FALSE),
(9, 'Temps d arrêt des machines', FALSE),
(9, 'Qualité des produits finis', FALSE),
(9, 'Consommation énergétique', FALSE),
(9, 'Planification des ressources', FALSE);

-- Insert choices for question 10 (Production - Poste de travail)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(10, 'Espace équipé pour réaliser une tâche spécifique', TRUE),
(10, 'Logiciel de gestion de production', FALSE),
(10, 'Plan de travail annuel', FALSE),
(10, 'Équipe de travail', FALSE),
(10, 'Entrepôt de stockage', FALSE),
(10, 'Bureau administratif', FALSE),
(10, 'Système de contrôle qualité', FALSE),
(10, 'Ligne de production complète', FALSE);

-- Insert choices for question 11 (Production - Plan de production)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(11, 'Organiser et planifier les activités de production', TRUE),
(11, 'Former le personnel', FALSE),
(11, 'Contrôler la qualité des produits', FALSE),
(11, 'Gérer les finances de l entreprise', FALSE),
(11, 'Recruter des employés', FALSE),
(11, 'Maintenir les équipements', FALSE),
(11, 'Stocker les produits finis', FALSE),
(11, 'Négocier avec les fournisseurs', FALSE);

-- Insert choices for question 12 (Production - Maintenance préventive)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(12, 'Entretien planifié pour éviter les pannes', TRUE),
(12, 'Réparation après une panne', FALSE),
(12, 'Contrôle qualité des produits', FALSE),
(12, 'Achat de nouvelles machines', FALSE),
(12, 'Formation des opérateurs', FALSE),
(12, 'Optimisation des stocks', FALSE),
(12, 'Planification de la production', FALSE),
(12, 'Audit de sécurité', FALSE);

-- Insert choices for question 13 (Production - Goulot d étranglement)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(13, 'Étape limitant la capacité de production', TRUE),
(13, 'Excès de stock dans l entrepôt', FALSE),
(13, 'Manque de personnel qualifié', FALSE),
(13, 'Augmentation des ventes', FALSE),
(13, 'Panne d équipement', FALSE),
(13, 'Surproduction de biens', FALSE),
(13, 'Problème logistique', FALSE),
(13, 'Manque de matières premières', FALSE);

-- Insert choices for question 14 (Production - Lean manufacturing)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(14, 'Optimisation des processus pour réduire les gaspillages', TRUE),
(14, 'Augmentation de la production', FALSE),
(14, 'Gestion des ressources humaines', FALSE),
(14, 'Contrôle des stocks', FALSE),
(14, 'Maintenance des équipements', FALSE),
(14, 'Négociation avec les clients', FALSE),
(14, 'Planification financière', FALSE),
(14, 'Évaluation des fournisseurs', FALSE);

-- Insert choices for question 15 (Production - Diagramme de Pareto)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(15, 'Identifier les causes principales des problèmes', TRUE),
(15, 'Planifier la production', FALSE),
(15, 'Gérer les stocks', FALSE),
(15, 'Former le personnel', FALSE),
(15, 'Contrôler la qualité', FALSE),
(15, 'Négocier les prix', FALSE),
(15, 'Maintenir les machines', FALSE),
(15, 'Analyser les finances', FALSE);

-- Insert choices for question 16 (Production - Chaîne de production)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(16, 'Ensemble des étapes pour fabriquer un produit', TRUE),
(16, 'Logiciel de gestion', FALSE),
(16, 'Plan de formation', FALSE),
(16, 'Équipe de vente', FALSE),
(16, 'Stock de produits finis', FALSE),
(16, 'Système de sécurité', FALSE),
(16, 'Plan financier', FALSE),
(16, 'Entrepôt de stockage', FALSE);

-- Insert choices for question 17 (Achat et vente - B2B)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(17, 'Commerce entre entreprises', TRUE),
(17, 'Commerce avec les consommateurs', FALSE),
(17, 'Commerce en ligne uniquement', FALSE),
(17, 'Commerce international', FALSE),
(17, 'Commerce de détail', FALSE),
(17, 'Commerce de services', FALSE),
(17, 'Commerce interentreprises automatisé', FALSE),
(17, 'Commerce de gros', FALSE);

-- Insert choices for question 18 (Achat et vente - CRM)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(18, 'Système de gestion des relations clients', TRUE),
(18, 'Logiciel de comptabilité', FALSE),
(18, 'Outil de production', FALSE),
(18, 'Plateforme de recrutement', FALSE),
(18, 'Système de gestion des stocks', FALSE),
(18, 'Outil de planification', FALSE),
(18, 'Base de données financière', FALSE),
(18, 'Logiciel de sécurité', FALSE);

-- Insert choices for question 19 (Achat et vente - Commercial terrain)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(19, 'Prospecter et rencontrer les clients sur site', TRUE),
(19, 'Gérer les stocks en entrepôt', FALSE),
(19, 'Créer des campagnes publicitaires', FALSE),
(19, 'Analyser les données financières', FALSE),
(19, 'Former le personnel', FALSE),
(19, 'Maintenir les équipements', FALSE),
(19, 'Établir les contrats légaux', FALSE),
(19, 'Superviser la production', FALSE);

-- Insert choices for question 20 (Achat et vente - Devis)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(20, 'Estimation des coûts pour un client', TRUE),
(20, 'Facture finale à payer', FALSE),
(20, 'Contrat de vente', FALSE),
(20, 'Bon de commande', FALSE),
(20, 'Reçu de paiement', FALSE),
(20, 'Document comptable interne', FALSE),
(20, 'Plan de livraison', FALSE),
(20, 'Rapport de performance', FALSE);

-- Insert choices for question 21 (Achat et vente - Facture pro forma)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(21, 'Facture préalable non définitive', TRUE),
(21, 'Facture définitive à payer', FALSE),
(21, 'Contrat de prestation', FALSE),
(21, 'Reçu de paiement', FALSE),
(21, 'Bon de livraison', FALSE),
(21, 'Devis commercial', FALSE),
(21, 'Document fiscal obligatoire', FALSE),
(21, 'Rapport de vente', FALSE);

-- Insert choices for question 22 (Achat et vente - Prospection)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(22, 'Recherche de nouveaux clients', TRUE),
(22, 'Gestion des stocks', FALSE),
(22, 'Maintenance des équipements', FALSE),
(22, 'Formation du personnel', FALSE),
(22, 'Planification de la production', FALSE),
(22, 'Contrôle qualité', FALSE),
(22, 'Analyse financière', FALSE),
(22, 'Sécurisation des données', FALSE);

-- Insert choices for question 23 (Achat et vente - Négociation fournisseur)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(23, 'Obtenir de meilleures conditions d achat', TRUE),
(23, 'Vendre des produits', FALSE),
(23, 'Gérer les ressources humaines', FALSE),
(23, 'Planifier la production', FALSE),
(23, 'Maintenir les machines', FALSE),
(23, 'Contrôler les stocks', FALSE),
(23, 'Établir des factures', FALSE),
(23, 'Former les clients', FALSE);

-- Insert choices for question 24 (Achat et vente - Bon de commande)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(24, 'Document formalisant une demande d achat', TRUE),
(24, 'Facture pro forma', FALSE),
(24, 'Reçu de paiement', FALSE),
(24, 'Contrat de vente', FALSE),
(24, 'Devis commercial', FALSE),
(24, 'Rapport de vente', FALSE),
(24, 'Plan de livraison', FALSE),
(24, 'Document comptable interne', FALSE);

-- Insert choices for question 25 (Gestion de stock - FIFO)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(25, 'Premier entré, premier sorti', TRUE),
(25, 'Dernier entré, premier sorti', FALSE),
(25, 'Premier entré, dernier sorti', FALSE),
(25, 'Stock à rotation rapide', FALSE),
(25, 'Stock à rotation lente', FALSE),
(25, 'Gestion par lots', FALSE),
(25, 'Stock de sécurité', FALSE),
(25, 'Inventaire permanent', FALSE);

-- Insert choices for question 26 (Gestion de stock - Stock de sécurité)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(26, 'Réserve pour éviter les ruptures', TRUE),
(26, 'Stock pour les retours clients', FALSE),
(26, 'Stock excédentaire', FALSE),
(26, 'Stock en transit', FALSE),
(26, 'Stock obsolète', FALSE),
(26, 'Stock saisonnier', FALSE),
(26, 'Stock pour production', FALSE),
(26, 'Stock temporaire', FALSE);

-- Insert choices for question 27 (Gestion de stock - Inventaire)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(27, 'Vérifier la quantité et l état des stocks', TRUE),
(27, 'Planifier la production', FALSE),
(27, 'Recruter du personnel', FALSE),
(27, 'Analyser les ventes', FALSE),
(27, 'Maintenir les machines', FALSE),
(27, 'Gérer les finances', FALSE),
(27, 'Négocier avec les fournisseurs', FALSE),
(27, 'Créer des devis', FALSE);

-- Insert choices for question 28 (Gestion de stock - Entrepôt)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(28, 'Lieu de stockage des marchandises', TRUE),
(28, 'Bureau administratif', FALSE),
(28, 'Ligne de production', FALSE),
(28, 'Salle de réunion', FALSE),
(28, 'Centre de formation', FALSE),
(28, 'Espace de vente', FALSE),
(28, 'Zone de maintenance', FALSE),
(28, 'Plateforme logistique', FALSE);

-- Insert choices for question 29 (Gestion de stock - Rotation de stock)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(29, 'Fréquence de renouvellement des stocks', TRUE),
(29, 'Quantité totale en stock', FALSE),
(29, 'Coût de stockage', FALSE),
(29, 'Temps de livraison', FALSE),
(29, 'Niveau de stock minimum', FALSE),
(29, 'Plan de réapprovisionnement', FALSE),
(29, 'Stockage des produits finis', FALSE),
(29, 'Gestion des retours', FALSE);

-- Insert choices for question 30 (Gestion de stock - Réapprovisionnement)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(30, 'Commander de nouveaux stocks pour éviter les ruptures', TRUE),
(30, 'Vendre les stocks existants', FALSE),
(30, 'Former le personnel', FALSE),
(30, 'Maintenir les machines', FALSE),
(30, 'Analyser les finances', FALSE),
(30, 'Créer des devis', FALSE),
(30, 'Contrôler la qualité', FALSE),
(30, 'Négocier les prix', FALSE);

-- Insert choices for question 31 (Gestion de stock - LIFO)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(31, 'Dernier entré, premier sorti', TRUE),
(31, 'Premier entré, premier sorti', FALSE),
(31, 'Premier entré, dernier sorti', FALSE),
(31, 'Stock à rotation rapide', FALSE),
(31, 'Stock à rotation lente', FALSE),
(31, 'Gestion par lots', FALSE),
(31, 'Stock de sécurité', FALSE),
(31, 'Inventaire permanent', FALSE);

-- Insert choices for question 32 (Gestion de stock - Code-barres)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(32, 'Système d identification des produits', TRUE),
(32, 'Logiciel de gestion des stocks', FALSE),
(32, 'Plan de production', FALSE),
(32, 'Équipe de manutention', FALSE),
(32, 'Entrepôt automatisé', FALSE),
(32, 'Système de sécurité', FALSE),
(32, 'Plan de réapprovisionnement', FALSE),
(32, 'Contrôle qualité', FALSE);

-- Insert choices for question 33 (Gestion d immobilisation - Immobilisation)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(33, 'Actif durable utilisé par l entreprise', TRUE),
(33, 'Dette à court terme', FALSE),
(33, 'Produit vendu aux clients', FALSE),
(33, 'Frais de personnel', FALSE),
(33, 'Stock temporaire', FALSE),
(33, 'Revenu annuel', FALSE),
(33, 'Charge d exploitation', FALSE),
(33, 'Investissement à court terme', FALSE);

-- Insert choices for question 34 (Gestion d immobilisation - Amortissement)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(34, 'Répartition du coût d un actif sur sa durée de vie', TRUE),
(34, 'Augmentation de la valeur d un actif', FALSE),
(34, 'Vente d un actif', FALSE),
(34, 'Achat d un actif', FALSE),
(34, 'Évaluation des stocks', FALSE),
(34, 'Gestion des dettes', FALSE),
(34, 'Calcul des bénéfices', FALSE),
(34, 'Réparation d un actif', FALSE);

-- Insert choices for question 35 (Gestion d immobilisation - Immobilisation incorporelle)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(35, 'Brevet', TRUE),
(35, 'Véhicule', FALSE),
(35, 'Bâtiment', FALSE),
(35, 'Machine', FALSE),
(35, 'Stock de marchandises', FALSE),
(35, 'Mobilier de bureau', FALSE),
(35, 'Terrain', FALSE),
(35, 'Équipement informatique', FALSE);

-- Insert choices for question 36 (Gestion d immobilisation - Durée d amortissement)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(36, 'Période sur laquelle un actif est amorti', TRUE),
(36, 'Durée de vie d un produit', FALSE),
(36, 'Temps de production', FALSE),
(36, 'Délai de paiement', FALSE),
(36, 'Période de garantie', FALSE),
(36, 'Durée du contrat', FALSE),
(36, 'Temps de livraison', FALSE),
(36, 'Cycle de production', FALSE);

-- Insert choices for question 37 (Gestion d immobilisation - Cession d immobilisation)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(37, 'Vente ou transfert d un actif durable', TRUE),
(37, 'Achat d un actif', FALSE),
(37, 'Réparation d un actif', FALSE),
(37, 'Évaluation d un actif', FALSE),
(37, 'Stockage d un actif', FALSE),
(37, 'Amortissement d un actif', FALSE),
(37, 'Location d un actif', FALSE),
(37, 'Destruction d un actif', FALSE);

-- Insert choices for question 38 (Gestion d immobilisation - Immobilisation corporelle)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(38, 'Bâtiment', TRUE),
(38, 'Brevet', FALSE),
(38, 'Logiciel', FALSE),
(38, 'Marque déposée', FALSE),
(38, 'Fonds de commerce', FALSE),
(38, 'Droit d auteur', FALSE),
(38, 'Licence', FALSE),
(38, 'Contrat de franchise', FALSE);

-- Insert choices for question 39 (Gestion d immobilisation - Dépréciation)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(39, 'Réduction de la valeur d un actif due à une perte de valeur', TRUE),
(39, 'Augmentation de la valeur d un actif', FALSE),
(39, 'Vente d un actif', FALSE),
(39, 'Achat d un actif', FALSE),
(39, 'Amortissement d un actif', FALSE),
(39, 'Location d un actif', FALSE),
(39, 'Stockage d un actif', FALSE),
(39, 'Réparation d un actif', FALSE);

-- Insert choices for question 40 (Gestion d immobilisation - Dotation aux amortissements)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(40, 'Charge comptabilisée pour l amortissement annuel', TRUE),
(40, 'Achat d un actif', FALSE),
(40, 'Vente d un actif', FALSE),
(40, 'Réparation d un actif', FALSE),
(40, 'Évaluation des stocks', FALSE),
(40, 'Gestion des dettes', FALSE),
(40, 'Calcul des bénéfices', FALSE),
(40, 'Location d un actif', FALSE);

-- Insert choices for question 41 (Securite - Plan d évacuation)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(41, 'Schéma pour guider les évacuations d urgence', TRUE),
(41, 'Plan de maintenance des équipements', FALSE),
(41, 'Stratégie de production', FALSE),
(41, 'Plan de recrutement', FALSE),
(41, 'Plan financier', FALSE),
(41, 'Plan de formation', FALSE),
(41, 'Plan logistique', FALSE),
(41, 'Plan de marketing', FALSE);

-- Insert choices for question 42 (Securite - Extincteur)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(42, 'Éteindre les débuts d incendie', TRUE),
(42, 'Détecter la fumée', FALSE),
(42, 'Protéger contre les chutes', FALSE),
(42, 'Évacuer les fumées', FALSE),
(42, 'Sécuriser les machines', FALSE),
(42, 'Éclairer les sorties', FALSE),
(42, 'Contrôler l accès', FALSE),
(42, 'Mesurer la température', FALSE);

-- Insert choices for question 43 (Securite - EPI)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(43, 'Équipement de Protection Individuelle', TRUE),
(43, 'Équipement de Production Intégrée', FALSE),
(43, 'Évaluation des Performances Internes', FALSE),
(43, 'Entretien Préventif des Installations', FALSE),
(43, 'Équipement de Planification Industrielle', FALSE),
(43, 'Évaluation des Postes de travail', FALSE),
(43, 'Équipement de Protection Informatique', FALSE),
(43, 'Entretien des Postes Industriels', FALSE);

-- Insert choices for question 44 (Securite - Exercice incendie)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(44, 'Former le personnel à évacuer en cas d incendie', TRUE),
(44, 'Tester les machines', FALSE),
(44, 'Vérifier les stocks', FALSE),
(44, 'Planifier la production', FALSE),
(44, 'Former les nouveaux employés', FALSE),
(44, 'Contrôler la qualité', FALSE),
(44, 'Négocier avec les clients', FALSE),
(44, 'Analyser les finances', FALSE);

-- Insert choices for question 45 (Securite - RGPD)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(45, 'Données personnelles', TRUE),
(45, 'Équipements de production', FALSE),
(45, 'Stocks de marchandises', FALSE),
(45, 'Données financières', FALSE),
(45, 'Contrats commerciaux', FALSE),
(45, 'Plans de production', FALSE),
(45, 'Données de maintenance', FALSE),
(45, 'Rapports de vente', FALSE);

-- Insert choices for question 46 (Securite - Registre de sécurité)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(46, 'Document recensant les mesures de sécurité', TRUE),
(46, 'Plan de production', FALSE),
(46, 'Registre des ventes', FALSE),
(46, 'Inventaire des stocks', FALSE),
(46, 'Contrat de travail', FALSE),
(46, 'Rapport financier', FALSE),
(46, 'Plan de formation', FALSE),
(46, 'Liste des fournisseurs', FALSE);

-- Insert choices for question 47 (Securite - Détecteurs de fumée)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(47, 'Alerter en cas de détection de fumée', TRUE),
(47, 'Éteindre les incendies', FALSE),
(47, 'Protéger contre les chutes', FALSE),
(47, 'Contrôler l accès', FALSE),
(47, 'Sécuriser les machines', FALSE),
(47, 'Évacuer les fumées', FALSE),
(47, 'Mesurer la température', FALSE),
(47, 'Éclairer les sorties', FALSE);

-- Insert choices for question 48 (Securite - Analyse des risques)
INSERT INTO choix (id_question, texte, est_correct) VALUES
(48, 'Identification des dangers potentiels', TRUE),
(48, 'Planification de la production', FALSE),
(48, 'Gestion des stocks', FALSE),
(48, 'Formation du personnel', FALSE),
(48, 'Négociation avec les fournisseurs', FALSE),
(48, 'Contrôle qualité', FALSE),
(48, 'Analyse financière', FALSE),
(48, 'Établissement des factures', FALSE);

-- INSERT INTO annonce (id_critere, date_depot_limite, poste_voulu) VALUES
-- (1, '2025-12-31', 'Développeur Web');

-- INSERT INTO candidat (id_annonce, nom, prenom, mail, telephone, niveau_etude, experience, date_de_naissance, adresse, date_candidature) VALUES
-- (1, 'Dupont', 'Jean', 'jean.dupont@example.com', '0123456789', 'Licence', 2, '1990-01-01', '123 Rue Exemple', '2025-09-16');

insert into variable VALUES (5, 40, 60, '2025-18-09');