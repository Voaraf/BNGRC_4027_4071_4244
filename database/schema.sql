CREATE DATABASE IF NOT EXISTS BNGRC_DB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE BNGRC_DB;

CREATE TABLE IF NOT EXISTS BNGRC_user (
  id_users INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(150) UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS BNGRC_ville (
  id_ville INT AUTO_INCREMENT PRIMARY KEY,
  nom_ville VARCHAR(100) UNIQUE,
  image_ville VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS BNGRC_type (
  id_type INT AUTO_INCREMENT PRIMARY KEY,
  nom_type VARCHAR(100) UNIQUE

);

INSERT INTO BNGRC_type (nom_type) VALUES 
('Besoins'),
('Médicaments'),
('Vêtements'),
('Matériel de secours'),
('Nourriture'),
('Autre');

CREATE TABLE IF NOT EXISTS BNGRC_besoin (
  id_besoin INT AUTO_INCREMENT PRIMARY KEY,
  id_ville INT,
  type_besoin INT,
  besoin VARCHAR(255),
  quantite_besoin DECIMAL(10, 2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (type_besoin) REFERENCES BNGRC_type(id_type) ON DELETE CASCADE,
  FOREIGN KEY (id_ville) REFERENCES BNGRC_ville(id_ville) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS BNGRC_donation (
  id_donation INT AUTO_INCREMENT PRIMARY KEY,
  type_donation INT,
  donneur VARCHAR(255),
  donation VARCHAR(255),
  quantite_donnee DECIMAL(10, 2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (type_donation) REFERENCES BNGRC_type(id_type) ON DELETE CASCADE
);



CREATE TABLE IF NOT EXISTS BNGRC_distribution(
  id_distribution INT AUTO_INCREMENT PRIMARY KEY,
  id_donation INT,
  id_besoin INT,
  quantite_donnee DECIMAL(10, 2),
  date_distribution TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_donation) REFERENCES BNGRC_donation(id_donation) ON DELETE CASCADE,
  FOREIGN KEY (id_besoin) REFERENCES BNGRC_besoin(id_besoin) ON DELETE CASCADE
);

(5, 3, 'argent', 7000),
(6, 1, 'sucre', 450),
(6, 2, 'sable', 400),
(6, 3, 'argent', 9000);

CREATE TABLE IF NOT EXISTS BNGRC_donation (
  id_donation INT AUTO_INCREMENT PRIMARY KEY,
  type_donation INT,
  donneur VARCHAR(255),
  donation VARCHAR(255),
  quantite_donnee DECIMAL(10, 2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (type_donation) REFERENCES BNGRC_type(id_type) ON DELETE CASCADE
);

INSERT INTO BNGRC_donation (type_donation, donneur, donation, quantite_donnee) VALUES
(1, 'Alice', 'riz', 200),
(2, 'Bob', 'brique', 100),
(3, 'Charlie', 'argent', 5000),
(1, 'David', 'légumes', 150),
(2, 'Eve', 'bois', 80),
(3, 'Frank', 'argent', 300000),
(1, 'Grace', 'farine', 250),
(2, 'Heidi', 'tôle', 50),
(3, 'Ivan', 'argent', 4000),
(1, 'Judy', 'pâtes', 100),
(2, 'Karl', 'ciment', 120),
(3, 'Leo', 'argent', 2000),
(1, 'Mallory', 'huile', 80),
(2, 'Nina', 'fer', 150),
(3, 'Oscar', 'argent', 3500),
(1, 'Peggy', 'sucre', 300),
(2, 'Quentin', 'sable', 200),
(3, 'Ruth', 'argent', 4500);


CREATE TABLE IF NOT EXISTS BNGRC_distribution(
  id_distribution INT AUTO_INCREMENT PRIMARY KEY,
  id_donation INT,
  id_besoin INT,
  quantite_donnee DECIMAL(10, 2),
  date_distribution TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_donation) REFERENCES BNGRC_donation(id_donation) ON DELETE CASCADE,
  FOREIGN KEY (id_besoin) REFERENCES BNGRC_besoin(id_besoin) ON DELETE CASCADE
);



CREATE TABLE BNGRC_prix_unitaire (
  id_prix_unitaire INT AUTO_INCREMENT PRIMARY KEY,
  type INT,
  prix DECIMAL(10,2),
  date_mise_a_jour TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (type) REFERENCES BNGRC_type(id_type) ON DELETE CASCADE
);

INSERT INTO BNGRC_prix_unitaire (type, prix) VALUES 
(1, 1900),
(2, 2000);

CREATE TABLE IF NOT EXISTS BNGRC_achats (
  id_achat INT AUTO_INCREMENT PRIMARY KEY,
  id_besoin INT,
  quantite_achetee DECIMAL(10,2),
  montant_total DECIMAL(10,2),
  date_achat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_besoin) REFERENCES BNGRC_besoin(id_besoin) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS BNGRC_stock (
  id_stock INT AUTO_INCREMENT PRIMARY KEY,
  nom_besoin VARCHAR(255) NOT NULL,
  id_type INT NOT NULL,
  quantite DECIMAL(10,2) NOT NULL DEFAULT 0,
  id_ville INT,
  date_maj TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_type) REFERENCES BNGRC_type(id_type) ON DELETE CASCADE
);