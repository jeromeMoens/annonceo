<?php
require_once("inc/init.inc.php");
require_once("inc/haut.inc.php");
if(!internauteEstConnecte()) // si le membre n'est pas connecté, il ne doit pas avoir accès à la page profil
{
    //header("location:connexion.php");
}
      echo '<p>Bonjour ' . $_SESSION['membre']['prenom'] . ', <br>Voici vos informations :</p>';
      ?>
      <h1>Votre profil</h1>
      <br>
      <div class="profil">
        <?php
        $content .= '<h3>' . $_SESSION['membre']['prenom'] . ' ' . $_SESSION['membre']['nom'] . '</h3><br>';
        $content .= '<p>Adresse email : ' . $_SESSION['membre']['email'] . '</p><br>';
        if($_SESSION['membre']['statut'] == 1)
        {
            $content .= '<p>Votre statut est admin.</p><br>';
        }
        else
        {
            $content .= '<p>Votre statut est membre.</p><br>';
        }
        echo  $content;
        ?>
