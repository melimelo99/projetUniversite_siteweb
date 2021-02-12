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

	
	
	<title> Tomatons - Veuillez saisir votre annonce </title>
</head>

<?php
	include("header.php");
?>

<section>


<div class="formulairecreation">

	<form action="ajoutannonce.php" method="post" enctype="multipart/form-data">

		
		<h2>Votre annonce :</h2>
		
		<label for="titreAnnonce"><span>Titre de l'annonce <span class="required">*</span></span>
		<input type="text" class="champ" name="titre_annonce"><br></label>
		<br>
		
		<label for="adresse"><span>Adresse du bien <span class="required">*</span></span>
		<input type="text" class="champ" name="adresse_annonce"><br></label>
		<br>
		
		<label for="arrondissement"><span>Sélectionnez l'arrondissement<span class="required">*</span></span>
		<select id="arrondissement" name="arrondiss_annonce" class="champ">
			<option value="01"> Paris 1e </option>
			<option value="02"> Paris 2e </option>
			<option value="03"> Paris 3e </option>
			<option value="04"> Paris 4e </option>
			<option value="05"> Paris 5e </option>
			<option value="06"> Paris 6e </option>
			<option value="07"> Paris 7e </option>
			<option value="08"> Paris 8e </option>
			<option value="09"> Paris 9e </option>
			<option value="10"> Paris 10e </option>
			<option value="11"> Paris 11e </option>
			<option value="12"> Paris 12e </option>
			<option value="13"> Paris 13e </option>
			<option value="14"> Paris 14e </option>
			<option value="15"> Paris 15e </option>
			<option value="16"> Paris 16e </option>
			<option value="17"> Paris 17e </option>
			<option value="18"> Paris 18e </option>
			<option value="19"> Paris 19e </option>
			<option value="20"> Paris 20e </option>
		</select><br></label>
		<br>
		
		<label for="description"><span> Description du bien <span class="required">*</span></span>
		<textarea name="descr_annonce" class="textfield"></textarea></label>
		<br>
		<br>
		
		<label for="image_annonce"><span>Sélectionner une image<span class="required">*</span></span>
		<input type="file" class="champ" name="image_annonce" value="url"/> <br></label>
		<br>
		
		<label for="mail"><span>Entrez les coordonnées par lesquelles vous voulez être contacté (mail/portable)<span class="required">*</span></span>
		<input type="text" class="champ" name="mail"><br></label>
		<br>
		
		<label><span></span><input type="submit" name="soumettre" value="Publier votre annonce"></label><br>
		

	</form>

</div>

	<?php // faire variable session pour aller chercher le mail et le numéro de téléphone du loueurs pour pouvoir l'afficher dans son annonce s'il le veut (radiobutton)
		if (isset($_POST["soumettre"]) /*&& !empty($_POST["titre_annonce"]) && !empty($_POST["adresse_annonce"]) && !empty($_POST["arrondiss_annonce"]) && !empty($_POST["descr_annonce"]) && !empty($_FILES["image_annonce"]) && !empty($_POST["mail"])*/)
		{
			$titre = htmlspecialchars(trim($_POST['titre_annonce']));

			if (isset($_FILES["image_annonce"]))
			{
				move_uploaded_file($_FILES["image_annonce"]["tmp_name"], "upload/".basename($_FILES["image_annonce"]["name"]));
				$image = ($_FILES["image_annonce"]["name"]);
			}
			$adresse = htmlspecialchars(trim($_POST['adresse_annonce']));
			$arrondiss = htmlspecialchars(trim($_POST['arrondiss_annonce']));
			$descr = htmlspecialchars(trim($_POST['descr_annonce']));
			$contact = htmlspecialchars(trim($_POST['mail']));
			
			
			include("fonctions.php");
			$connexion = connexion_bdd();	
			
			// ON INSERE L'ANNONCE DANS LA BASE DE DONNEES AFIN DE POUVOIR L'AFFICHER ENSUITE DANS LA RUBRIQUE ACCUEIL
			
			
			$requete = "INSERT INTO tomatons_annonces(titre_annonce, image_annonce, adresse_annonce, arrondiss_annonce, descr_annonce, choixcontact)
			VALUES (:letitre, :limage, :ladresse, :larrondiss, :ladescr, :choixcontact)" ; 
			
			$req = $connexion->prepare($requete); 
			$req-> execute(array(
				"letitre" => $titre,
				"limage" => "upload/" . $image,
				"ladresse" =>$adresse,
				"larrondiss"=>$arrondiss,
				"ladescr" => $descr,
				"choixcontact" => $contact
				));
	
				
			echo "Votre annonce a été publiée, pour revenir à votre espace"?> <a href=espacepersonnel.php> Cliquez ici </a> <?php ;
		}
		else 
		{
			echo " Veuillez remplir tous les champs. <br>";
		}

	?>



</section>


<?php
	include("footer.php"); 
?>	


</html>
