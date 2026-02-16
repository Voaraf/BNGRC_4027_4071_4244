CREATE TABLE IF NOT EXISTS BNGRC_stock (
  id_stock INT AUTO_INCREMENT PRIMARY KEY,
  nom_besoin VARCHAR(255) NOT NULL,
  id_type INT NOT NULL,
  quantite DECIMAL(10,2) NOT NULL DEFAULT 0,
  date_maj TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_type) REFERENCES BNGRC_type(id_type) ON DELETE CASCADE
);
-- Pour éviter les doublons, on peut ajouter un index unique :
-- ALTER TABLE BNGRC_stock ADD UNIQUE unique_stock (nom_besoin, id_ville, id_type);
