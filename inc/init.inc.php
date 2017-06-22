<?php

//-------------------- CONNECTION A LA BDD
$pdo = new PDO('mysql:host=localhost;dbname=site','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


//-------------------- DEMARRAGE DE SESSION
session_start();


//-------------------- CHEMIN
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/php/site_boutique/"); // chemin physique du site
/*echo RACINE_SITE;
echo '<pre>'; print_r($_SERVER); echo '</pre>';*/
define("URL", 'http://localhost/php/site_boutique/');


//-------------------- DECLARATION DE VARIABLE
$content = ''; // variable initialisée à vide qui permettra de contenir tous les différents messages d'alertes. Elle sera disponible à tout moment. Pratique pour un affichage global (permet d'allégé le code et le garder claire)


//-------------------- INCLUSIONS DES FONCTIONS
require_once('fonction.inc.php');

?>