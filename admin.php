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
       <div class="flex-container">
			<div style="flex-grow:6"><!--Cette boite est 6 fois plus grande que l'autre-->
				<section>
					<?php $reponse_admin = $bdd->query('SELECT id, identifiant, type_de_compte FROM Utilisateur ORDER BY ID ASC LIMIT 0, 10');?>
					<table class="tableau">
						<tr  class="aqua">
							<th>Identifiants</th>
							<th>Type de compte</th>
							<th>Actions</th>
						</tr>
						<?php while ($donnees_utilisateur = $reponse_admin->fetch()) : ?>
						<tr>
							<td>
								<?php 
									echo strip_tags ($donnees_utilisateur['identifiant']);
								?>
							</td>
							<td>
								<?php
									echo strip_tags ($donnees_utilisateur['type_de_compte']);
								?>
							</td>
							<td>
								<a href="modification_compte.php?modifier&id=<?php echo $donnees_utilisateur['id']; ?>">
									<button type="button" name="modification_compte" class="bouton">Modifier</button>
								</a>
								<a href="admin.php?supprimer&id=<?php echo $donnees_utilisateur['id']; ?>">
									<button type="button" name="supprimer_compte" class="bouton">Supprimer</button>
								</a>
							</td>
						</tr>
						<?php endwhile; ?>
					</table>
					<?php $reponse_admin->closeCursor();
					if (isset($_GET['id'])) {
						$id = $_GET['id'];
						$deleteUtilisateur= $bdd->query("DELETE FROM Utilisateur WHERE id=" . $id);
                    	header("Location: admin.php");
					}?>
				</section>
			</div>
<?php include('footer.php')?>