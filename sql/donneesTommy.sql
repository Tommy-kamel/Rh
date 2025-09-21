INSERT INTO criteres (age_min, sexe, experience, diplome_requis, langues_maitrisees, age_max, lieu_a_proximite) VALUES
(18, 'Tous', 0, 'BAC', 'Français, Anglais', 35, 'Antananarivo'),
(20, 'Femme', 2, 'LICENCE', 'Français, Anglais, Malgache', 40, 'Toamasina'),
(25, 'Tous', 3, 'MASTER', 'Français, Anglais', 45, 'Fianarantsoa'),
(18, 'Homme', 1, 'BAC', 'Français', 30, 'Antsirabe'),
(22, 'Tous', 4, 'MASTER', 'Français, Anglais, Espagnol', 50, 'Mahajanga');

INSERT INTO annonce (id_critere, date_depot_limite, poste_voulu) VALUES
(1, '2025-09-30', 'Développeur Web'),
(2, '2025-10-15', 'Assistant RH'),
(3, '2025-10-01', 'Comptable'),
(1, '2025-09-25', 'Technicien Informatique'),
(2, '2025-10-20', 'Chargé de Communication'),
(3, '2025-10-05', 'Ingénieur Logiciel'),
(1, '2025-09-28', 'Designer Graphique'),
(2, '2025-10-10', 'Responsable Marketing');

INSERT INTO candidat (id_annonce, nom, prenom, mail, telephone, niveau_etude, experience, date_de_naissance, adresse, sexe, photo, date_candidature) VALUES
(1, 'Rakoto', 'Jean', 'jean.rakoto@email.com', '0341234567', 'LICENCE', 2, '1995-05-15', 'Antananarivo', 'Homme', '68caa97812469_Aesthetic-wallpaper-laptop.png', '2025-09-01'),
(2, 'Rabe', 'Marie', 'marie.rabe@email.com', '0342345678', 'MASTER', 3, '1992-08-20', 'Toamasina', 'Femme', '68cab698bf253_fond2.png', '2025-09-02'),
(3, 'Andriana', 'Paul', 'paul.andriana@email.com', '0343456789', 'BAC', 1, '1998-12-10', 'Fianarantsoa', 'Homme', '68caa97812469_Aesthetic-wallpaper-laptop.png', '2025-09-03'),
(4, 'Rasoa', 'Sophie', 'sophie.rasoa@email.com', '0344567890', 'LICENCE', 4, '1990-03-25', 'Antsirabe', 'Femme', '68cab698bf253_fond2.png', '2025-09-04'),
(5, 'Randria', 'Michel', 'michel.randria@email.com', '0345678901', 'MASTER', 5, '1988-07-30', 'Mahajanga', 'Homme', '68caa97812469_Aesthetic-wallpaper-laptop.png', '2025-09-05'),
(1, 'Ravo', 'Alice', 'alice.ravo@email.com', '0346789012', 'BAC', 0, '2000-01-05', 'Toliara', 'Femme', '68cab698bf253_fond2.png', '2025-09-06'),
(2, 'Andria', 'Thomas', 'thomas.andria@email.com', '0347890123', 'LICENCE', 2, '1996-11-18', 'Antsiranana', 'Homme', '68caa97812469_Aesthetic-wallpaper-laptop.png', '2025-09-07'),
(3, 'Ranaivo', 'Julie', 'julie.ranaivo@email.com', '0348901234', 'MASTER', 3, '1993-09-12', 'Nosy Be', 'Femme', '68cab698bf253_fond2.png', '2025-09-08');

INSERT INTO candidat_retenu (id_candidat, nom, prenom, mail, telephone, niveau_etude, experience, date_de_naissance, adresse, sexe, photo, date_creation) VALUES
(1, 'Rakoto', 'Jean', 'jean.rakoto@email.com', '0341234567', 'LICENCE', 2, '1995-05-15', 'Antananarivo', 'Homme', '68caa97812469_Aesthetic-wallpaper-laptop.png', '2025-09-10'),
(2, 'Rabe', 'Marie', 'marie.rabe@email.com', '0342345678', 'MASTER', 3, '1992-08-20', 'Toamasina', 'Femme', '68cab698bf253_fond2.png', '2025-09-11'),
(4, 'Rasoa', 'Sophie', 'sophie.rasoa@email.com', '0344567890', 'LICENCE', 4, '1990-03-25', 'Antsirabe', 'Femme', '68cab698bf253_fond2.png', '2025-09-12');
   
INSERT INTO employe (nom, prenom, mail, telephone, date_naissance, adresse) VALUES
('Andrianarivo', 'Marc', 'marc.andrianarivo@email.com', '0345678901', '1985-03-15', 'Antananarivo'),
('Razafindrakoto', 'Lina', 'lina.razafindrakoto@email.com', '0346789012', '1990-07-22', 'Toamasina'),
('Rakotoarisoa', 'Hery', 'hery.rakotoarisoa@email.com', '0347890123', '1988-11-10', 'Fianarantsoa'),
('Ramanantsoa', 'Fara', 'fara.ramanantsoa@email.com', '0348901234', '1992-05-30', 'Antsirabe'),
('Randrianasolo', 'Tina', 'tina.randrianasolo@email.com', '0349012345', '1987-09-18', 'Mahajanga');

-- Insertion des contrats d'essai (données de test)
INSERT INTO contrat_essai (id_candidat_retenu, date_debut, date_fin, salaire) VALUES
(1, '2025-09-15', NULL, 800000.00),  -- Contrat en cours
(2, '2025-09-16', NULL, 1000000.00), -- Contrat en cours
(3, '2025-09-17', '2025-12-17', 900000.00); -- Contrat terminé