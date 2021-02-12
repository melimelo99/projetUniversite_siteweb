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

	
	
	<title> Tomatons - Présentation de Tomatons</title>
</head>

<?php
	include("header.php");
?>

<section>

<h1>Présentation des étudiants</h1>


<h2>Melike KARA</h2>

<p>

</p>


<h2>Ndriana RAZAFITRIMO</h2>

<p>
Après un baccalauréat ES, j'ai fait le choix de me tourner vers des études juridiques afin de disposer d'une solide culture générale, et dans l'objectif,
à terme, de me spécialiser dans le droit international. 
A l'issue de ma licence en Droit, j'ai effectué un Master en Science politique afin de compléter mon parcours, appronfondir ma culture générale et 
étendre mon horizon professionnel. Ce Master a été l'occasion d'effectuer des stages professionnels ayant un attrait peu ou proche de l'informatique 
et du numérique. En définitive, ce sera un stage au sein du Ministère de l'Economie qui me fera tomber pour l'informatique et le reste n'est que de l'histoire...

</p>


<h1>Le projet Tomatons</h1>

<h2>Genèse du projet</h2>
<p>
Dans le cadre de notre Master, nous sommes amenés à réaliser différents projets à visée professionnelle afin de mettre en pratique nos enseignements 
en sus de l'apprentissage : 
<ul>
	<li>Mise en place d'une solution de gestion de base de données à une problématique métiers</li>
	<li>Création d'un applicatif en langage C</li>
	<li>Réalisation d'un site web statique et dynamique</li>
	<li>Création d'un applicatif en langage C#</li>
	<li>Création d'un applicatif en langage Java</li>
</ul>
</p>

<p>
Au moment du choix du sujet pour notre site web, notre binôme a opté pour l'objet du présent site en raison d'une part, des contraintes techniques 
que celui-ci suppose, et de l'autre en raison du sujet qui représente celui d'un site commercial tel que Leboncoin ou Airbnb, soit un site représentant
un réel intérêt professionnel. 
</p>



<h2>L'objectif du site</h2>
<p>
L'objectif du site est simple : créer un lien social entre habitants de Paris, et dans une moindre mesure de la petite couronne, qui partagent un 
intérêt pour le jardinage. 
</p>
<p>
L'idée est de permettre à des personnes qui sont propriétaires d'un balcon ou d'un jardin et qui ne disposent pas du temps suffisant pour s'en occuper
de les mettres à la "location" auprès de particulier. Si cette location peut prendre une forme pécuniaire, l'idée du site et de fonder la location sur 
du troc, un échange de bons procédés ou tout simplement pour créer du lien social. 
</p>


<h2>L'après-PISE ?</h2>
<p>
L'idée du site pouvant être exploitée ultérieurement, nous ne sommes pas fermés à l'option de poursuivre ce projet à l'issue de nos études...
</p>

<p> Pour nous contacter, à ce sujet ou sur un autre, vous disposer d'un formulaire de contact.</p>

 


</section>


<?php
	include("footer.php"); 
?>	


</html>
