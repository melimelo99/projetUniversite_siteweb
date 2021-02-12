<?php
// Démarrage de la session
// afin de conserver l'information indiquant si c'est le premier accès
if (session_status() != PHP_SESSION_ACTIVE) session_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include("fonctions.php");	
?>


<!DOCTYPE html>
<html>
<head>
	<meta name = "language" content ="fr"/>
	<meta charset="UTF-8"/>
	<meta name = "description" content="site de tomatons"/>
	<meta name ="mots-clés" content ="échange, jardinage, ptop"/>
	
	
	<!--J'ai ajouté la méta suivante pour le responsive à vérifier si ça fonctionne-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
	<!--Inclusion des feuilles de style-->	
	<link href="styles.css" rel="stylesheet" />
	<link href="style-print.css" rel="stylesheet" media="print" />

	
	
	<title> Tomatons - Espace administrateur </title>
</head>

<?php
	include("header.php");
?>

<section>

<!--  Ajouter un administrateur -->

<p> <a href="ajoutadmin.php"> AJOUTER UN ADMINISTRATEUR </a></p>


<!--  Loueurs -->

<p> <a href="admin_gere_loueurs.php"> GERER LES UTILISATEURS </a></p>


<!--  Suppression d'une annonce  -->

<p> <a href="admin_gere_annonces.php"> GERER LES ANNONCES </a></p>


<!--  Ajouter un article   -->

<p> <a href="ajout_article.php"> AJOUTER UN ARTICLE </a></p>


<!--  Suppression articles  -->

<p> <a href="admin_gere_articles.php"> SUPPRIMER DES ARTICLES </a></p>


<!--  Récupération des informations du formulaire de contact  -->

<p> <a href="admin_gere_contact.php"> VOIR LES MESSAGES </a></p>


</section>


<?php
	include("footer.php"); 
?>	


</html>