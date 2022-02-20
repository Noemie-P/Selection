<?php session_start();
include('connexion_bdd.php');
$nom_eleve=$_POST['nom_eleve'];
$prenom_eleve=$_POST['prenom_eleve'];
$ine_eleve=$_POST['ine_eleve'];
$bac =$_POST['bac'];
$travail_serieux=$_POST['travail'];
$absence =$_POST['absence'];
$attitude =$_POST['attitude'];
$etude_superieure =$_POST['etude_superieure'];
$avis_pp=$_POST['avis_pp'];
$avis_proviseur=$_POST['avis_proviseur'];
$lettre_motivation=$_POST['lettre'];
$remarque=$_POST['remarque'];
$point_remarque =0;
$statut_dossier = $_POST['statut_dossier'];

if (!isset($_POST['statut_dossier'])) {
    $statut_dossier = 'non evalué';
}
else {
    $statut_dossier = $_POST['statut_dossier'];
}
switch ($bac)
{
    case 'pro':
        $point_bac = 8;
    break;
    case 'ses':
        $point_bac = 12;
    break;
    case 'l':
        $point_bac = 9;
    break;
    case 'stmg':
        $point_bac = 10;
    break;
    case 'autre':
        $point_bac = 5;
    break;
    default:
}
switch ($travail_serieux)
{
    case 'oui':
        $point_travail= 1;
    break;
    case 'non':
        $point_travail = -1;
    break;
    default:
}
switch ($absence)
{
    case 'oui':
        $statut_dossier = 'refusé';
        $point_absence= -2;
    break;
    case 'non':
        $point_absence = 1;
    break;
    default:
}
switch ($attitude)
{
    case 'oui':
        $statut_dossier = 'refusé';
        $point_attitude = 0;
    break;
    case 'non':
        $point_attitude = 1;
    break;
    default:
}
switch ($etude_superieure)
{
    case 'oui':
        $point_etude_superieure= 1;
    break;
    case 'non':
        $point_etude_superieure = 0;
    break;
    default:
}
switch ($avis_pp)
{
    case 'b':
        $point_avis_pp= 2;
    break;
    case 'ab':
        $point_avis_pp = 1;
    break;
    case 'insuf':
        $point_avis_pp= -1;
    break;
    case 'negatif':
        $point_avis_pp = -2;
    break;
    default:
}
switch ($avis_proviseur)
{
    case 'b':
        $point_avis_proviseur= 2;
    break;
    case 'ab':
        $point_avis_proviseur = 1;
    break;
    case 'insuf':
        $point_avis_proviseur= -1;
    break;
    case 'negatif':
        $point_avis_proviseur = -2;
    break;
    default:
}
switch ($lettre_motivation)
{
    case 'b':
        $point_lettre_motivation= 2;
    break;
    case 'ab':
        $point_lettre_motivation = 1;
    break;
    case 'insuf':
        $point_lettre_motivation= -1;
    break;
    case 'neg':
        $point_lettre_motivation = -2;
    break;
    default:
}

$total_point = $point_bac + $point_travail + $point_absence + $point_attitude +$point_etude_superieure +$point_avis_pp + $point_avis_proviseur +$point_lettre_motivation + $point_remarque;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $req_grille = $bdd->prepare('UPDATE Grille SET nom_eleve = :nom_eleve, prenom_eleve = :prenom_eleve, ine_eleve = :ine_eleve, point_bac = :point_bac, point_travail_serieux = :point_travail_serieux, point_absence = :point_absence,
     point_attitude = :point_attitude, point_etude_superieure = :point_etude_superieure, point_avis_pp = :point_avis_pp, point_avis_proviseur = :point_avis_proviseur, point_lettre_motivation = :point_lettre_motivation, remarque = :remarque,
     point_remarque = :point_remarque, statut_dossier = :statut_dossier, total_point = :total_point WHERE id ='. $id);
    $req_grille->execute(array(
        'nom_eleve' => $nom_eleve,
        'prenom_eleve' => $prenom_eleve,
        'ine_eleve' => $ine_eleve,
        'point_bac' => $point_bac,
        'point_travail_serieux' => $point_travail,
        'point_absence' => $point_absence,
        'point_attitude' => $point_attitude,
        'point_etude_superieure' => $point_etude_superieure,
        'point_avis_pp' => $point_avis_pp,
        'point_avis_proviseur'=> $point_avis_proviseur,
        'point_lettre_motivation' => $point_lettre_motivation,
        'remarque'=> $remarque,
        'point_remarque' =>$point_remarque,
        'statut_dossier' => $statut_dossier,
        'total_point'=>$total_point,
    ));
    $req_grille ->closeCursor();
    header("Location:classement.php");
}
else {
    $total_point = $point_bac + $point_travail + $point_absence + $point_attitude +$point_etude_superieure +$point_avis_pp + $point_avis_proviseur +$point_lettre_motivation + $point_remarque;
    $req_grille = $bdd->prepare('INSERT INTO Grille(nom_eleve, prenom_eleve, ine_eleve, point_bac, point_travail_serieux, point_absence, point_attitude, point_etude_superieure, point_avis_pp, point_avis_proviseur, point_lettre_motivation, remarque, point_remarque, statut_dossier, total_point)
    VALUES(:nom_eleve, :prenom_eleve, :ine_eleve, :point_bac, :point_travail_serieux, :point_absence, :point_attitude, :point_etude_superieure, :point_avis_pp, :point_avis_proviseur, :point_lettre_motivation, :remarque, :point_remarque, :statut_dossier, :total_point )');
    $req_grille->execute(array(
        'nom_eleve' => $nom_eleve,
        'prenom_eleve' => $prenom_eleve,
        'ine_eleve' => $ine_eleve,
        'point_bac' => $point_bac,
        'point_travail_serieux' => $point_travail,
        'point_absence' => $point_absence,
        'point_attitude' => $point_attitude,
        'point_etude_superieure' => $point_etude_superieure,
        'point_avis_pp' => $point_avis_pp,
        'point_avis_proviseur'=> $point_avis_proviseur,
        'point_lettre_motivation' => $point_lettre_motivation,
        'remarque'=> $remarque,
        'point_remarque' =>$point_remarque,
        'statut_dossier' => $statut_dossier,
        'total_point'=>$total_point,
        ));

    $req_grille ->closeCursor();
    header('Location: classement.php');
}
?>