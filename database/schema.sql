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
