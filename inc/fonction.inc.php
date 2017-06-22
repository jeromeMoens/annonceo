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

?>
