CREATE OR REPLACE VIEW v_statistiques_recap AS
SELECT
    (SELECT COALESCE(SUM(b.quantite_besoin * COALESCE((
        SELECT prix FROM BNGRC_prix_unitaire pu 
        WHERE pu.type = b.type_besoin 
        ORDER BY pu.date_mise_a_jour DESC LIMIT 1
    ), 0)), 0) FROM BNGRC_besoin b) as total_besoins,
    
    (SELECT COALESCE(SUM(montant_total), 0) FROM BNGRC_achats) + 
    (SELECT COALESCE(SUM(d.quantite_donnee * COALESCE((
        SELECT prix FROM BNGRC_prix_unitaire pu 
        WHERE pu.type = (SELECT type_besoin FROM BNGRC_besoin WHERE id_besoin = d.id_besoin)
        ORDER BY pu.date_mise_a_jour DESC LIMIT 1
    ), 0)), 0) FROM BNGRC_distribution d) as besoins_satisfaits,

    (SELECT COALESCE(SUM(
        CASE 
            WHEN t.nom_type = 'Argent' THEN don.quantite_donnee 
            ELSE don.quantite_donnee * COALESCE((
                SELECT prix FROM BNGRC_prix_unitaire pu 
                WHERE pu.type = don.type_donation 
                ORDER BY pu.date_mise_a_jour DESC LIMIT 1
            ), 0)
        END
    ), 0) FROM BNGRC_donation don JOIN BNGRC_type t ON don.type_donation = t.id_type) as dons_recus,

    (SELECT COALESCE(SUM(montant_total), 0) FROM BNGRC_achats) + 
    (SELECT COALESCE(SUM(d.quantite_donnee * COALESCE((
        SELECT prix FROM BNGRC_prix_unitaire pu 
        WHERE pu.type = (SELECT type_besoin FROM BNGRC_besoin WHERE id_besoin = d.id_besoin)
        ORDER BY pu.date_mise_a_jour DESC LIMIT 1
    ), 0)), 0) FROM BNGRC_distribution d) as dons_dispatches;

CREATE OR REPLACE VIEW v_stockage AS
SELECT 
    nom_besoin,
    SUM(quantite) AS total_quantite
FROM BNGRC_stock
GROUP BY nom_besoin;

CREATE OR REPLACE VIEW v_verifierSiStockDispo AS
SELECT
    s.nom_besoin, s.total_quantite
FROM v_stockage s
LEFT JOIN BNGRC_besoin b ON s.nom_besoin = b.besoin
WHERE b.besoin IS NULL AND s.id_type != (SELECT id_type FROM BNGRC_type WHERE nom_type = 'Argent');