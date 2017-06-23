<?php 
require_once("../inc/init.inc.php");
// vérification du statut
if(!internauteEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit();
}

// Affichage des catégories

if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{
	$r = $pdo->query("SELECT * FROM categorie");
	$content .= '<h1>Affichage des ' . $r->rowCount() . ' catégorie(s)</h1>';
	$content .= '<table class="table table-striped"><tr>';
	for($i=0;$i < $r->columnCount();$i++)
	{
		$colonne = $r->getColumnMeta($i);
		$content .= "<th>$colonne[name]</th>";
	}
	$content .= "<th>Action</th>";
	$content .= "</tr>";
	while($ligne = $r->fetch(PDO::FETCH_ASSOC))
	{
		$content .= '<tr>';
		foreach($ligne as $indice => $valeur)
		{
			$content .= "<td>$valeur</td>";
		}
		$content .= "<td><a href=\"?action=modification&id_categorie=$ligne[id_categorie]\"><img src=\"".URL."inc/img/edit.png\" alt=\"edit\"></a><a href=\"?action=suppression&id_categorie=$ligne[id_categorie]\" OnClick='return(confirm(\"En êtes-vous certain?\"));'><img src=\"".URL."inc/img/delete.png\" alt=\"poubelle\"></a></td></tr>";
	}
	$content .= "</table>";
}


// MODIFICATION CATEGORIE
if(isset($_GET['action']) && $_GET['action'] == 'modification')
{
    if(isset($_GET['id_categorie']))
    {
        $resultat = $pdo->query("SELECT * FROM categorie WHERE id_categorie=$_GET[id_categorie]");
        $categorie_actuelle = $resultat->fetch(PDO::FETCH_ASSOC);
    }
    $id_categorie = isset($categorie_actuelle['id_categorie']) ? $categorie_actuelle['id_categorie'] : '';
    $titre = isset($categorie_actuelle['titre']) ? $categorie_actuelle['titre'] : '';
    $motscles = isset($categorie_actuelle['motscles']) ? $categorie_actuelle['motscles'] : '';


  if($_POST)
  {
      $content .= '<div class="validation">La catégorie a bien été modifiée.</div>';

      debug($_POST);

      $req_modif_categorie = "REPLACE INTO categorie(id_categorie, titre, motscles) VALUES (:id_categorie, :titre, :motscles)";
      $r_categorie = $pdo->prepare($req_modif_categorie);
      $r_categorie->bindValue(':id_categorie', $_POST['id_categorie'], PDO::PARAM_STR);
      $r_categorie->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
      $r_categorie->bindValue(':motscles', $_POST['motscles'], PDO::PARAM_STR);
      
      $r_categorie->execute();

      header("location:?action=affichage");
	  exit();
  }
$content .=
    '<form class="form-horizontal" method="POST">
      
        <input type="hidden"  id="id" name="id_categorie" value="'. $id_categorie .'">
      <legend>Modification de la catégorie n°'.$_GET["id_categorie"].' :</legend>
      <div class="form-group">
        <label for="titre" class="control-label col-sm-2">Titre</label>
        <div class="col-sm-10">
        	<input type="text" class="form-control" id="titre" name="titre" placeholder="Titre" value="'. $titre .'">
    	</div>
      </div>
      <div class="form-group">
        <label for="motscles" class="control-label col-sm-2">Mots clés</label>
        <div class="col-sm-10">
        	<textarea class="form-control" id="motscles" name="motscles" rows="3">'. $motscles .'</textarea>
    	</div>
      </div>
      <div class="form-group">
	    <div class="text-right col-sm-10">
	      <button type="submit" id="submit_categorie" name="submit_categorie" class="btn btn-primary" aria-label="">Enregistrer</button>
	    </div>
	  </div>
	</form>';
}


// SUPPRESSION CATEGORIE
if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	$pdo->query("DELETE FROM categorie WHERE id_categorie = $_GET[id_categorie]");
	$content .= "<div class='validation'>La catégorie n° ". $_GET['id_categorie'] ." a été supprimée</div>";
	// $_GET['action'] = 'affichage';
	header('location:?action=affichage');
	exit();
}

require_once("../inc/haut.inc.php");
// debug($_GET);
// debug($r);

echo $content;

require_once("../inc/bas.inc.php");
?>