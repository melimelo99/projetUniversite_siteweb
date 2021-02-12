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

	
	
	<title> Tomatons - Ajouter administrateur </title>
</head>

<?php
	include("header.php");
?>

<!-- https://developer.mozilla.org/fr/docs/Web/HTML/Element/Input/search -->
<section>


<div class="formulairecreation">

<form action="ajoutadmin.php" method="post">

	<!-- Formulaire de remplissage des informations personnelles de l'utilisateur-->
	
	<div class="formulaire-sous-titre">Les informations personnelles </div> 
	
	<label for="nom"><span>Nom<span class="required">*</span></span>
	<input type="text" class="champ" name="nom"><br></label> 
	<br>
	
	<label for="prenom"><span>Prénom<span class="required">*</span></span>
	<input type="text" class="champ" name="prenom"><br></label>  
	<br>

	<label for="motdepasse"><span>Votre mot de passe<span class="required">*</span></span>
	<input type="password" placeholder="Veuillez saisir un mot de passe " class="champ" name="motDePasse" /><br></label>
	<br>
	
	<label for="verifmotdepasse"><span>Confirmez votre mot de passe<span class="required">*</span></span>
	<input type="password" placeholder="Veuillez confirmer votre mot de passe" class="champ" name="motDePasse2"/><br></label>
	<br>
	<!-- Si l'admin perd son mot de passe, la réponse qu'il va fournir ci-dessous, va lui permettre de le restaurer -->
	<label for="prenom"><span>Question secrète : quel est le nom de votre premier animal de compagnie ?<span class="required">*</span></span>
	<input type="text" class="champ" name="reponse"><br></label>  
	<br>
	
	
	<label><span></span><input type="submit" name="inscription" value="inscrire"></label><br>
  
</form>

</div>
	<?php 
	
	// ON VERIFIE LES DONNEES INSCRITES
	if (isset($_POST["motDePasse"]))
	{
		$motDePasse = htmlspecialchars(trim($_POST["motDePasse"]));
	}
	
	if (isset($_POST["motDePasse2"]))
	{
		$motDePasse2 = htmlspecialchars(trim($_POST["motDePasse2"]));
	}
	
	if (isset($_POST["nom"]))
	{
		$nom = htmlspecialchars(trim($_POST["nom"]));
	}
	
	if (isset($_POST["prenom"]))
	{
		$prenom = htmlspecialchars(trim($_POST["prenom"]));
	}
	
	if (isset($_POST["reponse"]))
	{
		$reponse = htmlspecialchars(trim($_POST["reponse"]));
	}

	
	
	
	if (isset($_POST["inscription"]))
	{
		if($motDePasse != $motDePasse2)
		{
			echo "Les 2 mots de passes saisis ne sont pas identiques.";     		
		}
		else
		{    
			include("fonctions.php");
			$connexion = connexion_bdd();	
			
			// ON INSERE DANS LA BASE DE DONNEES LES DONNEES DU NOUVEAU ADMINISTRATEUR 
			
			$requete = "Insert into tomatons_admin(nom_admin, mdp_admin, reponse_admin)
			VALUES (:lenom, :lemdp, :lareponse)" ; 
			
			$req = $connexion->prepare($requete); 
			$req-> execute(array(
				"lenom" => substr($prenom,0,1). "" .$nom,
				"lemdp"=>$motDePasse,
				"lareponse"=>$reponse
				));
				
			echo " L'administrateur a été ajouté"; 
		}
	}?>
</section>

<?php
	include("footer.php"); 
?>	


</html>