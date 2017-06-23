<?php
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");

if(!internauteESTConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit(); // interrompt le script
}

//--------------------SUPPRESSION NOTES
if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	//Executez une requête de supression
	$pdo->query("DELETE FROM note WHERE id_note = '$_GET[id_note]'");
	$content .= "<div class ='validation'>la note n° " . $_GET['id_note'] . " a été supprimée. </div>";
	$_GET['action'] = 'affichage';
	
}


//--------------------ENREGISTREMENT NOTES
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
			$content .= '<div class"danger">Veuillez renseigner une note</div>';
		}				

	if(!empty($content))
		{
			$content .= '<div class"success">La note a été enregistrée avec succès !</div>';
		}		
}


//--------------------MODIFICATION NOTES

if(isset($_POST))
{

	if(isset($_GET['action']) && $_GET['action'] == 'modification')
	{

		foreach($_POST as $indice => $valeurs) 
		{
		$req_insert_note = "REPLACE INTO note(id_note,id_membre1,id_membre2,note, avis, date_enregistrement)VALUES(:id_notee, :id_membre1, :id_membre2, :note, :avis, :date_enregistrement)";

		$req_note = $pdo->prepare($req_insert_note);
		$req_note->bindValue(':id_note', $_POST['id_note'], PDO::PARAM_INT);
		$req_note->bindValue(':id_membre1', $_POST['id_membre1'], PDO::PARAM_INT);
		$req_note->bindValue(':id_membre2', $_POST['id_membre2'], PDO::PARAM_INT);
		$req_note->bindValue(':note', $_POST['note'], PDO::PARAM_STR);
		$req_note->bindValue(':avis', $_POST['avis'], PDO::PARAM_STR);
		$req_note->bindValue(':date_enregistrement', $_POST['date_enregistrement'], PDO::PARAM_INT);

		$req_note->execute();
		}
	}	
}

//-----LIENS NOTES-----//
$content .= '<a style= "text-decoration: underline"; href="?action=affichage";>Affichage des notes</a><br>';
$content .= '<a style= "text-decoration: underline"; href="?action=ajout">Ajout de notes</a><br>';


//-----AFFICHAGE NOTES-----//
// Affichage sous forme de tableau HTML de l'ensemble de la table note

if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{

$r = $pdo->query("SELECT * FROM note");
$content .= "<h1>Affichage des " . $r->rowCount() . " note(s)</h1>";
$content .= "<table class='table table striped'><tr>";

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
	$content .= "<td><a href=\"?action=voir&id_note=$ligne[id_note]\"><img src='../inc/img/loupe.png'></a></td>";

	$content .= "<td><a href=\"?action=modification&id_note=$ligne[id_note]\"><img src='../inc/img/edit.png'></a></td>";

	$content .= "<td><a href=\"?action=suppression&id_note=$ligne[id_note]\" OnClick=\"return(confirm('En êtes vous certain ?'))\";><img src='../inc/img/delete.png'></a></td>";

	$content .= "</tr>";
}

$content .= "</table>";
}

echo $content;


if(isset($_GET['action']) && $_GET['action'] == 'voir' ||isset($_GET['action']) && $_GET['action'] == 'ajout' ||isset($_GET['action']) && $_GET['action'] == 'modification')
{
	if (isset($_GET['id_note']))
	{
		$resultat = $pdo->query("SELECT * FROM note WHERE id_note=$_GET[id_note]"); // on récupère les informations sur la note à modifier
		$note_actuelle = $resultat->fetch(PDO::FETCH_ASSOC); // on rend les informations exploitables afin de les présaisir dans les cases du formulaire
		//debug($note_actuelle);
	}	

	$id_note = (isset($note_actuelle['id_note'])) ? $note_actuelle['id_note'] : '';
	$id_membre1 = (isset($note_actuelle['id_membre1'])) ? $note_actuelle['id_membre1'] : '';
	$id_membre2 = (isset($note_actuelle['id_membre2'])) ? $note_actuelle['id_membre2'] : '';
	$note = (isset($note_actuelle['note'])) ? $note_actuelle['note'] : '';
	$avis = (isset($note_actuelle['avis'])) ? $note_actuelle['avis'] : '';
	$date_enregistrement = (isset($note_actuelle['date_enregistrement'])) ? $note_actuelle['date_enregistrement'] : '';

?>


<h1>Formulaire note<h1>
	<form method="POST" action="#" enctype="multipart/form-data">

		  <div class="form-group">
		    <input type="hidden" class="form-control" id="id_note" name="id_note" value="<?php echo $id_note; ?>">
		  </div>

		  <div class="form-group">		    
		    <input type="hidden" class="form-control" id="id_membre1" name="id_membre1" value="<?php echo $id_membre1; ?>">
		  </div>

		  <div class="form-group">		    
		    <input type="hidden" class="form-control" id="id_membre2" name="id_membre2" value="<?php echo $id_membre2; ?>">
		  </div>

		  <div class="form-group">
		    <label for="note">Note</label>
			<select id="star-rating" name="note">
				<option value="">Select a rating</option>
				<option value="5">Excellent</option>
				<option value="4">Very Good</option>
				<option value="3">Average</option>
				<option value="2">Poor</option>
				<option value="1">Terrible</option>
			</select>
		  </div>

		  <div class="form-group">
		    <label for="avis">Avis</label>
		    <textarea class="form-control" rows="20" name="avis" id="avis" value= "<?php echo $avis; ?>"></textarea>
		  </div>

		  <div class="form-group">
		    <label for="date_enregistrement">Date enregistrement</label>
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