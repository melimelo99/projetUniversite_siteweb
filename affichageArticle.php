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

	
	
	<title> Tomatons - Article n° </title>
</head>

<?php
	include("header.php");
?>


<?php
	//Connexion à la base de données pour récupérer les informations qui seront affichées dans la page
	include("fonctions.php");
	$connexion = connexion_bdd();
?>



<section>
	<?php 
	// On récupère les informations depuis la page d'accueil sur l'annonce sélectionnée 
		$titreSelect = $_GET["titre"];
	//Connexion à la base de données
		$requete = $connexion-> prepare("SELECT * FROM tomatons_articles");
		$requete -> execute();
		$tab_articles = array();
					
		while ($donnees = $requete -> fetch())
		{
			$tab_articles[$donnees["id_article"]] = array("titre_article" => $donnees["titre_article"], "image_article" => 
			$donnees["image_article"], "auteur_article" => $donnees["auteur_article"], "contenu_article" => $donnees["contenu_article"], 
			"source_article" => $donnees["source_article"], "lien_article" => $donnees["lien_article"]);
		}
			
	// boucle for each pour récupérer les données une fois celles-ci stockées dans un tableau
		foreach($tab_articles as $cle => $val)
		{
			$titreArticle = $val['titre_article'];
			$imageArticle = $val['image_article'];
			$contenuArticle = $val['contenu_article'];
			$auteurArticle = $val['auteur_article'];
			$sourceArticle = $val['source_article'];
			$lienArticle = $val['lien_article'];
			//Contrôle afin de vérifier si on se trouve bien sur l'article demandé
			if ($titreSelect == $titreArticle)
			{
			?>

				<!--Affichage en HTML-->
				<h1><?php echo $titreArticle ?></h1>

				<!--Image récupérée depuis la base de données-->
				<img src="<?php echo $imageArticle?>" class="img-center">

				<!--Contenu de l'article-->
				<p>
				
				<?php echo $contenuArticle ?>

				</p>
	



				<h2>Les références : </h2>

				<div>Cet article a été rédigé par <?php echo $auteurArticle?> pour le site <?php echo $sourceArticle?>.</div>

				<div>Lire l'article complet <a href="<?php echo $lienArticle?>" target="_blank">ici</a>.</div>


			
			<?php
			}
		}
	?>
	


	
	
	
</section>




<?php
	include("footer.php"); 
?>	


</html>