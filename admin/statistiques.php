<?php
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");
$count = $pdo->query("
SELECT COUNT(note.note)
FROM membre, note
WHERE membre.id_membre = note.id_membre2
");
$requete = $pdo->query("
SELECT membre.id_membre, membre.pseudo, note.note, note.id_membre2
FROM membre, note
WHERE membre.id_membre = note.id_membre2
");

$sum = $pdo->query("
SELECT SUM(note.note)
FROM membre, note
WHERE membre.id_membre = note.id_membre2
");

echo moyenne($sum, $count);
require_once("../inc/bas.inc.php");
?>
