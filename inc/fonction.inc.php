<?php
function debug($var, $mode = 1)
{
	$trace = debug_backtrace();
	$trace = array_shift($trace);
	echo "<strong>debug demandé dans le fichier $trace[file] en ligne : $trace[line]</strong>";
	// la fonction debug_backtrace() renvoie le fichier dans lequel nous l'executons ainsi que le numéro de la ligne
	// la fonction array_shift() supprime le premier élément du tableau pour le stocker dans une variable

	echo '<pre>'; print_r($trace); echo '</pre>';
	if($mode == 1)
	{
		echo '<pre>'; print_r($var); echo '</pre>';
	}
	else
	{
		echo '<pre>'; var_dump($var); echo '</pre>';
	}	
}


/*
fonction prédéfinie pour rechercher 
$email_check = preg_match("/^[a-z0-9_\.-]+@([a-z0-9]+([\-]+[a-z0-9]+)*\.)+[a-z]{2,7}$/i", $mail);
 
if($email_check != 1){
$message="Merci d'entrer une email valide.";
}
*/

//------------------------------------------------------
function internauteEstConnecte() // cette fonction m'indique si le membre est connecté
{
	if(!isset($_SESSION['membre']))// si la session "membre" est non définie(elle ne peut être que définie si nous sommes passés par la page de connexion avec le bon mot de passe)
	{
		return false;
	}
	else
	{
		return true;
	}
}
//-------------------------------------------------------
function internauteEstConnecteEtEstAdmin()// cette fonction m'indique si le membre est admin
{
	if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1)// si la session du membre est definie , nous regardons si il est admin, si c'est le cas, nous retournons true
	{
		return true;
	}
	else
	{
		return false;
	}
}

//----------------- PANIER ----------------

function creationDuPanier()
{
    if(!isset($_SESSION['panier']))
    {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['titre'] = array();
        $_SESSION['panier']['id_produit'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();
    }
}
// On ne stocke jamais les informations du panier en BDD, 90% des paniers n'aboutissent jamais. On crée donc un espace directement dans le fichier SESSION.

function ajouterProduitDansPanier($titre, $id_produit, $quantite, $prix)
{
    creationDuPanier();
    // nous devons savoir si l'id_produit que l'on souhaite ajouter est déjà présent dans la session du panier ou non

    $position_produit = array_search($id_produit, $_SESSION['panier']['id_produit']); // retourne un chiffre si le produit existe

    if($position_produit !== false) // si le produit est déjà présent dans le panier
    {
    	$_SESSION['panier']['quantite'][$position_produit] += $quantite; // nous allons précisement à l'indice de ce produit et nous ajoutons la nouvelle quantité (+= ajoute la quantité sans la remplacer)
    }
    else // sinon si l'id_produit n'existe pas dans le panier, on ajoute l'id_produit du produit dans un nouvel indice du tableau. Les [] permettent de mettre à l'indice suivant
    {
    	$_SESSION['panier']['titre'][] = $titre;
    	$_SESSION['panier']['id_produit'][] = $id_produit;
    	$_SESSION['panier']['quantite'][] = $quantite;
    	$_SESSION['panier']['prix'][] = $prix;
    }
}

//------------------------------------------------------------------------

function montantTotal()
{
	$total = 0;
	for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) // tnat que i est inférieur au nombre de produit dans le panier
	{
		$total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i]; // si on multiplie la quantité par le prix, sans pour remplacer pour autant la dernière valeur contenue dans la variable $total (+= permet d'ajouter au montant sans remplacer)
	}
	return round($total,2);	// prix total pour tous les produits. 2 chiffres après la virgule
}

//------------------------------------------------------------------------

function retirerProduitDuPanier($id_produit_a_supprimer)
{
	$position_produit = array_search($id_produit_a_supprimer, $_SESSION['panier']['id_produit']);
	if($position_produit !== false)
	{
		array_splice($_SESSION['panier']['titre'],$position_produit,1);
		array_splice($_SESSION['panier']['id_produit'],$position_produit,1);
		array_splice($_SESSION['panier']['quantite'],$position_produit,1);
		array_splice($_SESSION['panier']['prix'],$position_produit,1);
	}	
}

?>