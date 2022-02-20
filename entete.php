<header class="alligneadroite">
	<a href="deconnexion.php"><button type="button" class="bouton">Déconnexion</button></a>
	<span class="blanc"><label><?php 
	if(isset($_SESSION['identifiant']) AND isset($_SESSION['type_de_compte'])) 
	{
		echo strip_tags ($_SESSION['identifiant'] . ' ' . $_SESSION['type_de_compte']); 
	}
	?></label></span>
</header>
