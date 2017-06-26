<?php
require_once("inc/init.inc.php");

$prix = $pdo->query("SELECT prix FROM annonce");


require_once("inc/haut.inc.php");

?>
<div class="container" id="column_left">
	<form method='GET' action=''>
		<fieldset>
			<div class="form-group">
				<label>Catégorie</label>
				<select name="categorie_accueil" id="categorie_accueil" class="form-control">
					<?php
					$catReq = $pdo->query("SELECT titre FROM categorie");
					while($cat = $catReq->fetch(PDO::FETCH_ASSOC)){
						// debug($cat);
						echo "<option>".$cat['titre']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label>Région</label>
				<select class="form-control" name="pays_accueil" id="pays_accueil">
					<?php
					$paysReq = $pdo->query("SELECT DISTINCT pays FROM annonce");
					while($pays = $paysReq->fetch(PDO::FETCH_ASSOC)){
						echo "<option>".$pays['pays']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
			<label>Membre</label>
				<select class="form-control" name="membre_accueil" id="membre_accueil">
					<?php
					$membreReq = $pdo->query("SELECT DISTINCT id_membre,prenom,nom FROM membre");
					while($membre = $membreReq->fetch(PDO::FETCH_ASSOC)){
						echo "<option>".$membre['prenom']." ".$membre['nom']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="select_prix">Prix</label>
				<input type="range" name="select_prix" id="select_prix" min="0" max="200000" value="" step="100">
			</div>
		</fieldset>
		<select>
			<option>
				Trier par prix (du moins cher au plus cher) 
			</option>
			<option>
				Trier par prix (du plus cher au moins cher)
			</option>
			<option>
				Trier par date (de la plus ancienne à la plus récente)
			</option>
				<option>
				Trier par date (de la plus récente à la plus ancienne)
			</option>
			<option>
				Trier par membre (les mieux notés en premier)
			</option>
		</select>
		<p>
			<em><?php 
				$result = $pdo->query("SELECT a.photo, a.titre, a.description_courte, m.prenom, a.prix FROM annonce.a, membre.m WHERE a.id_membre = m.id_membre AND a.categorie = '$_GET[categorie_accueil]' AND a.pays = '$_GET[pays_accueil]' AND a.id_membre = '$_GET[membre_accueil]' AND a.prix < '$_GET[select_prix]'");
				echo count($result)." résultats";
		 		?>
		 	</em>
		 </p>
	</form>
</div>

<div class="container" id="annonce_accueil">
	
</div>


<?php
require_once("inc/bas.inc.php");
?>
