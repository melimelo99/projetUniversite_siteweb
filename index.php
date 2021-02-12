<?php session_start(); 

include("fonctions.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta name = "language" content ="fr"/>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<!--<meta charset="UTF-8"/>-->
	<meta name = "description" content="site de tomatons"/>
	<meta name ="mots-clés" content ="échange, jardinage, ptop"/>
	
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">    -->
	<link href="styles.css" rel="stylesheet" />
	<link href="style-print.css" rel="stylesheet" media="print" />
	<title> Bienvenue sur Tomatons </title>
</head>

<?php
	include("header.php");
?>


<section>


	<h1>Bienvenue sur le site Tomatons</h1>

	<!-- <p>
	Tomatons est un site qui met en relation des particuliers qui souhaitent mettre à disposition tout ou partie de leur jardin, terrasse ou balcon...
	L'enjeu ? Réunir des personnes passionnées de jardinage, mettre en relation des personnes qui cherchent à jardiner avec d'autres qui ne peuvent pas 
	mais disposent de moyens matériels, les raisons sont infinies...	
	</p>
	<p>
	Qu'est-ce qu'il y a à la clé ? C'est à vous de décider !
	</p>
	
	-->
	<p><b>
	SITE EN COURS DE MAINTENANCE
	</p></b>
	
	
	
	<h2> Les annonces </h2>
	
	
	<!--Formulaire de filtre de la recherche sur l'écran principal-->
<!--	<form id = "recherche_arrondiss" action="index.php" method="post">  
	
	<label for="recherche_arrondiss"><span>Veuillez sélectionner un arrondissement pour filtrer votre recherche</span>
		<select class="champ" name="recherche_arrondiss" >
			<option value="1"> Paris 1e </option>
			<option value="2"> Paris 2e </option>
			<option value="3"> Paris 3e </option>
			<option value="4"> Paris 4e </option>
			<option value="5"> Paris 5e </option>
			<option value="6"> Paris 6e </option>
			<option value="7"> Paris 7e </option>
			<option value="8"> Paris 8e </option>
			<option value="9"> Paris 9e </option>
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
		</select>
		<input type="submit" name="bouton_recherche" Value ="Filtrer"/>
	</form> -->
	
	<p> Voici, selon l'arrondissement sélectionné, la liste des espaces disponibles :<br>
	<i>Cliquez sur le titre d'une annonce pour y accéder</i></p>
	
	<?php 
		//Test sur la connexion
		/*if (isset ($_SESSION["tab_loue"])) 
			{ 
				var_dump($_SESSION["tab_loue"]);
			}*/
	?>
		

	
	
	<?php
	
	//Connexion à la base de données
	$connexion = connexion_bdd();
	
	
	//Requête pour récupérer les données
	$requete = $connexion-> prepare("SELECT * FROM tomatons_annonces");
	$requete -> execute();
	$tab_annonces = array();
	
	
	//"Rangement" des données dans un tableau
	while ($donnees = $requete -> fetch())
	{
		$tab_annonces[$donnees["id_annonce"]] = array("titre_annonce" => $donnees["titre_annonce"], 
		"image_annonce" => $donnees["image_annonce"], "adresse_annonce" => $donnees["adresse_annonce"], 
		"arrondiss_annonce" => $donnees["arrondiss_annonce"], "descr_annonce" => $donnees["descr_annonce"]);
	}
	
	//On récupère les données du tableau pour l'affichage
	foreach($tab_annonces as $cle => $val)
	{
		/*foreach ($val as $cle2 => $val2)
		{*/
			//echo $val2."<br>";	
			
			$titreAnnonce = $val['titre_annonce'];
			$adresseAnnonce = $val['adresse_annonce'];
			$imageAnnonce = $val['image_annonce'];
			$arrondissAnnonce = $val['arrondiss_annonce'];
			
			
			?>
			<div id="annonces">
			<ul>  
			<!-- Structure de l'affichage pour un article -->
				<li>
				<!--echo pour récupérer l'article en question-->
				<img src="<?php echo $imageAnnonce; ?>" />
				
				<h3>
					<a href="annonce.php?adresse=<?php echo $adresseAnnonce ?>&amp;titre= <?php echo $titreAnnonce?>">
					<?php echo $titreAnnonce ;?>
					</a>
				</h3>
				
				<p> <strong><?php echo $adresseAnnonce.", 750".$arrondissAnnonce?></strong></p>
				
				<p> <a href="annonce.php?adresse=<?php echo $adresseAnnonce ?>&amp;titre= <?php echo $titreAnnonce?>"> En savoir plus </a> </p>
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