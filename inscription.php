<?php 
require_once("inc/init.inc.php");



if($_POST) // si je clique sur le bouton submit, il y a une action sur le formulaire et je rentre dans la condition if => permet d'éviter les erreurs undefined au premier chargement de la page
{
	// prévenir les insertions sql
	foreach($_POST as $indice => $valeurs)
	{
		$_POST[$indice] = addslashes($valeurs);
	}

	// contrôle de la longueur du champs 'pseudo'
	if(strlen($_POST['pseudo'])>20)
	{
		$content .="<div class='erreur'>Votre pseudo doit contenir moins de 20 caractères</div>";
	}

	// contrôle de la disponibilité du pseudo
	$r = $pdo->query("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
	if($r->rowCount() >= 1)
    {
        $content .='<div class="erreur">Pseudo indisponible ! Merci d\'en choisir un autre.</div>';
    }

    // contrôle de la longueur du champs 'nom'
	if(strlen($_POST['nom'])>20)
	{
		$content .= "<div class='erreur'>Votre nom doit contenir moins de 20 caractères</div>";
	}

	// contrôle des caractères du pseudo
	if(!preg_match('#^[a-zA-Z0-9._-]+$#',$_POST['pseudo']))
	{
		$content .= '<div class="erreur">Erreur de format / caractères pour le pseudo</div>';
	}

	// contrôle du champs email
	$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
	if( $email == FALSE) 
	{
		$content .= "<div class='erreur'>Veuillez entrer un e-mail valide.</div>";
	}
	
	// si aucun message d'erreur n'est affiché, on exécute la requête d'insertion en BDD et on ajoute un message de succès
	if(empty($content))
	{
		$req = "INSERT INTO membre (pseudo,mdp,nom,prenom,telephone,email,civilite) VALUES (:pseudo,:mdp,:nom,:prenom,:telephone,:email,:civilite)";

		$prepare = $PDO->prepare($req);

		$prepare->bindParam(':pseudo', $_POST['pseudo']);
		$prepare->bindParam(':mdp', $_POST['mdp']);
		$prepare->bindParam(':nom', $_POST['nom']);
		$prepare->bindParam(':prenom', $_POST['prenom']);
		$prepare->bindParam(':telephone', $_POST['telephone']);
		$prepare->bindParam(':email', $_POST['email']);
		$prepare->bindParam(':civilite', $_POST['civilite']);

		$prepare->execute();

		$content .="<div class='validation'>Vous êtes inscrit à notre site web. <a href=\"connexion.php\"><u>Cliquez ici pour vous connecter</u></a></div>";
	}
}
require_once("inc/haut.inc.php");
echo $content;
?>

<form class="form-horizontal" method="POST" action="">
	<fieldset>


	<!-- change col-sm-N to reflect how you would like your column spacing (http://getbootstrap.com/css/#forms-control-sizes) -->


		<!-- Form Name -->
		<legend>Inscription</legend>
		
		<!-- Consigne -->
		<span id="helpBlock" class="help-block">Les champs munis d'un astérisque sont obligatoires</span>

		<!-- Text input http://getbootstrap.com/css/#forms -->
		<div class="form-group">
		  <label for="pseudo" class="control-label col-sm-2">Pseudo *</label>
		  <div class="col-sm-10">
		    <input type="text" class="form-control" id="pseudo" name="pseudo" pattern="[a-zA-Z0-9_.]{3-20}" title="caractères acceptés : a-zA-Z0-9_." placeholder="Choisissez un pseudo" value="<?php if(isset($_POST['pseudo'])) { echo htmlentities($_POST['pseudo']);}?>">
		    
		  </div>
		</div>
		<!-- Text input http://getbootstrap.com/css/#forms -->
		<div class="form-group">
		  <label for="mdp" class="control-label col-sm-2">Mot de passe *</label>
		  <div class="col-sm-10">
		    <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Choisissez un mot de passe" value="<?php if(isset($_POST['mdp'])) { echo htmlentities($_POST['mdp']);}?>">
		    
		  </div>
		</div>
		<!-- Text input http://getbootstrap.com/css/#forms -->
		<div class="form-group">
		  <label for="nom" class="control-label col-sm-2">Nom *</label>
		  <div class="col-sm-10">
		    <input type="text" class="form-control" id="nom" name="nom" placeholder="Renseignez votre nom" value="<?php if(isset($_POST['nom'])) { echo htmlentities($_POST['nom']);}?>">
		    
		  </div>
		</div>
		<!-- Text input http://getbootstrap.com/css/#forms -->
		<div class="form-group">
		  <label for="prenom" class="control-label col-sm-2">Prénom *</label>
		  <div class="col-sm-10">
		    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Renseignez votre prénom" value="<?php if(isset($_POST['prenom'])) { echo htmlentities($_POST['prenom']);}?>">
		    
		  </div>
		</div>
		<!-- Text input http://getbootstrap.com/css/#forms -->
		<div class="form-group">
		  <label for="telephone" class="control-label col-sm-2">Téléphone *</label>
		  <div class="col-sm-10">
		    <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Renseignez un numéro de téléphone" value="<?php if(isset($_POST['telephone'])) { echo htmlentities($_POST['telephone']);}?>">
		    
		  </div>
		</div>
		<!-- Text input http://getbootstrap.com/css/#forms -->
		<div class="form-group">
		  <label for="email" class="control-label col-sm-2">Email *</label>
		  <div class="col-sm-10">
		    <input type="email" class="form-control" id="email" name="email" placeholder="placeholder" value="<?php if(isset($_POST['email'])) { echo htmlentities($_POST['email']);}?>">
		    
		  </div>
		</div>
		<!-- Fuel UX Radios Inline http://getfuelux.com/javascript.html#radio-examples-inline -->
		<div class="form-group">
		  <label for="civilite" class="control-label col-sm-2">Civilité *</label>

		  <div class="radio col-sm-10">
		      <label class="radio-custom radio-inline" data-initialize="radio" id="civilite-0">
		        <input class="sr-only" name="civilite" type="radio" value="Femme"> <span class="radio-label">Femme</span>
		      </label><label class="radio-custom radio-inline" data-initialize="radio" id="civilite-1">
		        <input class="sr-only" name="civilite" type="radio" value="Homme"> <span class="radio-label">Homme</span>
		      </label>
		    
		  </div>
		</div>
		<!-- Button http://getbootstrap.com/css/#buttons -->
		<div class="form-group">
		  <label class="control-label col-sm-2" for="submit_membre"></label>
		  <div class="text-left col-sm-10">
		    <button type="submit" id="submit_membre" name="submit_membre" class="btn btn-primary" aria-label="">Enregistrer</button>
		  </div>
		</div>


	</fieldset>
</form>



<?php
require_once("inc/bas.inc.php");
?>