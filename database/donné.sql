INSERT INTO BNGRC_ville (nom_ville, image_ville) VALUES 
('Toamasina', 'assets/img/toamasina.png'),
('Mananjary', 'assets/img/mananjary.png'),
('Farafangana', 'assets/img/farafangana.jpeg'),
('Nosy Be', 'assets/img/nosybe.jpeg'),
('Morondava', 'assets/img/morondava.jpeg');


INSERT INTO BNGRC_type (nom_type, icone_type) VALUES
  ('Nature', 'assets/img/nourriture.png'),
  ('Matériaux', 'assets/img/materiaux.png'),
  ('Argent', 'assets/img/argent.png');


INSERT INTO BNGRC_produits (nom_produit, id_type, prix_unitaire) VALUES
('Riz (kg)', 1, 3000),
('Eau (L)', 1, 1000),
('Huile (L)', 1, 6000),
('Haricots', 1, 4000),

('Tôle', 2, 25000),
('Bâche', 2, 15000),
('Clous (kg)', 2, 8000),
('Bois', 2, 10000),
('groupe', 2, 6750000),

('Argent', 3, 1);


    INSERT INTO BNGRC_remise (type_remise, pourcentage) VALUES 
  ('Nature', 10),
  ('Matériaux', 20);

  INSERT INTO BNGRC_besoin (id_ville, id_produit, quantite_besoin) VALUES

-- Toamasina
((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Toamasina'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Riz (kg)'), 800),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Toamasina'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Eau (L)'), 1500),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Toamasina'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Tôle'), 120),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Toamasina'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Bâche'), 200),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Toamasina'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Argent'), 12000000),

-- Mananjary
((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Mananjary'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Riz (kg)'), 500),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Mananjary'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Huile (L)'), 120),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Mananjary'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Tôle'), 80),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Mananjary'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Clous (kg)'), 60),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Mananjary'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Argent'), 6000000),

-- Farafangana
((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Farafangana'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Riz (kg)'), 600),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Farafangana'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Eau (L)'), 1000),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Farafangana'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Bâche'), 150),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Farafangana'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Bois'), 100),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Farafangana'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Argent'), 8000000),

-- Nosy Be
((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Nosy Be'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Riz (kg)'), 300),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Nosy Be'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Haricots'), 200),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Nosy Be'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Tôle'), 40),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Nosy Be'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Clous (kg)'), 30),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Nosy Be'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Argent'), 4000000),

-- Morondava
((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Morondava'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Riz (kg)'), 700),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Morondava'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Eau (L)'), 1200),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Morondava'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Bâche'), 180),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Morondava'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Bois'), 150),

((SELECT id_ville FROM BNGRC_ville WHERE nom_ville='Morondava'),
 (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Argent'), 10000000);


INSERT INTO BNGRC_donation (donneur, id_produit, quantite_donnee) VALUES

('Donneur 1', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Argent'), 5000000),
('Donneur 2', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Argent'), 3000000),
('Donneur 3', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Argent'), 4000000),
('Donneur 4', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Argent'), 1500000),
('Donneur 5', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Argent'), 6000000),

('Donneur 6', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Riz (kg)'), 400),
('Donneur 7', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Eau (L)'), 600),

('Donneur 8', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Tôle'), 50),
('Donneur 9', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Bâche'), 70),

('Donneur 10', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Haricots'), 100),
('Donneur 11', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Riz (kg)'), 2000),
('Donneur 12', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Tôle'), 300),
('Donneur 13', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Eau (L)'), 5000),
('Donneur 14', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Argent'), 20000000),
('Donneur 15', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Bâche'), 500),
('Donneur 16', (SELECT id_produit FROM BNGRC_produits WHERE nom_produit='Haricots'), 88);
