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

	
	
	<title> Tomatons - Ajouter un article </title>
</head>

<?php
	include("header.php");
?>

<section>


<div class="formulairearticle">

<form method="post" action= "ajout_article.php" enctype="multipart/form-data">

	<div class="formulaire-sous-titre"> Ajouter un article <br/> </div> 
	
	<label for="titre"><span> Titre <span class="required">*</span></span>
	<input type="text" class="champ" name="titre_article"><br></label>
	<br>
	
	<label for="image_annonce"><span>Sélectionner une image<span class="required">*</span></span>
		<input type="file" class="champ" name="image_article" value="url"/> <br></label>
		<br>
	
	<label for="auteur"><span> Auteur <span class="required">*</span></span>
	<input type="text" class="champ" name="auteur_article"><br></label>
	<br>
	
	<label for="contenu"><span> Contenu de l'article <span class="required">*</span></span>
	<textarea name="contenu_article" class="textfield"></textarea></label>
	<br>
	<br>
	
	<label for="source"><span> Source <span class="required">*</span></span>
	<textarea name="source_article" class="textfield"></textarea></label>
	<br>
	<br>
	
	<label for="lien"><span> Lien de l'article <span class="required">*</span></span>
	<input type ="text"  name="lien_article" class="champ"></textarea></label>
	<br>
	
	<label><span></span><input type="submit" name="publier" value="Publier"></label><br>
</div>

	<?php 
		if (isset($_POST["publier"]))
		{
			$titre = htmlspecialchars(trim($_POST['titre_article']));
			if (isset($_FILES["image_article"]))
			{
				move_uploaded_file($_FILES["image_article"]["tmp_name"], "images/images_articles/".basename($_FILES["image_article"]["name"]));
				$image = ($_FILES["image_article"]["name"]);
			}
			$auteur = htmlspecialchars(trim($_POST['auteur_article']));
			if (isset($_POST["contenu_article"]))
			{
				$contenu = htmlspecialchars(trim($_POST['contenu_article']));
			}
			$source = htmlspecialchars(trim($_POST['source_article']));
			$lien = htmlspecialchars(trim($_POST['lien_article']));
			
			include("fonctions.php");
			$connexion = connexion_bdd();	
			
			// L'ADMINISTRATEUR AJOUTE DES ARTICLES SUR LE SITE, IL LES FAUT LES FAIRE AFFICHER GRACE A L'INSERTION DANS LA BASE DE DONNEES
			
			$requete = "Insert into tomatons_articles(titre_article, image_article, auteur_article, contenu_article, source_article, lien_article)
			VALUES (:letitre, :limage, :lauteur, :lecontenu, :lasource, :lelien)" ; 
			
			$req = $connexion->prepare($requete); 
			$req-> execute(array(
				"letitre" => $titre,
				"limage" => "images/images_articles/" . $image,
				"lauteur" =>$auteur,
				"lecontenu"=>$contenu,
				"lasource" => $source,
				"lelien"=>$lien,
					));
					
			echo "Votre article a été ajouté";
		}
		
		 

	?>



</form>



</div>


</section>


<?php
	include("footer.php"); 
?>	


</html>