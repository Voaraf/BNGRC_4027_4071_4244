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
    nom_type VARCHAR(100) UNIQUE,
    icone_type VARCHAR(255)
  );

  CREATE TABLE IF NOT EXISTS BNGRC_produits (
    id_produit INT AUTO_INCREMENT PRIMARY KEY,
    nom_produit VARCHAR(255),
    id_type INT,
    prix_unitaire DECIMAL(10, 2),
    FOREIGN KEY (id_type) REFERENCES BNGRC_type(id_type) ON DELETE CASCADE
  );

  CREATE TABLE IF NOT EXISTS BNGRC_besoin (
    id_besoin INT AUTO_INCREMENT PRIMARY KEY,
    id_ville INT,
    id_produit INT,
    quantite_besoin DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_produit) REFERENCES BNGRC_produits(id_produit) ON DELETE CASCADE,
    FOREIGN KEY (id_ville) REFERENCES BNGRC_ville(id_ville) ON DELETE CASCADE
  );

  CREATE TABLE IF NOT EXISTS BNGRC_donation (
    id_donation INT AUTO_INCREMENT PRIMARY KEY,
    donneur VARCHAR(255),
    id_produit INT,
    quantite_donnee DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_produit) REFERENCES BNGRC_produits(id_produit) ON DELETE CASCADE
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

  CREATE TABLE IF NOT EXISTS BNGRC_vente (
    id_vente INT AUTO_INCREMENT PRIMARY KEY,
    id_stock INT,
    quantite_vendue DECIMAL(10,2),
    montant_total DECIMAL(10,2),
    date_vente TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_stock) REFERENCES BNGRC_stock(id_stock) ON DELETE CASCADE
  );

  CREATE TABLE IF NOT EXISTS BNGRC_remise (
    id_remise INT AUTO_INCREMENT PRIMARY KEY,
    type_remise VARCHAR(255) NOT NULL,
    pourcentage DECIMAL(5,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );

  INSERT INTO BNGRC_remise (type_remise, pourcentage) VALUES 
  ('Nature', 10),
  ('Matériaux', 20);