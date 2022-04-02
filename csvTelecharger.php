<?php $fdata = array();
if (isset($_POST['telechargerEntier'])){
    createCSV($fdata, $filename = "tableauEleves.csv", $table = "entier");
};

if (isset($_POST['telechargerPro'])){
    createCSV($fdata, $filename = "tableauElevesPro.csv", $table = "pro");
};

if (isset($_POST['telechargerReste'])){
    createCSV($fdata, $filename = "tableauElevesReste.csv", $table = "reste");
};

$fdata ='';
function createCSV ($fdata, $filename, $table){
    //creating a mycsv.csv file
    $cfile = fopen($filename, 'w');
        //Inserting the table headers
    $header_data=array('nom_eleve', 'prenom_eleve','ine_eleve','point_bac', 'point_travail_serieux', 'point_absence', 'point_attitude', 'point_etude_superieure', 'point_avis_pp', 'point_avis_proviseur', 'point_lettre_motivation', 'remarque', 'point_remarque', 'statut_dossier', 'total_point');
    fputcsv($cfile,$header_data);
    
    //Data to be inserted
    include('connexion_bdd.php');
    if ($table == "entier") {
        $reqTableau = $bdd->query('SELECT * FROM Grille ORDER BY ID');
        while ($donnees_grille = $reqTableau->fetch()) :
            $fdata =array(array($donnees_grille['nom_eleve'], $donnees_grille['prenom_eleve'],$donnees_grille['ine_eleve'],$donnees_grille['point_bac'],$donnees_grille['point_travail_serieux'],$donnees_grille['point_absence'],$donnees_grille['point_attitude'],$donnees_grille['point_etude_superieure'],$donnees_grille['point_avis_pp'],
            $donnees_grille['point_avis_proviseur'], $donnees_grille['point_lettre_motivation'],$donnees_grille['remarque'],$donnees_grille['point_remarque'],$donnees_grille['statut_dossier'],$donnees_grille['total_point']));
            foreach($fdata as $row) {
                fputcsv($cfile, $row);
            }
        endwhile;
        $reqTableau->closeCursor();
    }

    if ($table == "pro") {
        $reqTableau = $bdd->query('SELECT * FROM Grille WHERE point_bac = 8 ORDER BY ID;');
        while ($donnees_grille = $reqTableau->fetch()) :
            $fdata =array(array($donnees_grille['nom_eleve'], $donnees_grille['prenom_eleve'],$donnees_grille['ine_eleve'],$donnees_grille['point_bac'],$donnees_grille['point_travail_serieux'],$donnees_grille['point_absence'],$donnees_grille['point_attitude'],$donnees_grille['point_etude_superieure'],$donnees_grille['point_avis_pp'],
            $donnees_grille['point_avis_proviseur'], $donnees_grille['point_lettre_motivation'],$donnees_grille['remarque'],$donnees_grille['point_remarque'],$donnees_grille['statut_dossier'],$donnees_grille['total_point']));
            foreach($fdata as $row) {
                fputcsv($cfile, $row);
            }
        endwhile;
        $reqTableau->closeCursor();
    }

    if ($table == "reste") {
        $reqTableau = $bdd->query('SELECT * FROM Grille WHERE point_bac != 8 ORDER BY ID;');
        while ($donnees_grille = $reqTableau->fetch()) :
            $fdata =array(array($donnees_grille['nom_eleve'], $donnees_grille['prenom_eleve'],$donnees_grille['ine_eleve'],$donnees_grille['point_bac'],$donnees_grille['point_travail_serieux'],$donnees_grille['point_absence'],$donnees_grille['point_attitude'],$donnees_grille['point_etude_superieure'],$donnees_grille['point_avis_pp'],
            $donnees_grille['point_avis_proviseur'], $donnees_grille['point_lettre_motivation'],$donnees_grille['remarque'],$donnees_grille['point_remarque'],$donnees_grille['statut_dossier'],$donnees_grille['total_point']));
            foreach($fdata as $row) {
                fputcsv($cfile, $row);
            }
        endwhile;
        $reqTableau->closeCursor();
    }
    // save each row of the data
    //fputcsv($cfile, $fdata);
    rewind($cfile);
    fclose($cfile);

    // download file
    header('Content-type: text/csv');
    header('Content-disposition:attachment; filename="'.$filename.'"');
    readfile($filename);

}