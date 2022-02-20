<?php session_start();
include('connexion_bdd.php');
include('head.php');
include('entete.php');?>
       <h1>Espace Administrateur</h1>
	   <div class="allignemilieu">
			<p> Que souhaitez-vous faire?<p>
			<a href="admin.php"><button type="button" name="voir_compte" class="bouton">Voir les comptes</button</a>
			<a href="admin_enregistrement.php"><button type="button" name="enregistrer_compte" class="bouton">Enregistrer un compte</button></a>
		</div>
        <h2>Création de compte</h2>
        <form method="post" action="admin_enregistrement.php">
            <label for="new_identifiant" class="gras">Identifiant</label></br>
            <input type="text" id="new_identifiant" name="new_identifiant" required></br>
            <label for="new_mdp" class="gras">Mot de passe</label></br>
            <input type="password" id="new_mdp" name="new_mdp" required></br>

            <label for="new_type_de_compte">Type de compte</label></br>
            <label for="administrateur">Administrateur</label>
            <input type="radio" id="administrateur" name="new_type_de_compte" value="administrateur">
            <label for="evaluateur">Evaluateur</label>
            <input type="radio" id="evaluateur" name="new_type_de_compte" value="evaluateur">
            <label for="secretaire">Secretaire</label>
            <input type="radio" id="secretaire" name="new_type_de_compte" value="secretaire"></br>
                <input type="submit" value="Enregistrer" class="bouton">
        </form>
<?php
if (isset($_POST['new_identifiant']) AND isset($_POST['new_mdp']) AND isset($_POST['new_type_de_compte'])) {
$new_login =$_POST['new_identifiant'];
$new_password = $_POST['new_mdp'];
$new_type_de_compte = $_POST['new_type_de_compte'];
$req_utilisateur = $bdd->prepare('INSERT INTO Utilisateur(identifiant, mdp, type_de_compte)
 VALUES (:identifiant, :mdp, :type_de_compte)');
$req_utilisateur->execute(array(
    'identifiant' =>$new_login,
    'mdp'=> $new_password,
    'type_de_compte'=> $new_type_de_compte,
));
$req_utilisateur ->closeCursor();
};
include('footer.php');?>