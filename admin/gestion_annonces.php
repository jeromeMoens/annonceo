<?php
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");
if(!internauteEstConnecteEtEstAdmin())
{
    header("location:../connexion.php");
    exit(); // interrompt le script
}

// -------------- SUPPRESSION annonce --------------

if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
  $pdo->query("DELETE FROM annonce WHERE id_annonce='$_GET[id_annonce]'");
  $content .= "<div class='alert alert-success'>L'annonce n° " . $_GET['id_annonce'] . " a bien été supprimé.</div>";
  header("location;?action=affichage");
  exit();
}

?>

<form method="POST">
  <div class="form-group">
    <select class="form-control" name="categorie">
      <option>Trier par catégorie</option>
      <option value="1">Immobilier</option>
      <option value="2">Multimédia</option>
      <option value="3">Véhicules</option>
      <option value="4">Loisirs</option>
      <option value="5">Maison</option>
      <option value="6">Vacances</option>
    </select>
    <input type="submit"/>
  </div>
</form>

<?php
if($_POST && isset($_POST['categorie']))
{
    $r = $pdo->query("SELECT * FROM annonce WHERE id_categorie =" .$_POST['categorie']);
    $content .= "<h1>Affichage des " . $r->rowCount() . " annonces</h1>";

    $content .= "<table class='table table-striped'><tr>";

    for($i = 0; $i < $r->columnCount(); $i++)
    {
        $colonne = $r->getColumnMeta($i);
        $content .= "<th>$colonne[name]</th>";
    }
    $content .= "<th>Actions</th>";
    $content .= "</tr>";

    while($ligne = $r->fetch(PDO::FETCH_ASSOC))
    {
        $content .= "<tr>";
        foreach($ligne as $indices => $valeurs)
        {
          if($indices == 'description_longue')
          {
            $content .= '<td>' . substr($valeurs, 0, 150) . '...</td>';
          }
          elseif($indices == 'photo')
          {
            $content .= '<td><img style="width:200px;height:200px" src="'. $valeurs .'"></td>';
          }
          else
          {
            $content .= '<td>' . $valeurs . '</td>';
          }
        }
        $content .= "<td><a href=\"?action=modification&id_annonce=$ligne[id_annonce]\"><img src=\"../inc/img/edit.png\"></a>";
        $content .= "<a href=\"?action=suppression&id_annonce=$ligne[id_annonce]\" OnClick=\"return(confirm('En êtes-vous certain ?'))\";><img src=\"../inc/img/delete.png\"></a></td>";
        $content .= "</tr>";
    }
    $content .= "</table>";
}
//----------- Modification des annonces ------------------

if(isset($_GET['action']) && $_GET['action'] == 'modification')
{
    if(isset($_GET['id_annonce']))
    {
        $resultat = $pdo->query("SELECT * FROM annonce WHERE id_annonce=$_GET[id_annonce]");
        $annonce_actuelle = $resultat->fetch(PDO::FETCH_ASSOC);
    }
    $id_annonce = isset($annonce_actuelle['id_annonce']) ? $annonce_actuelle['id_annonce'] : '';
    $titre = isset($annonce_actuelle['titre']) ? $annonce_actuelle['titre'] : '';
    $description_courte = isset($annonce_actuelle['description_courte']) ? $annonce_actuelle['description_courte'] : '';
    $description_longue = isset($annonce_actuelle['description_longue']) ? $annonce_actuelle['description_longue'] : '';
    $prix = isset($annonce_actuelle['prix']) ? $annonce_actuelle['prix'] : '';
    $photo = isset($annonce_actuelle['photo']) ? $annonce_actuelle['photo'] : '';
    $pays = isset($annonce_actuelle['pays']) ? $annonce_actuelle['pays'] : '';
    $ville = isset($annonce_actuelle['ville']) ? $annonce_actuelle['ville'] : '';
    $adresse = isset($annonce_actuelle['adresse']) ? $annonce_actuelle['adresse'] : '';
    $cp = isset($annonce_actuelle['cp']) ? $annonce_actuelle['cp'] : '';
    $id_membre = isset($annonce_actuelle['id_membre']) ? $annonce_actuelle['id_membre'] : '';
    $id_photo = isset($annonce_actuelle['id_photo']) ? $annonce_actuelle['id_photo'] : '';
    $id_categorie = isset($annonce_actuelle['id_categorie']) ? $annonce_actuelle['id_categorie'] : '';
    $date_enregistrement = isset($annonce_actuelle['date_enregistrement']) ? $annonce_actuelle['date_enregistrement'] : '';
    
  if($_POST)
  {
      $content .= '<div class="alert alert-success">L\'annonce a bien été modifiée/créée</div>';
          $req_modif_annonce = "REPLACE INTO annonce(id_annonce, titre, description_courte, description_longue, prix, photo, pays, ville, adresse, cp, id_membre, id_photo, id_categorie, date_enregistrement) VALUES (:id_annonce, :titre, :description_courte, :description_longue, :prix, :photo, :pays, :ville, :adresse, :cp, :id_membre, :id_photo, :id_categorie, :date_enregistrement)";
          $r_annonce = $pdo->prepare($req_modif_annonce);
          $r_annonce->bindValue(':id_annonce', $_POST['id_annonce'], PDO::PARAM_STR);
          $r_annonce->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
          $r_annonce->bindValue(':description_courte', $_POST['description_courte'], PDO::PARAM_STR); // le paramètre de la requête SQL, la valeur qu'on lie, le type attendu
          $r_annonce->bindValue(':description_longue', $_POST['description_longue'], PDO::PARAM_STR);
          $r_annonce->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);
          $r_annonce->bindValue(':photo', $_POST['photo'], PDO::PARAM_STR);
          $r_annonce->bindValue(':pays', $_POST['pays'], PDO::PARAM_STR);
          $r_annonce->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
          $r_annonce->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
          $r_annonce->bindValue(':cp', $_POST['cp'], PDO::PARAM_STR);
          $r_annonce->bindValue(':id_membre', $_POST['id_membre'], PDO::PARAM_STR);
          $r_annonce->bindValue(':id_photo', $_POST['id_photo'], PDO::PARAM_STR);
          $r_annonce->bindValue(':id_categorie', $_POST['id_categorie'], PDO::PARAM_STR);
          $r_annonce->bindValue(':date_enregistrement', $_POST['date_enregistrement'], PDO::PARAM_STR);
          $r_annonce->execute();
  }
$content .=
    '<form method="POST">
      <div class="form-group">
        <label for="id">Id_annonce</label>
        <input type="text" class="form-control" id="id" name="id_annonce" placeholder="Id_annonce" value="'. $id_annonce .'">
      </div>
      <div class="form-group">

        <label for="titre">Titre</label>
        <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre" value="'. $titre .'">
      </div>
      <div class="form-group">
        <label for="description_courte">Description courte</label>
        <input type="text" class="form-control" id="description_courte" name="description_courte" placeholder="Description courte" value="'. $description_courte .'">
      </div>
      <div class="form-group">
        <label for="description_longue">Description longue</label>
        <textarea type="text" class="form-control" id="description_longue" name="description_longue" placeholder="Description longue" value="'. $description_longue .'"></textarea>
      </div>
      <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix" value="'. $prix .'">
      </div>
      <div class="form-group">
        <label for="photo">Photo</label>
        <input type="text" class="form-control" id="photo" name="photo" placeholder="Photo" value="'. $photo .'">';

        $req_photo = $pdo->query("SELECT * from photo WHERE id_photo = $id_photo");
        while($ligne = $req_photo->fetch(PDO::FETCH_ASSOC))
        {
          foreach($ligne as $indices => $valeurs)
          {
            if(empty($valeurs))
            {

            }
            else
            {
              if(ctype_digit($valeurs))
              {}
              else
              {
                $content .= '<img style="width:100px;height:100px;" src="'. $valeurs .'">';
              }
            }
          }
        }

        $content .=
      '</div>
      <div class="form-group">
        <label for="pays">Pays</label>
        <input type="text" class="form-control" id="pays" name="pays" placeholder="Pays" value="'. $pays .'">
      </div>
      <div class="form-group">
        <label for="ville">Ville</label>
        <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" value="'. $ville .'">
      </div>
      <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="'. $adresse .'">
      </div>
      <div class="form-group">
        <label for="cp">Code postal</label>
        <input type="text" class="form-control" id="cp" name="cp" placeholder="Code postal" value="'. $cp .'">
      </div>
      <div class="form-group">
        <label for="id_membre">Id_membre</label>
        <input type="text" class="form-control" id="id_membre" name="id_membre" placeholder="Id_membre" value="'. $id_membre .'">
      </div>
      <div class="form-group">
        <label for="id_photo">Id_photo</label>
        <input type="text" class="form-control" id="id_photo" name="id_photo" placeholder="Id_photo" value="'. $id_photo .'">
      </div>
      <div class="form-group">
        <label for="id_categorie">Id_categorie</label>
        <input type="text" class="form-control" id="id_categorie" name="id_categorie" placeholder="Id_categorie" value="'. $id_categorie .'">
      </div>
      <div class="form-group">
        <label for="date">Date d\'enregistrement</label>
        <input type="datetime" class="form-control" id="date" name="date_enregistrement" placeholder="Date d\'enregistrement/modification" value="'. $date_enregistrement .'">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>';
}

echo $content;
require_once("../inc/bas.inc.php");
?>
