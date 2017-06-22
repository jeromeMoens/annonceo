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


//-------------------------------------

function internauteEstConnecte()
{
    if(!isset($_SESSION['membre'])) // si la session "membre" est non définie (elle ne peut être définie que si nous sommes passés par la page de connexion avec le bon mot de passe)
    {
        return false;
    }
    else
    {
        return true;
    }
}

//-------------------------------------

function internauteEstConnecteEtEstAdmin() // cette fonction m'indique si le membre est admin
{
    if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) // si la section du membre est définie, nous regardons s'il est admin, si c'est le cas, nous retournons true
    {
        return true;
    }
    else
    {
        return false;
    }
}

?>



