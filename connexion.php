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
	<link rel="stylesheet" href="css/bootstrap.css">
	
	
	<title> Tomatons - Connexion</title>
</head>

<?php
	include("header.php");
?>

<section>


<div class="formulairecreation">

	<form method="post" action="connexion.php">

		<div class="formulaire-sous-titre">Veuillez saisir vos données pour vous connecter : </div> 
		<label for="mail"><span>Adresse électronique<span class="required">*</span></span>
		<input type="email" class="champ" name="mail"><br></label>
		<br>
		<label for="motdepasse"><span>Votre mot de passe<span class="required">*</span></span>
		<input type="password" class="champ" name="motdepasse"><br></label>
		<br>
		
		
		<label><span></span><input type="submit" name="connexion" value="Se connecter"></label>
		<br>
		<br>

	</form>
	
	<form method="post" action="mdpoublie.php">
		<label><span></span><input type="submit" name="mdpoublie2" value="Mot de passe oublié ? "></label>
	</form>

</div>


<div class="droite">
	<a href="connexionadmin.php">Cliquez ici pour accéder à l'espace administrateur</a>
</div>
	
	
	<?php 
		
		if (isset($_POST["connexion"]))
		{
			include("fonctions.php");

			$connexion = connexion_bdd();
		
			$requete = $connexion-> prepare("SELECT * FROM coordonn_loueurs");
			$requete -> execute();
			$connect_loue = false;
			$tab_loueurs=array();
			
			while ($donnees = $requete -> fetch())
			{
				if (isset($_POST["mail"]) && isset($_POST["motdepasse"]))
				{
					$tab_loueurs[$donnees["id_loue"]] = array("pseudo_loue" => $donnees["pseudo_loue"], "nom_loue" => $donnees["nom_loue"], "prenom_loue" => $donnees["prenom_loue"], "tel_loue" => $donnees["tel_loue"], "mail_loue" => $donnees["mail_loue"], "adress_loue" => $donnees["adress_loue"], "code_loue" => $donnees["code_loue"], "arrondiss_loue" => $donnees["arrondiss_loue"], "mdp_loue" => $donnees["mdp_loue"]);
					$mail=htmlspecialchars(trim($_POST["mail"]));
					$mdpasse = htmlspecialchars(trim($_POST["motdepasse"]));
					
					if ($donnees["mail_loue"] == $mail && $donnees["mdp_loue"] == $mdpasse)  // ON VERIFIE SI LE MAIL ET LE MOT DE PASSE SONT BONS 
					{
						$connect_loue = true;
						$_SESSION["session_active"]= true;
						$_SESSION["connexionok"]=true;
						// ON RECUPERE TOUTES SES DONNEES
						
						$_SESSION["id_loueur"]=$donnees["id_loue"];
						$_SESSION["pseudo_loueur"]=$donnees["pseudo_loue"];
						$_SESSION["nom_loueur"]=$donnees["nom_loue"];
						$_SESSION["prenom_loueur"]=$donnees["prenom_loue"];
						$_SESSION["tel_loueur"]=$donnees["tel_loue"];
						$_SESSION["mail_loueur"]=$donnees["mail_loue"];
						$_SESSION["adress_loueur"]=$donnees["adress_loue"];
						$_SESSION["code_loueur"]=$donnees["code_loue"];
						$_SESSION["arrondiss_loueur"]=$donnees["arrondiss_loue"];
						$_SESSION["mdp_loueur"]=$donnees["mdp_loue"];
						?>
						<a href="espacepersonnel.php" > Cliquez ici pour accéder à votre espace </a>
						<?php
					}
				}
			}
			// SI LE MOT DE PASSE ET/OU MAIL NE SONT PAS BONS, ALORS MONTRER CE TEXTE 
			if ($connect_loue == false){ echo "Le mail et/ou le mot de passe est erroné";}

		}
		

		

	
	
	?>
	
</section>


<?php
	include("footer.php"); 
?>	


</html>