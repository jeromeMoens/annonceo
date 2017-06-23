
<!DOCTYPE html>
<html lang="FR-fr">
<head>
	<meta charset="UTF-8">
	<title>Annonceo</title>


	<!-- Latest compiled and minified CSS -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="">
</head>
<body>

	<header>
		<div class="container">

			<nav class="navbar navbar-default">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <span><a class="navbar-brand" href="accueil.php" title="Annonceo">Annonceo</a></span>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        <li><a href="qui_sommes_nous.php">Qui sommes-nous ? <span class="sr-only">(current)</span></a></li>
			        <li><a href="contact.php">Contact</a></li>
			      </ul>
			      <form class="navbar-form navbar-left">
			        <div class="form-group">
			          <input type="text" class="form-control col-m-6" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-default">Recherche</button>
			      </form>

				  <?php
				  if(internauteEstConnecte())// membre du site ayant un compte
				  {
					echo '<ul class="nav navbar-nav navbar-right">';
					if(internauteEstConnecteEtEstAdmin())
					{// BackOffice

						echo '<li><a href="' . URL . 'admin/gestion_annonces.php">Gestion des annonces</a></li>
						      <li><a href="' . URL . 'admin/gestion_categories.php">Gestion des catégories</a></li>
						      <li><a href="' . URL . 'admin/gestion_commentaires.php">Gestion des commentaires</a></li>
						      <li><a href="' . URL . 'admin/gestion_notes.php">Gestion des notes</a></li>
						      <li><a href="' . URL . 'admin/statistiques.php">Statistiques</a></li>';
					}
					echo '<li><a href="' . URL . 'profil.php">Voir votre profil</a><li>';
					echo '<li><a href="' . URL . 'annonces.php">Voir les annonces</a></li>';
					echo '<li><a href="' . URL . 'connexion.php?action=deconnexion"><span class="glyphicon glyphicon-user"></span> Se déconnecter</a></li></ul>';
				  }
				  else// visiteur
				  {
					echo '<ul class="nav navbar-nav navbar-right"><li><a href="' . URL . 'annonces.php">Voir les annonces</a></li>';
					echo '<li><a href="' . URL . 'inscription.php">Inscription</a></li>';
					echo '<li><a href="' . URL . 'connexion.php"><span class="glyphicon glyphicon-user"></span> Espace membre</a></li></ul>';
				  }
				  ?>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>

		</div>
	</header>

	<section>

		<div class="container">
