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
        <h2 class="allignemilieu">Enregistrement des élèves</h2>
		<div class="flex-container">
			<div style="flex-grow:6">
				<section>
					<form method="post" action="traitement.php?id=<?php echo $_GET['id'];?>">
					<?php if (isset($_GET['modifier'])){
						$id = $_GET['id'];
						$modificationClassement = $bdd ->query('SELECT*FROM Grille WHERE id='. $id); 
						while ($eleve = $modificationClassement->fetch()) :
					?>
						<fieldset>
							<legend>L'élève</legend>
							<div class="conteneur">
								<div class="marge"> <!--Sépare le le Nom du Pénom-->
									<label for="nom_eleve" class="gras">Nom</label><br>
									<input type="text" id="nom_eleve" name="nom_eleve" value=<?php echo $eleve['nom_eleve'];?> autofocus required>
								</div>
								<div>
									<label for="prenom" class="gras">Prénom</label><br>
									<input type="text" id="prenom_eleve" name="prenom_eleve" value=<?php echo $eleve['prenom_eleve'];?> required><br>
								</div>
							</div>
							<label for="ine" class="gras">N°INE</label><br>
							<input type="text" id="ine_eleve" name="ine_eleve" value=<?php echo $eleve['ine_eleve'];?> required>
						</fieldset>
						<fieldset>
							<legend>Dossier</legend>
							
							<h2>Bac/Etudes</h2>
							<input type="radio" id="pro" name="bac" value="pro" <?php if ($eleve['point_bac'] == 8) {echo "checked";}?>>
							<label for="pro">Pro (lié à l'informatique)</label>
							<input type="radio" id="ses" name="bac" value="ses"<?php if ($eleve['point_bac'] == 12) {echo "checked";}?>>
							<label for="ses">S/ES</label>
							<input type="radio" id="l" name="bac" value="l" <?php if ($eleve['point_bac'] == 9) {echo "checked";}?>>
							<label for="l">L</label>
							<input type="radio" id="stmg" name="bac" value="stmg" <?php if ($eleve['point_bac'] == 10) {echo "checked";}?>>
							<label for="stmg">STMG</label>
							<input type="radio" id="autre" name="bac" value="autre" <?php if ($eleve['point_bac'] == 5) {echo "checked";}?>>
							<label for="autre">Autres</label>
						
							<h2>Travail sérieux</h2>
							<input type="radio" id="ts_oui" name="travail" value="oui" <?php if ($eleve['point_travail_serieux'] == 1) {echo "checked";}?>>
							<label for="ts_oui">Oui</label>
							<input type="radio" id="ts_non" name="travail" value="non"<?php if ($eleve['point_travail_serieux'] == -1) {echo "checked";}?>>
							<label for="ts_non">Non</label>
							
							<h2>Absence</h2>
							<input type="radio" id="abs_oui" name="absence" value='oui'<?php if ($eleve['point_absence'] == -2) {echo "checked";}?>>
							<label for="abs_oui">Oui</label>
							<input type="radio" id="abs_non" name="absence" value='non' <?php if ($eleve['point_absence'] == 1) {echo "checked";}?>>
							<label for="abs_non">Non</label>
					
							<h2>Attitue/Comportement</h2>
							<input type="radio" id="att_oui" name="attitude" value='oui'<?php if ($eleve['point_attitude'] == 0) {echo "checked";}?>>
							<label for="att_oui">Oui</label>
							<input type="radio" id="att_non" name="attitude" value='non'<?php if ($eleve['point_attitude'] == 1) {echo "checked";}?>>
							<label for="att_non">Non</label>

							<h2>Etudes supérieures</h2>
							<input type="radio" id="att_oui" name="etude_superieure" value='oui'<?php if ($eleve['point_etude_superieure'] == 1) {echo "checked";}?>>
							<label for="att_oui">Oui</label>
							<input type="radio" id="att_non" name="etude_superieure" value='non' <?php if ($eleve['point_etude_superieure'] == 0) {echo "checked";}?>>
							<label for="att_non">Non</label>
							
							<h2>Avis PP</h2>
							<input type="radio" id="pp_b" name="avis_pp" value='b'<?php if ($eleve['point_avis_pp'] == 2) {echo "checked";}?>>
							<label for="pp_b">Oui</label>
							<input type="radio" id="pp_ab" name="avis_pp" value='ab'<?php if ($eleve['point_avis_pp'] == 1) {echo "checked";}?>>
							<label for="pp_ab">AB</label>
							<input type="radio" id="pp_insuf" name="avis_pp" value ='insuf' <?php if ($eleve['point_avis_pp'] == -1) {echo "checked";}?>>
							<label for="pp_insuf">Insuffisant</label>
							<input type="radio" id="pp_neg" name="avis_pp" value ='negatif'<?php if ($eleve['point_avis_pp'] == -2) {echo "checked";}?>>
							<label for="pp_neg">Négatif</label>
							
							<h2>Avis Proviseur</h2>
							<input type="radio" id="pr_b" name="avis_proviseur" value='b'<?php if ($eleve['point_avis_proviseur'] == 2) {echo "checked";}?>>
							<label for="pr_b">Oui</label>
							<input type="radio" id="pr_ab" name="avis_proviseur" value='ab'<?php if ($eleve['point_avis_proviseur'] == 1) {echo "checked";}?>>
							<label for="pr_ab">AB</label>
							<input type="radio" id="pr_insuf" name="avis_proviseur" value ='insuf' <?php if ($eleve['point_avis_proviseur'] == -1) {echo "checked";}?>>
							<label for="pr_insuf">Insuffisant</label>
							<input type="radio" id="pr_neg" name="avis_proviseur" value ='negatif' <?php if ($eleve['point_avis_proviseur'] == -2) {echo "checked";}?>>
							<label for="pr_neg">Négatif</label>
						
							<h2>Lettre de motivation</h2>
							<input type="radio" id="lm_b" name="lettre" value='b' <?php if ($eleve['point_lettre_motivation'] == 2) {echo "checked";}?>>
							<label for="lm_b">Oui</label>
							<input type="radio" id="lm_ab" name="lettre" value='ab' <?php if ($eleve['point_lettre_motivation'] == 1) {echo "checked";}?>>
							<label for="lm_ab">AB</label>
							<input type="radio" id="lm_insuf" name="lettre" value ='insuf'<?php if ($eleve['point_lettre_motivation'] == -1) {echo "checked";}?>>
							<label for="lm_insuf">Insuffisant</label>
							<input type="radio" id="lm_neg" name="lettre" value ='negatif' <?php if ($eleve['point_lettre_motivation'] == -2) {echo "checked";}?>>
							<label for="lm_neg">Négatif</label><br>
							<h3>Remarques</h3>
							<textarea id="remarque" name="remarque" class="case"><?php echo $eleve['remarque'];?></textarea>
						</fieldset>
						<h3>Statut du dossier</h3>
							<input type="radio" id="statut_accepte" name="statut_dossier" value='accepté' <?php if ($eleve['statut_dossier'] == "accepte") {echo "checked";}?>>
							<label for="statut_accepte">Accepté</label>
							<input type="radio" id="statut_examination" name="statut_dossier" value='re_examination' <?php if ($eleve['statut_dossier'] == "re_examination") {echo "checked";}?>>
							<label for="statut_examination">A ré_examiner</label>
							<input type="radio" id="statut_refuse" name="statut_dossier" value ='refusé' <?php if ($eleve['statut_dossier'] == "refuse") {echo "checked";}?>>
							<label for="statut_refuse">Refusé</label>
						<div class="alligneadroite">
							<input type="reset" value="Effacer" class="bouton">
							<input type="submit" value="Enregistrer" class="bouton">
						</div>
						<?php endwhile;} ?>
					</form>
				</section>
			</div>
			<div style="flex-grow:1">
			</div>
		</div>
<?php include('footer.php')?>