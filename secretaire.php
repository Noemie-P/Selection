<?php session_start(); 
include('connexion_bdd.php');?>

    <?php include('head.php')?>

        <?php include('entete.php')?>
        <h1>Espace secrétaire</h1>
        <h2 class="allignemilieu">Classement des élèves</h2>
        <div class="flex-container">
			<div style="flex-grow:6"><!--Cette boite est 6 fois plus grande que l'autre-->
				<section>
				<label class="allignemilieu" for="tableBac">Tableau suivant les bacs</label></br>
					<select class="allignemilieu" name="tableBac" id="tableBac" onchange="getTable();">
						<option value="entier">Tableau entier</option>
						<option value="pro">Bac pro</option>
						<option value="reste">Autres bacs</option>
					</select></br>
				<?php $reponseTotal = $bdd->query('SELECT nom_eleve, prenom_eleve, ine_eleve, total_point, statut_dossier FROM Grille ORDER BY total_point DESC LIMIT 0, 10');?>
					
					<table class="tableau" id="entier">
					
						<tr class="teal">
							<th class="petitecolonne">Place</th>
							<th>INE</th>
							<th>Elèves</th>
							<th>Note</th>
							<th>Statut dossier</th>
						</tr>
						<?php $i = 1;
						while ($donnees_Total = $reponseTotal->fetch()) : ?>
						<tr>
							<td><?php echo $i; ?></td><!--Dans ces cases viendront les valeurs définies par le language PHP-->
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
							<?php $i++; endwhile; ?>
					</table>
					<br>
					<form method="post" action="csvTelecharger.php" id="CsvEntier">
						<input type="submit" name="telechargerEntier" value="Télécharger tableau entier"/>
					</form>
					<?php $reponseTotal->closeCursor();?>

					<?php $reponsePro = $bdd->query('SELECT nom_eleve, prenom_eleve, ine_eleve, total_point, statut_dossier FROM Grille WHERE point_bac = 8 ORDER BY total_point DESC LIMIT 0, 10');?>
					
					<table class="tableau" id="pro" hidden>
					
						<tr class="teal">
							<th class="petitecolonne">Place</th>
							<th>INE</th>
							<th>Elèves</th>
							<th>Note</th>
							<th>Statut dossier</th>
						</tr>
						<?php $j=1;
						while ($donnees_Pro = $reponsePro->fetch()) : ?>
						<tr>
							<td><?php echo $j; ?></td><!--Dans ces cases viendront les valeurs définies par le language PHP-->
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
							<?php $j++; endwhile; ?>
					</table>
					<br>
					<form method="post" action="csvTelecharger.php" id="CsvPro" hidden>
						<input type="submit" name="telechargerPro" value="Télécharger tableau bacs pros"/>
					</form>
					<?php $reponsePro->closeCursor();?>

					<?php $reponseReste = $bdd->query('SELECT nom_eleve, prenom_eleve, ine_eleve, total_point, statut_dossier FROM Grille WHERE point_bac != 8 ORDER BY total_point DESC LIMIT 0, 10');?>
					
					<table class="tableau" id="reste" hidden>
					
						<tr class="teal">
							<th class="petitecolonne">Place</th>
							<th>INE</th>
							<th>Elèves</th>
							<th>Note</th>
							<th>Statut dossier</th>
						</tr>
						<?php $k=1;
						while ($donnees_Reste = $reponseReste->fetch()) : ?>
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
							<?php $k++; endwhile; ?>
					</table>
					<br>
					<form method="post" action="csvTelecharger.php" id="CsvReste" hidden>
						<input type="submit" name="telechargerReste" value="Télécharger tableau bacs non professtionnels"/>
					</form>
					<?php $reponseReste->closeCursor();?>
				</section>
			</div>
<?php include('footer.php')?>