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

	
	
	<title> Tomatons - Annonces </title>
</head>

<?php
	include("header.php");
?>



<section>
	<?php
	// On récupère les informations depuis la page d'accueil sur l'annonce sélectionnée 
	$adresseSelect = $_GET["adresse"];
	$titreSelect = $_GET["titre"];
	
	
	//Connexion à la base de données
	include("fonctions.php");
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
		"arrondiss_annonce" => $donnees["arrondiss_annonce"], "descr_annonce" => $donnees["descr_annonce"],
		"choixcontact"=>$donnees["choixcontact"]);
	}
		
	// DANS LA BASE DE DONNEES FAIRE CHEMIN RELATIF POUR L'IMAGE_ANNONCE
	
	//On récupère les données du tableau pour l'affichage
	foreach($tab_annonces as $cle => $val)
	{
		$titreAnnonce = $val['titre_annonce'];
		$adresseAnnonce = $val['adresse_annonce'];
		$arrondissAnnonce = $val['arrondiss_annonce'];
		$imageAnnonce = $val['image_annonce'];
		$texteAnnonce = $val['descr_annonce'];
		$contact = $val['choixcontact'];
		
		
		
		if ($adresseAnnonce == $adresseSelect)
		{?>
				
			<!---------------------------->
			<!-- Affichage de l'annonce -->
			<!---------------------------->


			<h1><?php echo $titreAnnonce; ?> </h1>


			<!--Image récupérée depuis la base de données-->
			<img src="<?php echo $imageAnnonce; ?>" class="img-center">

			<!--Adresse-->
			<div id="adresse"> L'adresse : <?php echo $adresseAnnonce.", 750".$arrondissAnnonce; ?> </div>


			<!--Description de l'annonce-->
			<p>

				<?php echo $texteAnnonce; ?> 

			</p>


			<h2>Contacts</h2>

			<?php echo $contact;?>
		
		
		<?php
		}
	}
	?>
	

		
</section>




<?php
	include("footer.php"); 
?>	



</html>