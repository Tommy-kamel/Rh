/* INSERT INTO criteres (age_min, sexe, experience, diplome_requis, langues_maitrisees, age_max) VALUES
(22, 'Indifférent', 2, 'Licence', 'Français, Anglais', 35),
(25, 'Femme', 3, 'Master', 'Français', 40),
(28, 'Homme', 5, 'BTS', 'Français, Anglais', 45); */
/* 
INSERT INTO annonce (id_critere, date_depot_limite, poste_voulu) VALUES
(1, '2025-09-30', 'Développeur Web'),
(2, '2025-10-15', 'Assistant RH'),
(3, '2025-10-01', 'Comptable'),
(1, '2025-09-25', 'Technicien Informatique'),
(2, '2025-10-20', 'Chargé de Communication'); */

INSERT INTO fonction (nom_fonction) VALUES
('Ressources Humaines'),
('Production'),
('Achat et vente'),
('Gestion de stock'),
('Gestion d''immobilisation');

INSERT INTO user (id_fonction,nom_utilisateur, mot_de_passe) VALUES 
(1,'rh_user', 'RH'),
(2,'production_user', 'PROD'),
(3,'achat_vente_user', 'ACHAT'),
(4,'stock_user', 'STOCK'),
(5,'immobilisation_user', 'IMMO');


