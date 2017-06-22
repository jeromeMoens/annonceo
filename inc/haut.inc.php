
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mon Site</title>
	<link rel="stylesheet" href="/php/site_boutique/inc/css/style.css">
</head>
<body>

	<header>
		<div class="conteneur">
			<span>
				<a href="" title="Mon Site">MonSite.com</a>
			</span>
			<nav>
				<?php	
					if(internauteEstConnecteEtEstAdmin())
					{// BackOffice
						echo '<a href="' . URL . 'admin/gestion_membre.php">Gestion des membres</a>';
						echo '<a href="' . URL . 'admin/gestion_commande.php">Gestion des commandes</a>';
						echo '<a href="' . URL . 'admin/gestion_boutique.php">Gestion de la boutique</a>';
					}
					if(internauteEstConnecte())// membre du site ayant un compte
					{
						echo '<a href="' . URL . 'profil.php">Voir votre profil</a>';
						echo '<a href="' . URL . 'boutique.php">Accés à la boutique</a>';
						echo '<a href="' . URL . 'panier.php">Voir votre panier</a>';
						echo '<a href="' . URL . 'connexion.php?action=deconnexion">Se déconnecter</a>';
					}
					else// visiteur
					{
						echo '<a href="' . URL . 'inscription.php">Inscription</a>';
						echo '<a href="' . URL . 'boutique.php">Accés à la boutique</a>';
						echo '<a href="' . URL . 'panier.php">Voir votre panier</a>';
						echo '<a href="' . URL . 'connexion.php">Connexion</a>';
					}
					
					?>
			</nav>
		</div>
	</header>

	<section>
		<div class="conteneur">