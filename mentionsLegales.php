<?php
// Démarrage de la session
// afin de conserver l'information indiquant si c'est le premier accès
if (session_status() != PHP_SESSION_ACTIVE) session_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
include("INCLUDE\fonctions.php");
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

	
	
	<title> Tomatons - Mentions Légales </title>
</head>

<?php
	include("header.php");
?>

<section>
<p>Conformément aux dispositions de la loi n° 2004-575 du 21 juin 2004 pour la confiance en l'économie numérique, 
il est précisé aux utilisateurs du site Tomatons l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi.</p>

<h2>Edition du site</h2>
<p>
Le site Tomatons est édité par deux étudiants du Master <a href="http://pise.info/" target="_blank">PISE</a> de l'Université Paris Diderot, 
dans le cadre d'un projet universitaire. Vous pouvez en apprendre plus sur nous <a href="presentation.php">ici</a> ou directement 
sur nos profils Linkedin, respectivement <a href="https://www.linkedin.com/in/melike-kara-800baa110/" target="_blank">Melike KARA</a> 
et <a href="https://www.linkedin.com/in/ndriana-razafitrimo-362685b5/" target="_blank">Ndriana RAZAFITRIMO</a>. 
</p>

<h2>Responsables de publication</h2>
<p>Aurélie JALLUT</p>
<p>Olivier LABONNE </p>
<p>Isidora VIDAL</p>

<h2>Hébergeur</h2>
<p>Le site Tomatons est hébergé par la société At Space.</p>
<p>Le stockage des données personnelles des Utilisateurs (fictifs) est stocké dans les clusters de la société At Space (Etats-Unis).</p>

<h2>Nous contacter</h2>
<p>Le site internet étant édité dans le cadre d'un projet universitaire, l'édition et le suivi de celui-ci seront a priori limités dans le temps. 
Vous pouvez toutefois nous contacter par le biais des liens susmentionnés ou via notre <a href="contact.php">formulaire de contact</a>.
</p>


<p>
Conformément aux dispositions de la loi 78-17 du 6 janvier 1978 modifiée, l’Utilisateur dispose d'un droit d'accès, 
de modification et de suppression des informations collectées. 
Pour exercer ce droit, il reviendra à l’Utilisateur de contacter les administrateurs via le <a href="contact.php">formulaire de contact</a>.
</p>




  





</section>


<?php
	include("footer.php"); 
?>	


</html>
