<?php
// Démarrage de la session
// afin de conserver l'information indiquant si c'est le premier accès
if (session_status() != PHP_SESSION_ACTIVE) session_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
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

	
	
	<title> Tomatons - Articles </title>
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
	
	<h1>Retrouvez ici notre sélection d'articles sur le jardinage</h1>
	
	
	<!--Connexion à la base de données-->
	<?php 
			
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
			$apercuArticle = substr($val['contenu_article'], 0, 150);
			?>
			
			<div id="articles">
				<ul>  
				<!-- Structure de l'affichage pour un article -->
					<li>
					<!--echo pour récupérer l'article en question-->
					<img src="<?php echo $imageArticle ; ?>" />
					
					<h3> 
						<a href="affichageArticle.php?titre=<?php echo $titreArticle ?>">
						<?php echo $titreArticle; ?></a>
					</h3>
					
					<p><?php echo $apercuArticle." ...";?><br>
					<a href="affichageArticle.php?titre=<?php echo $titreArticle ?>">Lire la suite de l'article</a>
					</p>
					</li>
				</ul>
			</div>
		
		<?php
		}
	?>


</section>


<?php
	include("footer.php"); 
?>	


</html>