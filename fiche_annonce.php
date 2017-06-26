<?php
require_once("inc/init.inc.php");


if(isset($_GET['id_annonce']))
{
	$resultat = $pdo->query("SELECT * FROM annonce WHERE id_annonce = '$_GET[id_annonce]'");

	if($resultat->rowCount() <= 0)
	{
		header("location:accueil.php");
		exit();
	}
}

$content .= '<ul>';
while ($annonce = $resultat->fetch(PDO::FETCH_ASSOC)){
	$req_membre = $pdo->query("SELECT prenom FROM membre WHERE id_membre = '$annonce[id_membre]'");
	while($membre = $req_membre->fetch(PDO::FETCH_ASSOC)){
		// debug($membre);
		$content .= "<h3>$annonce[titre]</h3>";
		$content .= "<li><img src=".$annonce['photo']." width=\"130\" height=\"100\"></li>";
		$content .= "<li>Description : ".$annonce['description_longue']."</li>";
		$content .= "<li><span class='glyphicon glyphicon-calendar'></span> Date de publication : ".$annonce['date_enregistrement']."</li>";
		$content .= "<li><span class='glyphicon glyphicon-user'></span> ".$membre['prenom']."</li>";
		$content .= "<li><span class='glyphicon glyphicon-euro'></span> ".$annonce['prix']." €</li>";
		$content .= "<li><span class='glyphicon glyphicon-map-marker'></span> Adresse : ".$annonce['adresse']." ".$annonce['cp'] ." ".$annonce['ville']."</li>";
		/*$content .= "<iframe
		  width='450'
		  height='250'
		  frameborder='0' style='border:0'
		  src=\"https://www.google.com/maps/embed/v1/search?key=YOUR_API_KEY&q="echo $annonce['adresse']; echo $annonce['ville'] ;\" allowfullscreen>
		</iframe>";*/
		$content .= "<li><h4>Autres Annonces</h4></li>";
		$content .= "<li><ul>";
		$thumb_req = $pdo->query("SELECT photo FROM annonce WHERE id_categorie = $annonce[id_categorie] LIMIT 4");
		while($thumb = $thumb_req->fetch(PDO::FETCH_ASSOC)){
			for($i=0; $i < count($thumb); $i++)
			{
			foreach($thumb as $index => $value)
				$content .= "<li>".$value."</li>";
			}
		};
		// debug($thumb);
		
		$content .= "</ul></li>";
		$content .= "<li><a href='?action=comment'>Déposer un commentaire ou une note</a><a class='right' href='annonces.php'>Retour vers les annonces</a></li>";
		$content .= "</ul>";
	};
};





require_once("inc/haut.inc.php");

echo $content;

require_once("inc/bas.inc.php");
?>