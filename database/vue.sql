CREATE OR REPLACE VIEW v_statistiques_recap AS
SELECT
    (SELECT COALESCE(SUM(b.quantite_besoin * p.prix_unitaire), 0) 
     FROM BNGRC_besoin b 
     JOIN BNGRC_produits p ON b.id_produit = p.id_produit) as total_besoins,
    
    (SELECT COALESCE(SUM(montant_total), 0) FROM BNGRC_achats) + 
    (SELECT COALESCE(SUM(d.quantite_donnee * p.prix_unitaire), 0) 
     FROM BNGRC_distribution d 
     JOIN BNGRC_besoin b ON d.id_besoin = b.id_besoin
     JOIN BNGRC_produits p ON b.id_produit = p.id_produit) as besoins_satisfaits,

    (SELECT COALESCE(SUM(don.quantite_donnee * p.prix_unitaire), 0) 
     FROM BNGRC_donation don 
     JOIN BNGRC_produits p ON don.id_produit = p.id_produit) as dons_recus,

    (SELECT COALESCE(SUM(montant_total), 0) FROM BNGRC_achats) + 
    (SELECT COALESCE(SUM(d.quantite_donnee * p.prix_unitaire), 0) 
     FROM BNGRC_distribution d 
     JOIN BNGRC_besoin b ON d.id_besoin = b.id_besoin
     JOIN BNGRC_produits p ON b.id_produit = p.id_produit) as besoins_satisfaits_total;

CREATE OR REPLACE VIEW v_stockage AS
SELECT 
    nom_besoin,
    SUM(quantite) AS total_quantite
FROM BNGRC_stock
GROUP BY nom_besoin;

CREATE OR REPLACE VIEW v_verifierSiStockDispo AS
SELECT
    st.id_stock,
    st.nom_besoin,
    st.quantite as total_quantite,
    st.id_type,
    t.nom_type,
    t.icone_type,
    p.prix_unitaire
FROM BNGRC_stock st
JOIN BNGRC_type t ON st.id_type = t.id_type
JOIN BNGRC_produits p ON st.nom_besoin = p.nom_produit
LEFT JOIN BNGRC_besoin b ON p.id_produit = b.id_produit
WHERE b.id_besoin IS NULL 
AND st.id_type != (SELECT id_type FROM BNGRC_type WHERE nom_type = 'Argent');
