<?php 
include('connexion_bdd.php');
if (isset($_POST["archiver"])) {
    $pro = $_POST["pro"];
    $reste = $_POST["reste"];
    $total = $_POST["total"];
    $annee = $_POST["annee"];

    $req_stats = $bdd->query("SELECT *FROM Statistiques WHERE annee = '".$annee."'");
    if ($req_stats->rowCount() == 0) {
        $req_archive = $bdd->prepare(
            'INSERT INTO Statistiques(annee, total_eleves, bac_pro, autre_bac)
            VALUES (:annee, :total_eleves, :bac_pro, :autre_bac)'
        );
        if ($req_archive->execute(array(
            'annee' =>$annee,
            'total_eleves'=> $total,
            'bac_pro'=> $pro,
            'autre_bac'=> $reste,
        ))) {
            $req_grille = $bdd->exec('DELETE FROM Grille');
            header("Location: statistiques.php"); 
        }
        else {
            echo "Les données n'ont pas pu être enregistrées. Le classement n'a pas été supprimé";
            $req_archive ->closeCursor();
            $req_stats ->closeCursor();
        }
    }
    else {
        echo "Les statistiques de cette année ont déjà été enregistrées.";
    }
}
