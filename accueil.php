<?php
require_once("inc/init.inc.php");

$catReq = $pdo->query("SELECT titre FROM categorie");
$cat = $catReq->fetchAll(PDO::FETCH_ASSOC);
// debug($cat);


$pays = $pdo->query("SELECT pays FROM annonce");

$membre = $pdo->query("SELECT prenom,nom FROM membre");

$prix = $pdo->query("SELECT prix FROM annonce");


require_once("inc/haut.inc.php");

?>

<form method='GET' action=''>
	<label>Catégorie</label>
	<select>
		<?php
		for($i=0; $i < $cat.length();$i++){
			foreach($cat as $categorie){
				debug($categorie);
				echo "<option>".$categorie."</option>";
			}
		}
		?>
	</select>

	<label>Région</label>
	<select></select>

	<label>Membre</label>
	<select></select>

	<label for="select_prix">Prix</label>
	<input type="range" name="prix" id="select_prix" min="0" max="200000" value="0" step="100">
</form>

<?php

echo $content;
?>





<?php
require_once("inc/bas.inc.php");
?>
