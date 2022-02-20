<?php session_start(); 

include("connexion_bdd.php");
?>
    
    <?php include("head.php"); ?>
	
		<?php include("entete.php"); ?>
		<h1>Espace Evaluateur</h1>
		<div class="allignemilieu">
			<p>Que souhaitez-vous faire?<p>
			<a href="enregistrement.php"><button type="button" name="enregistrer" class="bouton">Enregistrer un élève</button></a>
			<a href="classement.php"><button type="button" name="voir_classement" class="bouton">Voir le classement</button></a>
		</div>
		<br>
		<h2 class="allignemilieu">Classement des élèves</h1>
		<div class="flex-container">
			<div style="flex-grow:6"><!--Cette boite est 6 fois plus grande que l'autre-->
				<section>
					<?php $reponse = $bdd->query('SELECT ID,nom_eleve, prenom_eleve, ine_eleve, total_point, statut_dossier FROM Grille ORDER BY note DESC LIMIT 0, 10');?>
					
					<table class="tableau">
					
						<tr class="teal">
							<th class="petitecolonne">Place</th>
							<th>INE</th>
							<th>Elèves</th>
							<th>Note</th>
							<th>Statut dossier</th>
							<th>Actions</th>
						</tr>
						<?php while ($donnees_grille = $reponse->fetch()) : ?>
						<tr>
							<td></td><!--Dans ces cases viendront les valeurs définies par le language PHP-->
							<td>
								<?php 
									echo strip_tags ($donnees_grille['ine_eleve']);
								?>
							</td>
							<td>
								<?php
									echo strip_tags ($donnees_grille['nom_eleve'] . ' ' . $donnees_grille['prenom_eleve']);
								?>
							</td>
							<td>
								<?php
									echo strip_tags ($donnees_grille['total_point']);
								?>
							</td>
							<td>
								<?php 
									echo strip_tags ($donnees_grille['statut_dossier']);
								?>
							</td>
							<td>
								<a href="modification.php?modifier&id=<?php echo $donnees_grille['ID']; ?>"><button type="button" name="modification_classement" class="bouton">Modifier</button></a>
								<a href="classement.php?supprimer&id=<?php echo $donnees_grille['ID']; ?>"><button type="button" name="supprimer_classement" class="bouton">Supprimer</button></a>
							</td>
						</tr>
							<?php endwhile; ?>
					</table>
					<?php $reponse->closeCursor();
					if (isset($_GET['id'])) {
						$id = $_GET['id'];
						$deleteEleve= $bdd->query("DELETE FROM Grille WHERE id=" . $id);
                    	header("Location: classement.php");
					}?>
				</section>
			</div>
		</div>
<?php include('footer.php')?>