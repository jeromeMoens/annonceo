<?php
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");

if(!internauteESTConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit(); // interrompt le script
}

//--------------------SUPPRESSION COMMENTAIRES
if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	//Executez une requête de supression
	$pdo->query("DELETE FROM commentaire WHERE id_commentaire = '$_GET[id_commentaire]'");
	$content .= "<div class ='validation'>le commentaire n° " . $_GET['id_commentaire'] . " a été supprimé. </div>";
	$_GET['action'] = 'affichage';
	
}


//--------------------ENREGISTREMENT COMMENTAIRES
if(!empty($_POST))
{

	foreach($_POST as $indice => $valeurs) 
		{
			$_POST[$indice] = addslashes($valeurs);
			$_POST[$indice] = strip_tags($valeurs);
			$_POST[$indice] = htmlentities($valeurs);
			$_POST[$indice] = htmlspecialchars($valeurs);
		}


	if(!date($_POST['date_enregistrement']))
		{
			$content .= '<div class"danger">Le format de la date d\'enregistrement est incorrecte, veuillez recommencer</div>';
		}

	if(empty($content))
		{
			$content .= '<div class"danger">Veuillez renseigner un commentaire</div>';
		}				

	if(!empty($content))
		{
			$content .= '<div class"success">Le produit a été enregistré avec succès !</div>';
		}		
}



//--------------------MODIFICATION COMMENTAIRES

if(isset($_POST))
{

	if(isset($_GET['action']) && $_GET['action'] == 'modification')
	{

		foreach($_POST as $indice => $valeurs) 
		{
		$req_insert_commentaire = "REPLACE INTO commentaire(id_commentaire,id_membre,id_annonce,commentaire, date_enregistrement)VALUES(:id_commentaire, :id_membre, :id_annonce, :commentaire, :date_enregistrement)";

		$req_commentaire = $pdo->prepare($req_insert_commentaire);
		$req_commentaire->bindValue(':id_commentaire', $_POST['id_commentaire'], PDO::PARAM_INT);
		$req_commentaire->bindValue(':id_membre', $_POST['id_membre'], PDO::PARAM_INT);
		$req_commentaire->bindValue(':id_annonce', $_POST['id_annonce'], PDO::PARAM_INT);
		$req_commentaire->bindValue(':commentaire', $_POST['commentaire'], PDO::PARAM_STR);
		$req_commentaire->bindValue(':date_enregistrement', $_POST['date_enregistrement'], PDO::PARAM_INT);

		$req_commentaire->execute();
		}
	}	
}


//-----LIENS COMMENTAIRES-----//
$content .= '<a style= "text-decoration: underline"; href="?action=affichage";>Affichage des commentaires</a><br>';
$content .= '<a style= "text-decoration: underline"; href="?action=ajout">Ajout de commentaires</a><br>';



//-----AFFICHAGE COMMENTAIRES-----//
// Affichage sous forme de tableau HTML de l'ensemble de la table commentaire

if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{

$r = $pdo->query("SELECT * FROM commentaire");
$content .= "<h1>Affichage des " . $r->rowCount() . " commentaire(s)</h1>";
$content .= "<table border='1'><tr>";

for($i = 0; $i < $r->columnCount(); $i++)
{
	$colonne = $r->getColumnMeta($i);
	$content .= "<th>$colonne[name]</th>";
}
$content.= "<th>Voir</th>";
$content.= "<th>Modification</th>";
$content.= "<th>Suppression</th>";
$content .= "</tr>";


while($ligne = $r->fetch(PDO::FETCH_ASSOC))
{
	$content .= '<tr>';
	foreach($ligne as $indice => $valeur)
	{
			$content .= "<td>$valeur</td>";
	}
	$content .= "<td><a href=\"?action=voir&id_commentaire=$ligne[id_commentaire]\"><img src='../inc/img/loupe.png'></a></td>";

	$content .= "<td><a href=\"?action=modification&id_commentaire=$ligne[id_commentaire]\"><img src='../inc/img/edit.png'></a></td>";

	$content .= "<td><a href=\"?action=suppression&id_commentaire=$ligne[id_commentaire]\" OnClick=\"return(confirm('En êtes vous certain ?'))\";><img src='../inc/img/delete.png'></a></td>";

	$content .= "</tr>";
}

$content .= "</table>";
}

echo $content;



?>

<!DOCTYPE html>
<head>
<meta charset="UTF-8">
	<title>Formulaire commentaires</title>
	<link rel="stylesheet" href="../inc/css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
		
</html>

<?php



if(isset($_GET['action']) && $_GET['action'] == 'voir' ||isset($_GET['action']) && $_GET['action'] == 'ajout' ||isset($_GET['action']) && $_GET['action'] == 'modification')
{
	if (isset($_GET['id_commentaire']))
	{
		$resultat = $pdo->query("SELECT * FROM commentaire WHERE id_commentaire=$_GET[id_commentaire]"); // on récupère les informations sur le commentaire à modifier
		$commentaire_actuel = $resultat->fetch(PDO::FETCH_ASSOC); // on rend les informations exploitables afin de les présaisir dans les cases du formulaire
		debug($commentaire_actuel);
	}	

	$id_commentaire = (isset($commentaire_actuel['id_commentaire'])) ? $commentaire_actuel['id_commentaire'] : '';
	$id_membre = (isset($commentaire_actuel['id_membre'])) ? $commentaire_actuel['id_membre'] : '';
	$id_annonce = (isset($commentaire_actuel['id_annonce'])) ? $commentaire_actuel['id_annonce'] : '';
	$date_enregistrement = (isset($commentaire_actuel['date_enregistrement'])) ? $commentaire_actuel['date_enregistrement'] : '';


?>

<h1>Formulaire commentaire<h1>
	<form method="POST" action="#" enctype="multipart/form-data">

		  <div class="form-group">

		    <input type="hidden" class="form-control" id="id_commentaire" name="id_commentaire" value="<?php echo $id_commentaire; ?>">
		  </div>

		  <div class="form-group">		    
		    <input type="hidden" class="form-control" id="id_membre" name="id_membre" value="<?php echo $id_membre; ?>">
		  </div>

		  <div class="form-group">		    

		    <input type="hidden" class="form-control" id="id_annonce" name="id_annonce" value="<?php echo $id_annonce; ?>">
		  </div>

		  <div class="form-group">
		    <label for="commentaire">Commentaire</label>
		    <textarea class="form-control" rows="20" name="commentaire" id="commentaire" value= "<?php echo $commentaire; ?>"></textarea>
		  </div>

		  <div class="form-group">
		    <label for="date_enregistrement">date_enregistrement</label>
		    <input type="text" class="form-control" id="date_enregistrement" name="date_enregistrement" value="<?php echo $date_enregistrement; ?>">
		  </div>


		  <button type="submit" class="btn btn-default" href="#" value="Envoyer">Enregistrer</button>
	</form>



<?php
}
?>


<?php
require_once("../inc/bas.inc.php");
?>

