CREATE TABLE Utilisateur(
    id TINYINT AUTO_INCREMENT PRIMARY KEY,
   identifiant VARCHAR(50),
   mdp VARCHAR(50),
   type_de_compte VARCHAR(50)
);

CREATE TABLE Grille(
    ID TINYINT AUTO_INCREMENT PRIMARY KEY,
    nom_eleve VARCHAR(50),
    prenom_eleve VARCHAR(50),
    ine_eleve CHAR(11),
    point_bac SMALLINT,
    point_travail_serieux SMALLINT,
    point_absence SMALLINT,
    point_attitude SMALLINT,
    point_etude_superieure SMALLINT,
    point_avis_pp SMALLINT,
    point_avis_proviseur SMALLINT,
    point_lettre_motivation SMALLINT,
    remarque TEXT,
    point_remarque SMALLINT,
    statut_dossier VARCHAR(50),
    total_point INT
);