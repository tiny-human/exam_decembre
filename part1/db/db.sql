CREATE TABLE exam_vehicule(
    id_vehicule INT PRIMARY KEY AUTO_INCREMENT,
    numero VARCHAR(50)
);
CREATE TABLE exam_livreur(
    id_livreur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    salaire_chauffeur FLOAT,
    prenom VARCHAR(50)
);
CREATE TABLE exam_statut(
    id_statut INT PRIMARY KEY AUTO_INCREMENT,
    statut VARCHAR(20)
);
CREATE TABLE exam_zone(
    id_zone INT PRIMARY KEY AUTO_INCREMENT,
    nom_zone VARCHAR(100)
);
CREATE TABLE exam_colis(
    id_colis INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    poids  FLOAT
);
CREATE TABLE exam_params_poids(
    id_param INT PRIMARY KEY AUTO_INCREMENT,
    prix_par_kg FLOAT
);
CREATE TABLE exam_livraison(
    id_livraison INT PRIMARY KEY AUTO_INCREMENT,
    date_livraison DATE,
    id_vehicule INT,
    id_livreur INT,
    id_colis INT,
    adresse_depart VARCHAR(100),
    id_zone INT,
    id_statut INT ,
    cout_vehicule FLOAT,
    FOREIGN KEY (id_vehicule) REFERENCES exam_vehicule(id_vehicule),
    FOREIGN KEY (id_livreur) REFERENCES exam_livreur(id_livreur),
    FOREIGN KEY (id_colis) REFERENCES exam_colis(id_colis),
    FOREIGN KEY (id_zone) REFERENCES exam_zone(id_zone),
    FOREIGN KEY (id_statut) REFERENCES exam_statut(id_statut)
);


INSERT INTO exam_vehicule (numero) VALUES
('V0001'),
('V0002'),
('V0003'),
('V0004');

-- 2. Insérer des livreurs (salaire en Ariary)
INSERT INTO exam_livreur (nom, prenom, salaire_chauffeur) VALUES
('Rakoto', 'Jean', 650000.00),    
('Rasoa', 'Marie', 750000.00),     
('Randria', 'Paul',700000.00),    
('Rabe', 'Sophie', 900000.00);

-- 3. Insérer des statuts
INSERT INTO exam_statut (statut) VALUES
('attente'),      
('livre'),         
('annule');         
    
-- 4. Insérer des zones (noms à Madagascar)
INSERT INTO exam_zone (nom_zone) VALUES
('Itaosy'),
('Ivato'),
('Andoharanofotsy'),
('Analakely/ville'),
('Ambohimangakely');

-- 5. Insérer des colis
INSERT INTO exam_colis (nom, poids) VALUES
('Vary', 25.0),
('Kafe', 10.0),
('Litchi', 50.0),
('Vanille 2kg', 2.0),
('Zebu viande 30kg', 30.0);

-- 6. Insérer paramètres de poids (prix par kg en Ariary)
INSERT INTO exam_params_poids (prix_par_kg) VALUES (1000.00); 

-- 7. Insérer des livraisons
INSERT INTO exam_livraison (date_livraison, id_vehicule, id_livreur, id_colis, adresse_depart, id_zone, id_statut, cout_vehicule) VALUES
('2024-12-01', 1, 1, 1, 'entrepot', 1, 1, 15000.00),
('2024-12-02', 2, 2, 2, 'entrepot', 2, 2, 20000.00),
('2024-12-03', 3, 3, 3, 'entrepot', 3, 2, 18000.00),
('2024-12-04', 4, 4, 4, 'entrepot', 4, 3, 25000.00),
('2024-12-05', 1, 2, 5, 'entrepot', 5, 1, 30000.00);

CREATE OR REPLACE view v_livraison_detail_cout
as SELECT  l.id_livraison , l.cout_vehicule , v.salaire_chauffeur FROM exam_livraison l JOIN exam_livreur v on l.id_livreur = v.id_livreur;

CREATE OR REPLACE view v_livraison_detail_colis
as SELECT  l.id_livraison , c.id_colis , c.nom , c.poids  FROM exam_livraison l JOIN exam_colis c on l.id_colis = c.id_colis;