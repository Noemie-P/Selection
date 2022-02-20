<?php session_start();
include('head.php');
include('entete.php');?>
<h1>Espace Evaluateur</h1>
<div class="allignemilieu">
    <p> Que souhaitez-vous faire?<p>
    <a href="enregistrement.php"><button type="button" name="enregistrer" class="bouton">Enregistrer un élève</button</a>
    <a href="classement.php"><button type="button" name="voir_classement" class="bouton">Voir le classement</button></a>
</div>
<?php include("footer.php");?>
