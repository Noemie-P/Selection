<?php session_start();
include('head.php');?>
<div class="allignemilieu">
    <h1>Vous vous êtes déconnecté avec succès!</h1>
    <a href="index.php"><button type="button" class="bouton">Se reconnecter</button></a>
</div>
<?php include('footer.php');
session_destroy();?>
