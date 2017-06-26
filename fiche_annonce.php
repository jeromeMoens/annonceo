<?php
require_once("../inc/init.inc.php");


if(isset($_GET['id_annonce']))
{
	$resultat = $pdo->query("SELECT * FROM annonce WHERE id_annonce = '$_GET[id_annonce]'");
}
if($resultat->rowCount() <= 0)
{
	header("location:annonce.php");
	exit();
}

$content .= '<ul>';
$annonce = $resultat->fetch(PDO::FETCH_ASSOC);
$membre = $pdo->query("SELECT prenom FROM membre WHERE id_membre = '$annonce[id_membre]'");
$content .= "<h3>$annonce[titre]</h3>";
$content .= "<li><img src=".$annonce['photo']." width=\"130\" height=\"100\"></li>";
$content .= "<li>Description : ".$annonce['description_longue']."</li>";
$content .= "<li><span class='glyphicon glyphicon-calendar'></span> Date de publication : ".$annonce['date_enregistrement']."</li>";
$content .= "<li><span class='glyphicon glyphicon-user'></span> ".$membre."</li>";
$content .= "<li><span class='glyphicon glyphicon-euro'></span> ".$annonce['prix']." €</li>";
$content .= "<li><span class='glyphicon glyphicon-map-marker'></span> Adresse : ".$annonce['adresse']." ".$annonce['cp'] ." ".$annonce['ville']."</li>";
/*$content .= "<iframe
  width='450'
  height='250'
  frameborder='0' style='border:0'
  src=\"https://www.google.com/maps/embed/v1/search?key=YOUR_API_KEY&q="echo $annonce['adresse']; echo $annonce['ville'] ;\" allowfullscreen>
</iframe>";*/
$content .= "<li><h4>Autres Annonces</h4></li>";
$thumb = $pdo->query("SELECT photo FROM annonce WHERE id_categorie = $annonce[id_categorie] LIMIT 4");
debug($thumb);
$content .= "<li><ul><li>$thumb</li>";
$content .= "<li>$thumb</li>";
$content .= "<li>$thumb</li>";
$content .= "<li>$thumb</li></ul></li>";
$content .= "<li><a href='?action=comment'>Déposer un commentaire ou une note</a><a class='right' href='annonces.php'>Retour vers les annonces</a></li>";
$content .= "</ul>";



require_once("../inc/haut.inc.php");

echo $content;

require_once("../inc/bas.inc.php");
?>