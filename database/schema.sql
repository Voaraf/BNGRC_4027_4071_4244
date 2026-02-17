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

INSERT INTO BNGRC_ville (nom_ville, image_ville) VALUES 
('Antananarivo', 'assets/img/antananarivo.png'),
('Toamasina', 'assets/img/toamasina.png'),
('Fianarantsoa', 'assets/img/fianarantsoa.png'),
('Mahajanga', 'assets/img/mahajanga.png'),
('Toliara', 'assets/img/toliara.png'),
('Antsirabe', 'assets/img/antsirabe.png');

  CREATE TABLE IF NOT EXISTS BNGRC_type (
    id_type INT AUTO_INCREMENT PRIMARY KEY,
    nom_type VARCHAR(100) UNIQUE,
    icone_type VARCHAR(255)
  );

  INSERT INTO BNGRC_type (nom_type, icone_type) VALUES
  ('Nature', 'assets/img/nourriture.png'),
  ('Matériaux', 'assets/img/materiaux.png'),
  ('Argent', 'assets/img/argent.png');

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

  INSERT INTO BNGRC_besoin (id_ville, type_besoin, besoin, quantite_besoin) VALUES
  (1, 1, 'riz', 200),
  (2, 2, 'brique', 100),
  (3, 3, 'argent', 5000),
  (1, 1, 'légumes', 150),
  (2, 2, 'bois', 80),
  (3, 3, 'argent', 7000),
  (1, 1, 'sucre', 450),
  (2, 2, 'sable', 400),
  (3, 3, 'argent', 9000),
  (1, 1, 'huile', 300);

  INSERT INTO BNGRC_donation (type_donation, donneur, donation, quantite_donnee) VALUES
  (1, 'John Doe', 'riz', 50),
  (2, 'Jane Smith', 'brique', 20),
  (3, 'Alice Johnson', 'argent', 1000),
  (1, 'Bob Brown', 'légumes', 30),
  (2, 'Charlie Davis', 'bois', 15),
  (3, 'Eve Wilson', 'argent', 2000),
  (1, 'Frank Miller', 'sucre', 100),
  (2, 'Grace Lee', 'sable', 150),
  (3, 'Hank Taylor', 'argent', 3000),
  (1, 'Ivy Anderson', 'huile', 80);

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

  CREATE TABLE IF NOR EXISTS BNGRC_remise (
    id_remise INT AUTO_INCREMENT PRIMARY KEY,
    id_besoin INT,
    quantite_remise DECIMAL(10,2),
    date_remise TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_besoin) REFERENCES BNGRC_besoin(id_besoin) ON DELETE CASCADE
  );