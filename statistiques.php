<?php session_start();
include('connexion_bdd.php');?>
<!doctype html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>enregistrement-Selection SIO</title>
        <link rel="stylesheet" href="projet.css">
        <script src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.js'></script>
        
    </head>
    <body onload="resetStats();">
<?php include('entete.php');?>

<h1>Espace Evaluateur</h1>
<div class="allignemilieu">
    <p>Que souhaitez-vous faire?<p>
    <a href="enregistrement.php"><button type="button" name="enregistrer" class="bouton">Enregistrer un élève</button></a>
    <a href="classement.php"><button type="button" name="voir_classement" class="bouton">Voir le classement</button></a>
    <a href="statistiques.php"><button type="button" name="voir_statistiques" class="bouton">Voir les statistiques</button></a>
</div>

<?php $reponseTotal = $bdd->query('SELECT COUNT(id) AS NumberOfStudents FROM Grille WHERE statut_dossier = "accepte";');
while ($donnees_Total = $reponseTotal->fetch()) {
    $total = $donnees_Total['NumberOfStudents'];
}
$reponsePro = $bdd->query('SELECT COUNT(id) AS NumberOfPro FROM Grille WHERE point_bac = 8 AND statut_dossier = "accepte";');
while ($donnees_Pro = $reponsePro->fetch()) {
    $pro = $donnees_Pro['NumberOfPro'];
}
$reste = $total - $pro;
if ($pro !=0) {
  $pourcentage = $pro *100/$total;
}
else {
  $pourcentage = 0;
}
$month = (int) date("m");
if ($month >= "09") {
    $annee = date("Y") .'-' .date("Y") +1;
}
else {
  $annee = date("Y")-1 .'-'.date("Y");
}
?>
<div class="allignemilieu">
<?php $reponseStats = $bdd->query('SELECT * FROM Statistiques');?>
  <select name="annee" id="year" onchange="getStats();">
    <option value="en cours">En cours</option>
    <?php while($donnees_stats = $reponseStats->fetch()){
      echo "<option value='".$donnees_stats["annee"]."'>".$donnees_stats["annee"]."</option>";
    }
    ?>
  </select>
</div> 
<div class="allign-center">
  <h1 id="title"><?php echo $annee; ?></h1>
  <div>
    <label class="<?php if($pourcentage >=30) {echo "green";} else {echo "red";}?>" id="sentence">
        Le pourcentage de bac pro acceptés est de :<?php echo number_format($pourcentage, 2, ',', ' ');?>%
    </label>
  </div>
<hr>
<div>
<canvas id="stats" width="480" height="320" class="canvas"></canvas>
</div>
<form method="post" action="archiver.php">
<input type="hidden" value="<?php echo $pro?>" name ="pro" id="pro"/>
<input type="hidden" value="<?php echo $reste?>" name ="reste"  id="reste"/>
<input type="hidden" value="<?php echo $total?>" name ="total"  id="total"/>
<input type="hidden" value="<?php echo $annee?>" name ="annee"  id="annee"/>
<label>Supprimer le classement et archiver les statistiques ?</label>
<input type="submit" name="archiver" class="bouton" value="Archiver" />
</form>
</div>

<script>
   
function pie(ctx, w, h, datalist, namelist)
{
    var radius = h / 2 - 5;
  var centerx = w / 2;
  var centery = h / 2;
  var lastend = 0;

  var offset = Math.PI / 2;
  var labelxy = new Array();

  var fontSize = Math.floor(canvas.height / 30);
  ctx.textAlign = 'center';
  ctx.font = fontSize + "px Arial";
  var total = 0;
  for(x=0; x < datalist.length; x++) { total += datalist[x]; };

  for(x=0; x < datalist.length; x++)
  {
    var thispart = datalist[x]; 
    ctx.beginPath();
    ctx.fillStyle = colist[x];
    ctx.moveTo(centerx,centery);
    var arcsector = Math.PI * (2 * thispart / total);
    ctx.arc(centerx, centery, radius, lastend - offset, lastend + arcsector - offset, false);
    ctx.lineTo(centerx, centery);
    ctx.fill();
    ctx.closePath();		
    if(thispart > (total / 20))
       labelxy.push(lastend + arcsector / 2 + Math.PI + offset);
    lastend += arcsector;	
  }
  
  var lradius = radius * 3 / 4; 
  ctx.strokeStyle = "rgb(0,0,0)";
  ctx.fillStyle = "rgb(0,0,0)";
  for(i=0; i < labelxy.length; i++)
  {	  
    var langle = labelxy[i];
    var dx = centerx + lradius * Math.cos(langle);
    var dy = centery + lradius * Math.sin(langle);
    if (datalist[i] != 0)	{
        ctx.fillText(namelist[i], dx, dy);
    }
    else {
        ctx.fillText(namelist[i+1], dx, dy);
    }	
  }	
}
var pro = parseInt(document.getElementById("pro").value); 
var reste = parseInt(document.getElementById("reste").value); 
var datalist= new Array(pro, reste); 
var namelist = new Array("bacs pros", "autres"); 
var colist = new Array('#008080', '#7fffd4');
var canvas = document.getElementById("stats"); 
var ctx = canvas.getContext('2d');
pie(ctx, canvas.width, canvas.height, datalist, namelist); 

function getStats() {
  var annee = document.getElementById("year").value;
  if  (annee == "en cours") {
    window.location.reload(true);
  }
  else {
    $.ajax({
        url : 'serv.php?annee='+annee, // my php file
        type : 'GET', // type of the HTTP request
        success : function(result){ 
            var obj = jQuery.parseJSON(result);
            console.log(result);
            var total = obj[0][1];
            var pro = obj[0][2];
            var reste = obj[0][3];
            var pourcentage = pro * 100 / total;
            console.log(pourcentage);
            console.log(pro);
            console.log(total);
            var classe = "";
            if (pourcentage >=30) {
              classe = "green";
            }
            else {
              classe = "red";
            }
            document.getElementById("title").innerHTML = annee ;
            document.getElementById("sentence").innerHTML = "<label class='" + classe + 
              "'> Le pourcentage de bac pro acceptés est de :" + 
              pourcentage.toLocaleString('fr-FR', {maximumFractionDigits: 2} ) + "%</label>";
            var datalist= new Array(parseInt(pro), parseInt(reste)); 
            var namelist = new Array("bacs pros", "autres"); 
            var colist = new Array('#008080', '#7fffd4');
            var canvas = document.getElementById("stats"); 
            var ctx = canvas.getContext('2d');
            pie(ctx, canvas.width, canvas.height, datalist, namelist); 
        }
    });
  }
}
</script>

<?php include('footer.php');?>