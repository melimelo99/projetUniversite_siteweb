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

	
	
	<title> Tomatons - Formulaire de contact </title>
</head>

<?php
	include("header.php");
?>

<section>


<div class="formulairecreation">

<form method="post" action="contact.php">

	<div class="formulaire-sous-titre"> Des remarques sur notre site, des questions ? <br/> Veuillez remplir le formulaire suivant : </div> 
	<label for="mail"><span> Adresse électronique <span class="required">*</span></span>
	<input type="email" class="champ" name="mail"><br></label>
	<br>
	
	<label for="nom"><span> Nom <span class="required">*</span></span>
	<input type="text" class="champ" name="nom"><br></label>
	<br>
	
	<label for="prenom"><span> Prénom <span class="required">*</span></span>
	<input type="text" class="champ" name="prenom"><br></label>
	<br>
	
	<label for="telephone"><span> Numéro de téléphone </span>
	<input type="telephone" class="champ" name="telephone"><br></label>
	<br>
	
	<label for="message"><span> Message <span class="required">*</span></span>
	<textarea name="message" class="textfield"></textarea></label>
	<br>
	
	<label><span></span><input type="submit" name="soumettre" value="Envoyer"></label><br>


</form>
</div>
	<?php include("fonctions.php");
		$connexion = connexion_bdd();

		if (isset($_POST["soumettre"]))
		{
			$mail = htmlspecialchars(trim($_POST['mail']));
			$nom = htmlspecialchars(trim($_POST['nom']));
			$prenom = htmlspecialchars(trim($_POST['prenom']));
			$telephone = htmlspecialchars(trim($_POST['telephone']));
			if (isset($_POST["message"]))
			{
				$message = htmlspecialchars(trim($_POST['message']));
			}
			
			// ON INSERE LES MESSAGES ECRIT VIA LE FORMULAIRE DE CONTACT
			
			$requete = "Insert into tomatons_contact(mail_contact, nom_contact, prenom_contact, tel_contact, message_contact)
			VALUES (:lemail, :lenom, :leprenom, :letel, :lemessage)" ; 
			
			$req = $connexion->prepare($requete); 
			$req-> execute(array(
				"lemail" => $mail,
				"lenom" => $nom,
				"leprenom" =>$prenom,
				"letel"=>$telephone,
				"lemessage" => $message
					));
					
			echo "Votre message a été pris en compte, Merci <br> <br>";

		}
		
		

	?>

</section>


<?php
	include("footer.php"); 
?>	


</html>