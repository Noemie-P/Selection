<?php
include("connexion_bdd.php");
$identifiant = $_POST['loginID'];
$mdp = $_POST['password'];

$req = $bdd->prepare('SELECT mdp, type_de_compte FROM Utilisateur WHERE identifiant = ?');
$req->execute(array($identifiant));

while ($donnees = $req->fetch()){
    $pwdBDD = $donnees['mdp'];
    $tdcBDD = $donnees['type_de_compte'];
}

$req->closeCursor();

if (isset($_POST['loginID']) AND isset($_POST['password']))
{
    if ($mdp === $pwdBDD) {
        session_start();
        $_SESSION['identifiant'] = $identifiant;
        $_SESSION['type_de_compte'] = $tdcBDD;

        if ($_SESSION['type_de_compte']== 'evaluateur') {
             header("Location: evaluateur.php");
        }
        elseif ($_SESSION['type_de_compte']== 'administrateur') {
            header("Location: admin.php");
        }
        elseif ($_SESSION['type_de_compte']== 'secretaire') {
            header("Location: secretaire.php");
        }
        else {
            echo 'aucun type de compte';
        }
    }
    else {
        echo 'mauvais mot de passe ou indentifiant';
    }
}
else {
    echo 'aucun identifiant ou mot de passe';
}

?>

        