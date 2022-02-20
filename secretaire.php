<?php session_start(); 
include('connexion_bdd.php');?>

    <?php include('head.php')?>

        <?php include('entete.php')?>
        <h1>Espace secrétaire</h1>
        <h2 class="allignemilieu">Classement des élèves</h2>
        <div class="flex-container">
			<div style="flex-grow:6"><!--Cette boite est 6 fois plus grande que l'autre-->
				<section>
				<?php $reponse = $bdd->query('SELECT nom_eleve, prenom_eleve, ine_eleve, total_point, statut_dossier FROM Grille ORDER BY ID DESC LIMIT 0, 10');?>
					
					<table class="tableau">
					
						<tr class="teal">
							<th class="petitecolonne">Place</th>
							<th>INE</th>
							<th>Elèves</th>
							<th>Note</th>
							<th>Statut dossier</th>
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
							<?php endwhile; ?>
					</table>
					<?php $reponse->closeCursor();?>
				</section>
			</div>
<?php include('footer.php')?>