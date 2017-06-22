
<!DOCTYPE html>
<html lang="FR-fr">
<head>
	<meta charset="UTF-8">
	<title>Annonceo</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="">
</head>
<body>

	<header>
		<div class="conteneur">
			<span>
				<a href="" title="Annonceo">Annonceo</a>
			</span>
			<nav>
				<?php
					if(internauteEstConnecteEtEstAdmin())
					{// BackOffice
						echo '<a href="' . URL . 'admin/gestion_membres.php">Gestion des membres</a>';
						echo '<a href="' . URL . 'admin/gestion_annonces.php">Gestion des annonces</a>';
						echo '<a href="' . URL . 'admin/gestion_categories.php">Gestion des catégories</a>';
						echo '<a href="' . URL . 'admin/gestion_commentaires.php">Gestion des commentaires</a>';
						echo '<a href="' . URL . 'admin/gestion_notes.php">Gestion des notes</a>';
						echo '<a href="' . URL . 'admin/statistiques.php">Statistiques</a>';
					}
					if(internauteEstConnecte())// membre du site ayant un compte
					{
						echo '<a href="' . URL . 'profil.php">Voir votre profil</a>';
						echo '<a href="' . URL . 'annonces.php">Voir les annonces</a>';
						echo '<a href="' . URL . 'connexion.php?action=deconnexion">Se déconnecter</a>';
					}
					else// visiteur
					{
						echo '<a href="' . URL . 'inscription.php">Inscription</a>';
						echo '<a href="' . URL . 'annonces.php">Voir les annonces</a>';
						echo '<a href="' . URL . 'connexion.php">Connexion</a>';
					}

					?>
			</nav>
		</div>
	</header>

	<section>
		<div class="conteneur">
