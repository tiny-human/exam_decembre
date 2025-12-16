CREATE DATABASE taxibe;
use taxibe;

CREATE TABLE chauffeur(
    id_chauffeur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(250),
    prenom VARCHAR(250)
);

CREATE TABLE vehicule(
    id_vehicule INT PRIMARY KEY AUTO_INCREMENT,
    immatriculation VARCHAR(50)
);
CREATE TABLE trajet(
    id_trajet INT PRIMARY KEY AUTO_INCREMENT,
    debut DATETIME,
    fin DATETIME,
    montant_recette FLOAT,
    montant_carburant FLOAT,
    id_chauffeur INT,
    id_vehicule INT,
    distance FLOAT,
    FOREIGN KEY(id_chauffeur) REFERENCES chauffeur(id_chauffeur),
    FOREIGN KEY(id_vehicule) REFERENCES vehicule(id_vehicule)
);

CREATE TABLE panne(
    id_panne INT PRIMARY KEY AUTO_INCREMENT,
    id_vehicule INT,
    debut_panne DATETIME,
    fin_panne DATETIME,
    FOREIGN KEY(id_vehicule) REFERENCES vehicule(id_vehicule)
);

-- Chauffeurs
INSERT INTO chauffeur (nom, prenom) VALUES 
('Rakoto', 'Jean'),
('Rasoa', 'Mamy'),
('Andrianarivo', 'Sitraka'),
('Randriamamonjy', 'Hery'),
('Rajaonarison', 'Lala');

-- Véhicules
INSERT INTO vehicule (immatriculation) VALUES 
('1444 TBD'),
('6969 TAA'),
('2222 TU'),
('1235 TAG'),
('5641 TBA');

-- Trajets
INSERT INTO trajet (debut, fin, montant_recette, montant_carburant, id_chauffeur, id_vehicule,distance) VALUES
('2025-12-12 08:00:00', '2025-12-12 09:00:00', 50000, 20000, 1, 1,5),
('2025-12-12 09:30:00', '2025-12-12 10:15:00', 35000, 8000, 2, 2,15),
('2025-12-12 10:00:00', '2025-12-12 11:30:00', 80000, 16000, 3, 3,7),
('2025-12-12 11:00:00', '2025-12-12 11:45:00', 25000, 15000, 1, 4,20),
('2025-12-12 12:00:00', '2025-12-12 13:00:00', 60000, 12000, 4, 5,22);

INSERT INTO trajet (debut, fin, montant_recette, montant_carburant, id_chauffeur, id_vehicule,distance) VALUES
('2025-12-12 09:00:00', '2025-12-12 12:00:00', 40000, 20000, 1, 1,5);


INSERT INTO panne (id_vehicule, debut_panne, fin_panne) VALUES
(1, '2025-12-12', '2025-12-12'),
(2, '2025-12-13', '2025-12-13'),
(3, '2025-12-14', '2025-12-14'),
(4, '2025-12-14', '2025-12-14'),
(5, '2025-12-15', '2025-12-15'),
(1, '2025-12-16', '2025-12-16');

CREATE OR REPLACE VIEW vue_trajets_par_jour AS
SELECT 
    DATE(t.debut) AS jour,
    v.id_vehicule,
    v.immatriculation, 
    c.id_chauffeur,
    c.nom, 
    c.prenom,
    SUM(t.montant_recette) AS total_recette, 
    SUM(t.montant_carburant) AS total_carburant
FROM trajet t
JOIN vehicule v ON t.id_vehicule = v.id_vehicule
JOIN chauffeur c ON t.id_chauffeur = c.id_chauffeur
GROUP BY jour, v.id_vehicule, c.id_chauffeur, v.immatriculation, c.nom, c.prenom
ORDER BY jour ASC, v.id_vehicule ASC, c.id_chauffeur ASC;


-- SELECT SUM(t.montant_recette-t.montant_carburant) as benefice , v.immatriculation FROM trajet t JOIN vehicule v ON v.id_vehicule = t.id_vehicule GROUP BY v.id_vehicule;

CREATE OR REPLACE VIEW vue_benefice_par_jour AS
SELECT SUM(t.montant_recette-t.montant_carburant) as benefice, DATE(t.debut) as jour FROM trajet t GROUP BY jour; 

CREATE OR REPLACE VIEW vue_rentabilite AS
SELECT SUM(t.montant_recette-t.montant_carburant) as benefice, DATE(t.debut) as jour , t.distance as distance_trajet FROM trajet t GROUP BY jour ORDER BY benefice DESC LIMIT 3;

CREATE OR REPLACE VIEW vue_liste_panne AS
SELECT   p.id_panne ,p.debut_panne , p.fin_panne , v.id_vehicule , v.immatriculation FROM panne p JOIN vehicule v on p.id_vehicule = v.id_vehicule;
