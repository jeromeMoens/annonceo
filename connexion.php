<?php
require_once("inc/init.inc.php");
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion')
{
    unset($_SESSION['membre']);
    unset($_SESSION['panier']);
}
// si l'internaute est connecté, on le renvoie vers son profil
if(internauteEstConnecte())
{
    header('location:profil.php');
    exit();
}

// Verification qu'il y a quelque chose en POST
if($_POST)
{

  //debug($_POST);

  //Si oui, alors on récupère le pseudo en BDD par rapport à ce que l'utilisateur a rentré en POST
    $r = $pdo->query("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
    if($r->rowCount() >= 1)
    {
      $membre = $r->fetch(PDO::FETCH_ASSOC);
      // si le mdp rentré dans le formulaire correspond à celui en BDD, alors on envoie les infos dans la superglobale $_SESSION
      if($_POST['mdp'] == $membre['mdp'])
      {
        $content .= '<div class="validation">Vous êtes connectés !</div>';
            $_SESSION['membre']['id_membre'] = $membre['id_membre']; // on crée un espace à l'intérieur du fichier session et enregistrons les infos liées à cet internaute
            $_SESSION['membre']['pseudo'] = $membre['pseudo'];
            $_SESSION['membre']['nom'] = $membre['nom'];
            $_SESSION['membre']['prenom'] = $membre['prenom'];
            $_SESSION['membre']['telephone'] = $membre['telephone'];
            $_SESSION['membre']['email'] = $membre['email'];
            $_SESSION['membre']['civilite'] = $membre['civilite'];
            $_SESSION['membre']['statut'] = $membre['statut'];
            header("location:profil.php");
      }
      else
      {
        $content .= '<div class="erreur">Erreur de pseudo !</div>';
      }
      }
    }
require_once("inc/haut.inc.php");
echo $content;
?>

<!-- FORMULAIRE DE CONNEXION -->

<h1>Connectez-vous !</h1>
<form method="POST" action="">
  <div class="form-group">
    <label for="InputPseudo">Pseudo</label>
    <input type="text" class="form-control" id="InputPseudo" name="pseudo" placeholder="Pseudo">
  </div>
  <div class="form-group">
    <label for="InputPassword">Password</label>
    <input type="password" class="form-control" id="InputPassword" name="mdp" placeholder="Mot de passe">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>

<?php
require_once("inc/bas.inc.php");
?>
