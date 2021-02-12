<?php

session_start(); 

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

	
	
	<title> Tomatons - Mon espace personnel </title>
</head>

<?php
	include("header.php");
?>

<section>

<!--Division de la page en plusieurs onglets pour les différents espace-->

	<h1>Mon espace personnel</h1>

	<!--Création d'une div spéciale pour l'affichage-->

	<div class="vertical-tab">


		<!--Section d'ajout d'une annonce-->
		<section id="section1">
			<input type="radio" name="sections" id="option1" checked>
			<label for="option1">Ajouter une annonce</label>
			<article>
			<h2>Information sur l'ajout d'une annonce</h2>
				<p>
				L'ajout d'une annonce engage uniquement la responsabilité de son auteur, et non celle du site Tomatons.
				</p>
				<p>
				La responsabilité du site ne peut être engagée en cas d'inexactitude des informations saisies. De façon similaire, 
				restez vigilants lors de la prise de contact avec des loueurs potentiels.
				</p>				
				<p>
				Veuillez suivre ce <a href="ajoutannonce.php"><strong>lien</strong></a> pour ajouter une annonce. 
				</p>
			</article>
		</section>

		<!--Section de modification des coordonnées et mot de passe-->
		<section id="section3">
			<input type="radio" name="sections" id="option3">
			<label for="option3">Mes coordonnées et mon mot de passe</label>
			
			<article>
			<h2>Vos données personnelles</h2>
			<p>
				<?php	// AFFICHER DONNEES PERSONNELS DU LOUEUR 
					if (isset($_SESSION["id_loueur"])){ echo "Identifiant :" . $_SESSION["id_loueur"] ."<br>";}
					if (isset($_SESSION["pseudo_loueur"])){ echo "Pseudo :" . $_SESSION["pseudo_loueur"]."<br>";}
					if (isset($_SESSION["nom_loueur"])){ echo "Nom : " .$_SESSION["nom_loueur"]."<br>";}
					if (isset($_SESSION["prenom_loueur"])){ echo "Prénom :" .$_SESSION["prenom_loueur"]."<br>";}
					if (isset($_SESSION["tel_loueur"])){ echo "Téléphone :" .$_SESSION["tel_loueur"]."<br>";}
					if (isset($_SESSION["mail_loueur"])){ echo "Mail :" .$_SESSION["mail_loueur"]."<br>";}
					if (isset($_SESSION["adress_loueur"])){ echo "Adresse :" .$_SESSION["adress_loueur"]."<br>";}
					if (isset($_SESSION["code_loueur"])){ echo "Code postal :" .$_SESSION["code_loueur"]."<br>";}

				?>
			</p>

			</article>
		</section>



	</div>




</section>

<?php
	include("footer.php"); 
?>	


</html>