<?php
include ("connexion_bdd.php");
$annee = $_GET['annee'];

$sql = "SELECT * FROM Statistiques WHERE annee ='".$annee."'";  //This is where I specify what data to query
    $result = $bdd->query($sql);
    $data = array();
    while($donnee = $result->fetch()){
        $ligne = array($donnee['annee'], $donnee['total_eleves'], $donnee['bac_pro'], $donnee['autre_bac']);
        array_push($data, $ligne);
    }
    echo json_encode($data);
    
