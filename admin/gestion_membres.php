<?php
require_once("../inc/init.inc.php");
if(!internauteEstConnecteEtEstAdmin())
{
    header("location:../connexion.php");
    exit(); // interrompt le script
}

//----------- SUPPRESSION membre ------------

if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
    $pdo->query("DELETE FROM membre WHERE id_membre='$_GET[id_membre]'");
    $content .= "<div class='validation'>Le membre n° " . $_GET['id_membre'] . " a bien été supprimé.</div>";
    $_GET['action'] = 'affichage';
}

require_once("../inc/haut.inc.php");

//------- Affichage des membres -------------

$r = $pdo->query("SELECT * FROM membre");
$content .= "<h1>Affichage des " . $r->rowCount() . " membres</h1>";
$content .= "<table border='1'><tr>";
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
        $content .= '<td>' . $valeurs . '</td>';
    }
    $content .= "<td><a href=\"?action=modification&id_membre=$ligne[id_membre]\"><img src=\"../inc/img/edit.png\"></a>";
    $content .= "<a href=\"?action=suppression&id_membre=$ligne[id_membre]\" OnClick=\"return(confirm('En êtes-vous certain ?'))\";><img src=\"../inc/img/delete.png\"></a></td>";
    $content .= "</tr>";
}
$content .= "</table>";

//----------- Modification des membres ------------------

if(isset($_GET['action']) && $_GET['action'] == 'modification')
{
    if(isset($_GET['id_membre']))
    {
        $resultat = $pdo->query("SELECT * FROM membre WHERE id_membre=$_GET[id_membre]");
        $membre_actuel = $resultat->fetch(PDO::FETCH_ASSOC);
    }
    $id_membre = isset($membre_actuel['id_membre']) ? $membre_actuel['id_membre'] : '';
    $pseudo = isset($membre_actuel['pseudo']) ? $membre_actuel['pseudo'] : '';
    $nom = isset($membre_actuel['nom']) ? $membre_actuel['nom'] : '';
    $prenom = isset($membre_actuel['prenom']) ? $membre_actuel['prenom'] : '';
    $telephone = isset($membre_actuel['telephone']) ? $membre_actuel['telephone'] : '';
    $email = isset($membre_actuel['email']) ? $membre_actuel['email'] : '';
    $civilite = isset($membre_actuel['civilite']) ? $membre_actuel['civilite'] : '';
    $statut = isset($membre_actuel['statut']) ? $membre_actuel['statut'] : '';

if($_POST)
{
    $content .= '<div class="validation">Le produit a bien été modifié/créé</div>';
        $req_modif_membre = "REPLACE INTO membre(pseudo, nom, prenom, telephone, email, civilite, statut) VALUES (:pseudo, :nom, :prenom, :telephone, :email, :civilite, :statut)";
        $r_membre = $pdo->prepare($req_modif_membre);
        $r_membre->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $r_membre->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR); // le paramètre de la requête SQL, la valeur qu'on lie, le type attendu
        $r_membre->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $r_membre->bindValue(':telephone', $_POST['telephone'], PDO::PARAM_STR);
        $r_membre->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $r_membre->bindValue(':civilite', $_POST['civilite'], PDO::PARAM_STR);
        $r_membre->bindValue(':statut', $_POST['statut'], PDO::PARAM_STR);
        $r_membre->execute();
}
$content .=
    '<form method="POST">
      <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" value="'. $pseudo .'">
      </div>
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="'. $nom .'">
      </div>
      <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom" value="'. $prenom .'">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="'. $email .'">
      </div>
      <div class="form-group">
        <label for="telephone">Téléphone</label>
        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="telephone" value="'. $telephone .'">
      </div>
      <div class="form-group">
      <label for="civilite">Civilité</label>
      <select class="form-control" id="civilite" name="civilite">
        <option value="m">Homme</option>
        <option value="f">Femme</option>
      </select>
      </div>
      <div class="form-group">
      <label for="statut">Statut</label>
      <select class="form-control" id="statut" name="statut">
        <option value="0">Membre</option>
        <option value="1">Admin</option>
      </select>
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>';
}
echo $content;
require_once("../inc/bas.inc.php");
?>
