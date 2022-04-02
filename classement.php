<?php session_start(); 

include("connexion_bdd.php");
?>
    
	<!doctype html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>enregistrement-Selection SIO</title>
        <link rel="stylesheet" href="projet.css">
    </head>
	<body onload="resetForm();">
		<?php include("entete.php"); ?>
		<h1>Espace Evaluateur</h1>
		<div class="allignemilieu">
			<p>Que souhaitez-vous faire?<p>
			<a href="enregistrement.php"><button type="button" name="enregistrer" class="bouton">Enregistrer un élève</button></a>
			<a href="classement.php"><button type="button" name="voir_classement" class="bouton">Voir le classement</button></a>
			<a href="statistiques.php"><button type="button" name="voir_statistiques" class="bouton">Voir les statistiques</button></a>
		</div>
		<br>
		<h2 class="allignemilieu">Classement des élèves</h1>
		<div class="flex-container">
			<div style="flex-grow:6"><!--Cette boite est 6 fois plus grande que l'autre-->
				<section>
					<label class="allignemilieu" for="tableBac">Tableau suivant les bacs</label></br>
					<select class="allignemilieu" name="tableBac" id="tableBac" onchange="getTable();">
						<option value="entier">Tableau entier</option>
						<option value="pro">Bac pro</option>
						<option value="reste">Autres bacs</option>
					</select></br>
					<?php $reponseTotal = $bdd->query('SELECT ID,nom_eleve, prenom_eleve, ine_eleve, total_point, statut_dossier FROM Grille ORDER BY total_point DESC LIMIT 0, 10');?>
				
					<table class="tableau" id="entier">
					
						<tr class="teal">
							<th class="petitecolonne">Place</th>
							<th>INE</th>
							<th>Elèves</th>
							<th>Note</th>
							<th>Statut dossier</th>
							<th>Actions</th>
						</tr>
						<?php $i = 1;
						while ($donnees_Total = $reponseTotal->fetch()) : 
						?>
						<tr>
							<td><?php echo $i;?></td><!--Dans ces cases viendront les valeurs définies par le language PHP-->
							<td>
								<?php 
									echo strip_tags ($donnees_Total['ine_eleve']);
								?>
							</td>
							<td>
								<?php
									echo strip_tags ($donnees_Total['nom_eleve'] . ' ' . $donnees_Total['prenom_eleve']);
								?>
							</td>
							<td>
								<?php
									echo strip_tags ($donnees_Total['total_point']);
								?>
							</td>
							<td>
								<?php 
									echo strip_tags ($donnees_Total['statut_dossier']);
								?>
							</td>
							<td>
								<a href="modification.php?modifier&id=<?php echo $donnees_Total['ID']; ?>"><button type="button" name="modification_classement" class="bouton">Modifier</button></a>
								<a href="classement.php?supprimer&id=<?php echo $donnees_Total['ID']; ?>"><button type="button" name="supprimer_classement" class="bouton">Supprimer</button></a>
							</td>
							<?php $i++;?>
						</tr>
							<?php  
							endwhile;?>
						</table>
							<?php $reponseTotal->closeCursor();?>
							<?php $reponsePro = $bdd->query('SELECT ID,nom_eleve, prenom_eleve, ine_eleve, total_point, statut_dossier FROM Grille WHERE point_bac = 8 ORDER BY total_point  DESC LIMIT 0, 10');?>
							
						<table class="tableau" id="pro" hidden>
					
							<tr class="teal">
								<th class="petitecolonne">Place</th>
								<th>INE</th>
								<th>Elèves</th>
								<th>Note</th>
								<th>Statut dossier</th>
								<th>Actions</th>
							</tr>
							
							<?php $j=1; while ($donnees_Pro = $reponsePro->fetch()) : ?>
							<tr>
								<td><?php echo $j;?></td><!--Dans ces cases viendront les valeurs définies par le language PHP-->
								<td>
									<?php 
										echo strip_tags ($donnees_Pro['ine_eleve']);
									?>
								</td>
								<td>
									<?php
										echo strip_tags ($donnees_Pro['nom_eleve'] . ' ' . $donnees_Pro['prenom_eleve']);
									?>
								</td>
								<td>
									<?php
										echo strip_tags ($donnees_Pro['total_point']);
									?>
								</td>
								<td>
									<?php 
										echo strip_tags ($donnees_Pro['statut_dossier']);
									?>
								</td>
								<td>
									<a href="modification.php?modifier&id=<?php echo $donnees_Pro['ID']; ?>"><button type="button" name="modification_classement" class="bouton">Modifier</button></a>
									<a href="classement.php?supprimer&id=<?php echo $donnees_Pro['ID']; ?>"><button type="button" name="supprimer_classement" class="bouton">Supprimer</button></a>
								</td>
							</tr>
						<?php $j++; endwhile; ?>
							</table>
						<?php $reponsePro->closeCursor();?>
						<?php $reponseReste = $bdd->query('SELECT ID,nom_eleve, prenom_eleve, ine_eleve, total_point, statut_dossier FROM Grille WHERE point_bac != 8 ORDER BY total_point DESC LIMIT 0, 10');?>
						
						<table class="tableau" id="reste" hidden>
					
							<tr class="teal">
								<th class="petitecolonne">Place</th>
								<th>INE</th>
								<th>Elèves</th>
								<th>Note</th>
								<th>Statut dossier</th>
								<th>Actions</th>
							</tr>
						
						<?php $k=1; while ($donnees_Reste = $reponseReste->fetch()) : ?>
						<tr>
							<td><?php echo $k; ?></td><!--Dans ces cases viendront les valeurs définies par le language PHP-->
							<td>
								<?php 
									echo strip_tags ($donnees_Reste['ine_eleve']);
								?>
							</td>
							<td>
								<?php
									echo strip_tags ($donnees_Reste['nom_eleve'] . ' ' . $donnees_Reste['prenom_eleve']);
								?>
							</td>
							<td>
								<?php
									echo strip_tags ($donnees_Reste['total_point']);
								?>
							</td>
							<td>
								<?php 
									echo strip_tags ($donnees_Reste['statut_dossier']);
								?>
							</td>
							<td>
								<a href="modification.php?modifier&id=<?php echo $donnees_Reste['ID']; ?>"><button type="button" name="modification_classement" class="bouton">Modifier</button></a>
								<a href="classement.php?supprimer&id=<?php echo $donnees_Reste['ID']; ?>"><button type="button" name="supprimer_classement" class="bouton">Supprimer</button></a>
							</td>
						</tr>
						<?php $k++; endwhile; ?>
					</table>
					<?php $reponseReste->closeCursor();?>
					<?php if (isset($_GET['id'])) {
						$id = $_GET['id'];
						$deleteEleve= $bdd->query("DELETE FROM Grille WHERE id=" . $id);
                    	header("Location: classement.php");
					}?>
				</section>
			</div>
		</div>
<?php include('footer.php')?>