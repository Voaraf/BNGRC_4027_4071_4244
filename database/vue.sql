CREATE OR REPLACE VIEW info_ville AS
SELECT v.nom_ville, t.nom_type, b.besoin, b.quantite_besoin, d.donation, d.quantite_donnee, v.image_ville
FROM BNGRC_ville v
JOIN BNGRC_besoin b ON v.id_ville = b.id_ville
JOIN BNGRC_type t ON b.type_besoin = t.id_type
JOIN BNGRC_donation d ON b.type_besoin = d.type_donation;