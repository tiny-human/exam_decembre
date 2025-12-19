

CREATE TABLE exam_vehicule (
    id_vehicule INT PRIMARY KEY AUTO_INCREMENT,
    numero VARCHAR(50)
);

CREATE TABLE exam_livreur (
    id_livreur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    salaire_chauffeur FLOAT
);

CREATE TABLE exam_statut (
    id_statut INT PRIMARY KEY AUTO_INCREMENT,
    statut VARCHAR(20)
);


CREATE TABLE exam_statut_zone(
    id_statut_zone INT PRIMARY KEY AUTO_INCREMENT,
    statut VARCHAR(100)
);

CREATE TABLE exam_zone (
    id_zone INT PRIMARY KEY AUTO_INCREMENT,
    id_statut_zone INT,
    nom_zone VARCHAR(100),
    pourcentage FLOAT,
    FOREIGN KEY (id_statut_zone) REFERENCES exam_statut_zone(id_statut_zone)
);



CREATE TABLE exam_colis (
    id_colis INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    poids FLOAT
);

CREATE TABLE exam_params_poids (
    id_param INT PRIMARY KEY AUTO_INCREMENT,
    prix_par_kg FLOAT
);

CREATE TABLE exam_livraison (
    id_livraison INT PRIMARY KEY AUTO_INCREMENT,
    date_livraison DATE,
    id_vehicule INT,
    id_livreur INT,
    id_colis INT,
    adresse_depart VARCHAR(100),
    id_zone INT,
    id_statut INT,
    cout_vehicule FLOAT,
    FOREIGN KEY (id_vehicule) REFERENCES exam_vehicule(id_vehicule),
    FOREIGN KEY (id_livreur) REFERENCES exam_livreur(id_livreur),
    FOREIGN KEY (id_colis) REFERENCES exam_colis(id_colis),
    FOREIGN KEY (id_zone) REFERENCES exam_zone(id_zone),
    FOREIGN KEY (id_statut) REFERENCES exam_statut(id_statut)
);

/* =========================
   DONNÉES
========================= */

INSERT INTO exam_vehicule (numero) VALUES
('V0001'), ('V0002'), ('V0003'), ('V0004'), ('V0005'),
('V0006'), ('V0007'), ('V0008'), ('V0009'), ('V0010');

INSERT INTO exam_livreur (nom, prenom, salaire_chauffeur) VALUES
('Rakoto','Jean',20000),
('Rasoa','Marie',20000),
('Randria','Paul',18000),
('Rabe','Sophie',15000),
('Leblanc','Dylan',15000),
('Ravao','Tsiky',15000),
('Mpanana','Giovan',15000),
('Noor','Taariq',15000),
('Naivosoa','Owan',18000),
('Rakotonjanahary','Yollan',18000),
('Manda','Miaro',20000),
('LeMinistre','Tiavina',20000);

INSERT INTO exam_statut (statut) VALUES
('attente'), ('livre'), ('annule');

INSERT INTO exam_statut_zone(statut) VALUES
('dispo'), ('supprimer');


INSERT INTO exam_zone (nom_zone, pourcentage,id_statut_zone) VALUES
('Itaosy',12.5,1),
('Ivato',12.5,1),
('Andoharanofotsy',12.5,1),
('Analakely/ville',0,1),
('Ambohimangakely',0,1);

INSERT INTO exam_colis (nom, poids) VALUES
('Vary',25),
('Kafe',10),
('Litchi',50),
('Vanille',2),
('Zebu viande',30);

INSERT INTO exam_params_poids (prix_par_kg) VALUES (8000);

INSERT INTO exam_livraison
(date_livraison,id_vehicule,id_livreur,id_colis,adresse_depart,id_zone,id_statut,cout_vehicule)
VALUES
('2024-12-01',1,1,1,'entrepot',1,1,15000),
('2024-12-02',2,2,2,'entrepot',2,2,20000),
('2024-12-03',3,3,3,'entrepot',3,2,18000),
('2024-12-04',4,4,4,'entrepot',4,3,25000),
('2024-12-05',1,2,5,'entrepot',5,1,30000);

/* =========================
   VUES
========================= */

CREATE OR REPLACE VIEW v_livraison_detail_cout AS
SELECT
    l.id_livraison,
    l.cout_vehicule,
    v.salaire_chauffeur
FROM exam_livraison l
JOIN exam_livreur v ON l.id_livreur = v.id_livreur;

CREATE OR REPLACE VIEW v_livraison_total_cout AS
SELECT
    l.id_livraison,
    l.date_livraison,
    (l.cout_vehicule + v.salaire_chauffeur) AS cout_revient
FROM exam_livraison l
JOIN exam_livreur v ON l.id_livreur = v.id_livreur;

CREATE OR REPLACE VIEW vue_prix_colis AS
SELECT
    l.id_livraison,
    l.date_livraison,
    c.nom AS colis,
    c.poids AS poids_kg,
    (c.poids * p.prix_par_kg) AS chiffre_affaire
FROM exam_livraison l
JOIN exam_colis c ON l.id_colis = c.id_colis
JOIN exam_params_poids p;

CREATE OR REPLACE VIEW v_benefice_par_jour AS
SELECT
    l.date_livraison AS jour,
    SUM(c.chiffre_affaire - r.cout_revient) AS benefice
FROM exam_livraison l
JOIN vue_prix_colis c ON c.id_livraison = l.id_livraison
JOIN v_livraison_total_cout r ON r.id_livraison = l.id_livraison
GROUP BY l.date_livraison;

CREATE OR REPLACE VIEW v_benefice_par_mois AS
SELECT
    YEAR(l.date_livraison) AS annee,
    MONTH(l.date_livraison) AS num_mois,
    MONTHNAME(l.date_livraison) AS mois,
    SUM(c.chiffre_affaire - r.cout_revient) AS benefice
FROM exam_livraison l
JOIN vue_prix_colis c ON c.id_livraison = l.id_livraison
JOIN v_livraison_total_cout r ON r.id_livraison = l.id_livraison
GROUP BY YEAR(l.date_livraison), MONTH(l.date_livraison)
ORDER BY annee DESC, num_mois DESC;

CREATE OR REPLACE VIEW v_benefice_par_annee AS
SELECT
    YEAR(l.date_livraison) AS annee,
    SUM(c.chiffre_affaire - r.cout_revient) AS benefice
FROM exam_livraison l
JOIN vue_prix_colis c ON c.id_livraison = l.id_livraison
JOIN v_livraison_total_cout r ON r.id_livraison = l.id_livraison
GROUP BY YEAR(l.date_livraison);
