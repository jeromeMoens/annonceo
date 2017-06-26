<?php
require_once("inc/init.inc.php");

//----------- SUPPRESSION annonce ------------

if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
    $pdo->query("DELETE FROM annonce WHERE id_annonce='$_GET[id_annonce]'");
    $content .= "<div class='alert alert-success'>L'annonce n° " . $_GET['id_annonce'] . " a bien été supprimée.</div>";
    $_GET['action'] = 'affichage';
}

require_once("inc/haut.inc.php");
if(!internauteEstConnecte()) // si le membre n'est pas connecté, il ne doit pas avoir accès à la page profil
{
    header("location:connexion.php");
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

    $content .= "<a style= 'text-decoration: underline'; href='?action=affichage'>Accéder à mes annonces</a><br/>";
    $content .= "<a style= 'text-decoration: underline'; href='?action=creation'>Créer une annonce</a><br/>";

    //----------- Modification des annonces ------------    

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
            $req_modif_annonce = "REPLACE INTO annonce(id_annonce, titre, description_courte, description_longue, prix, photo, pays, ville, adresse, cp, id_membre, id_photo, id_categorie) VALUES (:id_annonce, :titre, :description_courte, :description_longue, :prix, :photo, :pays, :ville, :adresse, :cp, :id_membre, :id_photo, :id_categorie)";
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
            $r_annonce->bindValue(':id_membre', $id_membre, PDO::PARAM_STR);
            $r_annonce->bindValue(':id_photo', $id_photo, PDO::PARAM_STR);
            $r_annonce->bindValue(':id_categorie', $id_categorie, PDO::PARAM_STR);
            $r_annonce->execute();
        }
    }

    if(isset($_GET['action']) && $_GET['action'] == 'creation')
    {
        if($_POST)
        {
            $content .= '<div class="alert alert-success">L\'annonce a bien été modifiée/créée</div>';
            $req_modif_annonce = "INSERT INTO annonce(titre, description_courte, description_longue, prix, photo, pays, ville, adresse, cp, id_membre, id_photo, id_categorie) VALUES (:titre, :description_courte, :description_longue, :prix, :photo, :pays, :ville, :adresse, :cp, :id_membre, :id_photo, :id_categorie)";
            $r_annonce = $pdo->prepare($req_modif_annonce);
            $r_annonce->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
            $r_annonce->bindValue(':description_courte', $_POST['description_courte'], PDO::PARAM_STR); // le paramètre de la requête SQL, la valeur qu'on lie, le type attendu
            $r_annonce->bindValue(':description_longue', $_POST['description_longue'], PDO::PARAM_STR);
            $r_annonce->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);
            $r_annonce->bindValue(':photo', $_POST['photo'], PDO::PARAM_STR);
            $r_annonce->bindValue(':pays', $_POST['pays'], PDO::PARAM_STR);
            $r_annonce->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
            $r_annonce->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
            $r_annonce->bindValue(':cp', $_POST['cp'], PDO::PARAM_STR);
            $r_annonce->bindValue(':id_membre', $_SESSION['membre']['id_membre'], PDO::PARAM_STR);
            $r_annonce->bindValue(':id_photo', $_POST['id_photo'], PDO::PARAM_STR);
            $r_annonce->bindValue(':id_categorie', $_POST['id_categorie'], PDO::PARAM_STR);
            $r_annonce->execute(); 
        }
    }

    if(isset($_GET['action']) && ($_GET['action'] == 'modification' || $_GET['action'] == 'creation'))
    {
        $content .=
            '<form method="POST">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="id" name="id_annonce" placeholder="Id_annonce"'; if($_GET['action'] == 'modification'){ $content .= 'value="'. $id_annonce. '">';} else{$content .= '"value="">';};
        $content .='
                      </div>
                      <div class="form-group">

                        <label for="titre">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre"'; if($_GET['action'] == 'modification'){ $content .= 'value="'. $id_annonce. '">';} else{$content .= '"value="">';};
        $content .='
                      </div>
                      <div class="form-group">
                        <label for="description_courte">Description courte</label>
                        <input type="text" class="form-control" id="description_courte" name="description_courte" placeholder="Description courte"'; if($_GET['action'] == 'modification'){ $content .= 'value="'. $description_courte. '">';} else{$content .= '"value="">';};
        $content .='
                      </div>
                      <div class="form-group">
                        <label for="description_longue">Description longue</label>
                        <textarea type="text" class="form-control" id="description_longue" name="description_longue" placeholder="Description longue"'; if($_GET['action'] == 'modification'){ $content .= 'value="'. $description_longue. '">';} else{$content .= '"value="">';};
        $content .='
                        </textarea>
                      </div>
                      <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix"'; if($_GET['action'] == 'modification'){ $content .= 'value="'. $prix. '">';} else{$content .= '"value="">';};
        $content .='
                      </div>
                      <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="text" class="form-control" id="photo" name="photo" placeholder="Photo"'; if($_GET['action'] == 'modification'){ $content .= 'value="'. $photo. '">';} else{$content .= '"value="">';};

        if(isset($_GET['action']) && $_GET['action'] == 'modification')
        {
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
        }

        $content .=
            '</div>
                      <div class="form-group">
                        <label for="pays">Pays</label>
                        <input type="text" class="form-control" id="pays" name="pays" placeholder="Pays"'; if($_GET['action'] == 'modification'){ $content .= 'value="'. $pays. '">';} else{$content .= '"value="">';};
        $content .='
                      </div>
                      <div class="form-group">
                        <label for="ville">Ville</label>
                        <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville"'; if($_GET['action'] == 'modification'){ $content .= 'value="'. $ville. '">';} else{$content .= '"value="">';};
        $content .='
                      </div>
                      <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse"'; if($_GET['action'] == 'modification'){ $content .= 'value="'. $adresse. '">';} else{$content .= '"value="">';};
        $content .='
                      </div>
                      <div class="form-group">
                        <label for="cp">Code postal</label>
                        <input type="text" class="form-control" id="cp" name="cp" placeholder="Code postal"'; if($_GET['action'] == 'modification'){ $content .= 'value="'. $cp. '">';} else{$content .= '"value="">';};
        $content .='
                      </div>

                      <div class="form-group">
                        <label for="id_photo">Id_photo</label>
                        <input type="text" class="form-control" id="id_photo" name="id_photo" placeholder="Id_photo" value="">
                      </div>
                      
                      <div class="form-group">
                        <label for="id_categorie">Id_categorie</label>
                        <select name="id_categorie">
                            <option value="1">Immobilier<option>
                            <option value="2">Multimédia<option>
                            <option value="3">Véhicules<option>
                            <option value="4">Loisirs<option>
                            <option value="5">Maison<option>
                            <option value="6">Vacances<option>
                        </select>
                      </div>';

                     
        $content .='
                      </div>
                      <button type="submit" class="btn btn-default">Submit</button>
                </form>';
    }  
    
        if(isset($_GET['action']) && $_GET['action'] == 'affichage')  
    {    
        $r = $pdo->query("SELECT * FROM annonce WHERE id_membre =" .$_SESSION['membre']['id_membre']);
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
            $content .= "<td><a href=\"?action=modification&id_annonce=$ligne[id_annonce]\"><img src=\"inc/img/edit.png\"></a>";
            $content .= "<a href=\"?action=suppression&id_annonce=$ligne[id_annonce]\" OnClick=\"return(confirm('En êtes-vous certain ?'))\";><img src=\"inc/img/delete.png\"></a></td>";
            $content .= "</tr>";
        }
        $content .= "</table>";
    }

    echo  $content;  
    ?>


