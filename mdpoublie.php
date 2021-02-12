<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta name = "language" content ="fr"/>
	<meta charset="UTF-8"/>
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

<?php 
	
	//Connexion à la base de données pour récupérer les informations qui seront affichées dans la page
	include("fonctions.php");
	$connexion = connexion_bdd();
		
	$requete = $connexion-> prepare("SELECT * FROM tomatons_admin");
	$requete -> execute();
	$admin = array();
				
	while ($donnees = $requete -> fetch())
	{
		$admin[$donnees["id_admin"]] = array("nom_admin" => $donnees["nom_admin"], "mdp_admin" => $donnees["mdp_admin"], "reponse_admin" =>$donnees["reponse_admin"]);
	}
	
	// CHANGEMENT MOT DE PASSE  ADMINISTRATEUR
	
	if (isset($_POST["mdpoublie"]))
	{
		?>
		<div class="formulairecreation">
		<form method="post" action="mdpoublie.php">
		
			<div class="formulaire-sous-titre">Veuillez saisir vos données pour vous changer votre mot de passe </div> 
			<label for="nom"><span>Nom utilisateur <span class="required">*</span></span>
			<input type="text" class="champ" name="nom_mdp"><br></label>
			<br>
			
			<label for="nom"><span>Le nom de votre premier animal de compagnie <span class="required">*</span></span>
			<input type="text" class="champ" name="reponse_mdp"><br></label>
			<br>
			
			<label><input type="submit" name="changementmdp" value="Soumettre"></label>
		</form>
		</div>
		<?php
	}
		$ok2=false;
		if (isset($_POST["changementmdp"]))
		{
			if (isset($_POST["nom_mdp"]))
			{
				$nom = htmlspecialchars(trim($_POST["nom_mdp"]));
			}
			
			if (isset($_POST["reponse_mdp"]))
			{
				$reponse = htmlspecialchars(trim($_POST["reponse_mdp"]));
			}
			$entreeoui2=false;
			foreach ($admin as $cle => $val)
			{
				foreach ($val as $cle2 => $val2)
				{
					if ($val2 == $nom)
					{
						$ok2=true;	// LE NOM UTILISATEUR EST OK 
					}
					if ($val2 == $reponse && $ok2)// SI IL Y A UN MOT DE PASSE CORRESPONDANT ET QUE LE NOM EST DEJA OK DANS LE IF D'AVANT 
					{
						?>
						<div class="formulairecreation">
						<form method="post" action="mdpoublie.php">
						
							<label for="nom"><span>Nom utilisateur <span class="required">*</span></span>
							<input type="text" class="champ" name="nom_mdp"><br></label>
							<br>
							
							<label for="motdepasse"><span>Votre nouveau mot de passe<span class="required">*</span></span>
							<input type="password" placeholder="Veuillez saisir un mot de passe " class="champ" name="nouveau_mdp" /><br></label>
							<br>
							
							<label for="verifmotdepasse"><span>Confirmez votre mot de passe<span class="required">*</span></span>
							<input type="password" placeholder="Veuillez confirmer votre mot de passe" class="champ" name="nouveau_mdp2"/><br></label>
							<br>
							
							<label><input type="submit" name="changement" value="Soumettre"></label>
						</form>
						<?php 
						$entreeoui2=true;	// LE MOT DE PASSE ET LE NOM UTILISATEUR SONT BONS 
					}
				}
				$ok2=false;
			}
			if (!$ok2 && !$entreeoui2) { echo "Le nom d'utilisateur et/ou la réponse admin ne sont pas corrects, veuillez réessayer ou bien contacter l'administrateur";}
		}
		
		if (isset($_POST["nom_mdp"]))
		{
			$nom_mdp = htmlspecialchars(trim($_POST["nom_mdp"]));
		}
		
		if (isset($_POST["nouveau_mdp"]))
		{
			$nouveau_mdp = htmlspecialchars(trim($_POST["nouveau_mdp"]));
		}
			
		if (isset($_POST["nouveau_mdp2"]))
		{
			$nouveau_mdp2 = htmlspecialchars(trim($_POST["nouveau_mdp2"]));
		}
		
		
		if (isset($_POST["changement"]))
		{
			if($nouveau_mdp != $nouveau_mdp2)
			{
				echo "Les 2 mots de passes saisis ne sont pas identiques.";     		
			}
			else
			{   
				// REQUETE DE MISE A JOUR 
				$requete = "UPDATE tomatons_admin SET mdp_admin = :lenouveau WHERE nom_admin = :lenom"; 
				
				$req = $connexion->prepare($requete); 
				$req-> execute(array(
					"lenouveau" => $nouveau_mdp,
					"lenom" => $nom_mdp));
				
				
				echo "Votre mot de passe a été changé"; 
			} 
		}
		
	// CHANGEMENT MOT DE PASSE UTILISATEUR 

	if (isset($_POST["mdpoublie2"]))
	{
		?>
		<div class="formulairecreation">
		<form method="post" action="mdpoublie.php">
		
			<div class="formulaire-sous-titre">Veuillez saisir vos données pour vous changer votre mot de passe </div> 
			<label for="nom"><span>Nom utilisateur <span class="required">*</span></span>
			<input type="text" class="champ" name="nom_mdp2"><br></label>
			<br>
			
			<label for="nom"><span>Confirmez votre mail<span class="required">*</span></span>
			<input type="text" class="champ" name="mail_mdp2"><br></label>
			<br>
			
			<label><input type="submit" name="changementmdp2" value="Soumettre"></label>
		</form>
		</div>
		<?php
	}
	
		$requete = $connexion-> prepare("SELECT * FROM coordonn_loueurs");
		$requete -> execute();
		$loueurs = array();
					
		while ($donnees = $requete -> fetch())
		{
			$loueurs[$donnees["id_loue"]] = array("pseudo_loue" => $donnees["pseudo_loue"], "nom_loue" => $donnees["nom_loue"], "mail_loue" =>$donnees["mail_loue"]);
		}
		
		$ok2=false;
		if (isset($_POST["changementmdp2"]))
		{
			
			if (isset($_POST["nom_mdp2"]))
			{
				$nom2 = htmlspecialchars(trim($_POST["nom_mdp2"]));
			}
			
			if (isset($_POST["mail_mdp2"]))
			{
				$mail2 = htmlspecialchars(trim($_POST["mail_mdp2"]));
			}
			$entreeoui3=false;
			foreach ($loueurs as $cle => $val)
			{
				foreach ($val as $cle2 => $val2)
				{
					if ($val2 == $nom2)
					{
						$ok3=true; // ON VERIFIE D'ABORD QUE LE NOM EST OK 
					}
					if ($val2 == $mail2 && $ok3)// SI IL Y A UN MOT DE PASSE CORRESPONDANT ET QUE LE NOM EST DEJA OK DANS LE IF D'AVANT 
					{
						?>
						<div class="formulairecreation">
						<form method="post" action="mdpoublie.php">
						
							<label for="nom"><span>Nom utilisateur <span class="required">*</span></span>
							<input type="text" class="champ" name="nom_mdp2"><br></label>
							<br>
							
							<label for="motdepasse"><span>Votre nouveau mot de passe<span class="required">*</span></span>
							<input type="password" placeholder="Veuillez saisir un mot de passe " class="champ" name="nouveau_mdpbis" /><br></label>
							<br>
							
							<label for="verifmotdepasse"><span>Confirmez votre mot de passe<span class="required">*</span></span>
							<input type="password" placeholder="Veuillez confirmer votre mot de passe" class="champ" name="nouveau_mdpbis2"/><br></label>
							<br>
							
							<label><input type="submit" name="changement2" value="Soumettre"></label>
						</form>
						<?php 
						$entreeoui3=true; // LE MOT DE PASSE ET LE NOM SONT BONS 
					}
				}
				$ok3=false;
			}
			if (!$ok3 && !$entreeoui3) { echo "Le nom d'utilisateur et/ou la réponse admin ne sont pas corrects, veuillez réessayer ou bien contacter l'administrateur";}
		}
		
		if (isset($_POST["nom_mdp2"]))
		{
			$nom_mdp2 = htmlspecialchars(trim($_POST["nom_mdp2"]));
		}
		
		if (isset($_POST["nouveau_mdpbis"]))
		{
			$nouveau_mdpbis = htmlspecialchars(trim($_POST["nouveau_mdpbis"]));
		}
			
		if (isset($_POST["nouveau_mdpbis2"]))
		{
			$nouveau_mdpbis2 = htmlspecialchars(trim($_POST["nouveau_mdpbis2"]));
		}
		
		
		if (isset($_POST["changement2"]))
		{
			if($nouveau_mdpbis != $nouveau_mdpbis2)
			{
				echo "Les 2 mots de passes saisis ne sont pas identiques.";     		
			}
			else
			{   // REQUETE DE MISE A JOUR DU MOT DE PASSE 
				$requete = "UPDATE coordonn_loueurs SET mdp_loue = :lenouveau WHERE pseudo_loue = :lenom"; 
				
				$req = $connexion->prepare($requete); 
				$req-> execute(array(
					"lenouveau" => $nouveau_mdpbis,
					"lenom" => $nom_mdp2));
				
				
				echo "Votre mot de passe a été changé"; 
			} 
		}	
		
		
		?>
		
</section>



<?php
	include("footer.php"); 
?>	


</html>