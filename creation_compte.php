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

	
	
	<title> Tomatons - Création compte </title>
</head>

<?php
	include("header.php");
?>

<!-- https://developer.mozilla.org/fr/docs/Web/HTML/Element/Input/search -->
<section>


<div class="formulairecreation">

<form action="creation_compte.php" method="post">
	<!-- <div class="formulaire-sous-titre">Vous souhaitez : </div> 
	Ajout d'une div pour que les éléments du choix soient disponible sur la même ligne
	<div>
	<input type="radio" id="loueur"
		name="reponse" value="loueur">
	<label for="contactChoice1">Mettre en location un espace de jardinage</label>
	<input type="radio" id="utilisateur"
		name="reponse" value="utilisateur">
	<label for="utilisateur">Louer un espace de jardinage</label>
	</div>
	<br>-->
	
	<!-- Formulaire de remplissage des informations personnelles de l'utilisateur-->
	
	<div class="formulaire-sous-titre">Vos informations personnelles </div> 
	
	
	
	<label for="nom"><span>Nom<span class="required">*</span></span>
	<input type="text" class="champ" name="nom"><br></label> 
	<br>
	
	<label for="prenom"><span>Prénom<span class="required">*</span></span>
	<input type="text" class="champ" name="prenom"><br></label>  
	<br>
	
	
	<label for="pseudo"><span>Identifiant<span class="required">*</span></span>
	<input type="pseudo" class="champ" name="pseudo"><br></label>
	<br>
	
	<label for="adresse"><span>Adresse<span class="required">*</span></span>
	<input type="text" class="champ" name="adresse"><br></label>
	<br>
	
	<label for="arrondissement"><span>Arrondissement<span class="required">*</span></span>
	<select id="arrondissement" name="arrondissement" class="champ">
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
	
	<label for="telephone"><span>Numéro de téléphone portable<span class="required">*</span></span>
	<input type="telephone" class="champ" name="telephone"><br></label>
	<br>
	
	<label for="mail"><span>Adresse électronique<span class="required">*</span></span>
	<input type="email" class="champ" name="mail"><br></label>
	<br>
	
	
	<label for="motdepasse"><span>Votre mot de passe<span class="required">*</span></span>
	<input minlength="8" type="password" placeholder="Veuillez saisir un mot de passe (8 caractères min.)" class="champ" name="motDePasse" /><br></label>
	<br>
	
	<label for="verifmotdepasse"><span>Confirmez votre mot de passe<span class="required">*</span></span>
	<input minlength="8" type="password" placeholder="Veuillez confirmer votre mot de passe" class="champ" name="motDePasse2"/><br></label>
	<br>
	
	
	<label><span></span><input type="submit" name="inscription" value="S'inscrire"></label><br>
  
</form>
<!--Voir si une fois que la connexion a été effectuée, où l'utilisateur est réorienté etc.-->

<?php
// FAIRE VERIF IDENTIFIANT 
	
	// Traitement des informations du formulaire 

	if(isset($_POST['inscription']))								// faire vérif sur numéro de téléphone
	{
		$nom = htmlspecialchars(trim($_POST['nom']));
		$prenom = htmlspecialchars(trim($_POST['prenom']));
		$adresse = htmlspecialchars(trim($_POST['adresse']));
		$telephone = htmlspecialchars(trim($_POST['telephone']));
		$mail = htmlspecialchars(trim($_POST['mail']));
		$pseudo = htmlspecialchars(trim($_POST['pseudo']));
		
		if (isset($_POST['motDePasse'])){
			$motDePasse = htmlspecialchars(trim($_POST['motDePasse']));
		}
		
		if (isset($_POST['motDePasse2'])){
			$motDePasse2 = htmlspecialchars(trim($_POST['motDePasse2']));
		}

		$arrondissement = htmlspecialchars(trim($_POST['arrondissement']));
		$cp = "750" . $arrondissement;
		

		// ON ENVOIE LE MAIL INSCRIT, POUR VERIFIER SI LE MAIL N'EST PAS DEJA DANS LA BASE DE DONNNES, TABLE COORDONN_LOUEURS
		$mailUnique = VerifMail(htmlspecialchars($_POST['mail']));
		

		//Contrôles de saisie des données du formulaire
		if (filter_var($mail, FILTER_VALIDATE_EMAIL) == false)
		{
			echo "L'adresse mail saisie est incorrecte.";
		}
		else if(strlen($motDePasse)<8)
		{
			echo "Votre mot de passe est trop court (8 caractères minimum).";     		
		}
		else if($motDePasse != $motDePasse2)
		{
			echo "Les 2 mots de passes saisis ne sont pas identiques.";     		
		}
		else if ($mailUnique == false)
		{
			echo "Un compte existe déjà avec cette adresse e-mail";
		}
		else
		{    
			//APPEL DE LA FONCTION DE CONNEXION
			$connexion = connexion_bdd();	
			
			// REQUETE SQL POUR INSERER DANS LA BASE DE DONNEES LES DONNEES INSCRITES DANS LE FORMULAIRE
			$requete = "Insert into coordonn_loueurs(pseudo_loue, nom_loue, prenom_loue, tel_loue, mail_loue, adress_loue, code_loue, arrondiss_loue, mdp_loue)
			VALUES (:lidentifiant, :lenom, :leprenom, :letelephone, :lemail, :ladresse, :lecp, :larrondissement, :lemotdepasse)" ; 
			
			$req = $connexion->prepare($requete); 
			$req-> execute(array(
				"lidentifiant" => $pseudo,
				"lenom" => $nom,
				"leprenom" =>$prenom,
				"letelephone"=>$telephone,
				"lemail" => $mail,
				"ladresse"=>$adresse,
				"lecp"=>$cp,
				"larrondissement"=>$arrondissement,
				"lemotdepasse"=>$motDePasse));
			
			// REDIRECTION PAR UN CLIQUE SUR LE LIEN POUR ALLER SE CONNECTER APRES L'INSCSRIPTION 
			echo " Votre compte a été crée avec succès, vous pouvez maintenant vous connecter en cliquant "; ?><a href="connexion.php">ici.</a><?php
		} 
	}	
?>


</div>
</section>

<?php
	include("footer.php"); 
?>	


</html>