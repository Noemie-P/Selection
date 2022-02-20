<?php session_start();?>    

<?php include("head.php"); ?>

		<h1>Sélection</h1>
		<div class="identifiant">
			<form action="identification.php" method="post">
				<label for="loginID">Identifiant</label><br>
				<input type="text" id="loginID" name="loginID" required><br>
				<label for="password">Mot de passe</label><br>
				<input type="password" id="password" name="password" required><br>
				<br>
				<input type="submit"  class="bouton" value="Entrer">
			</form>
		</div>
<?php include("footer.php"); ?>
