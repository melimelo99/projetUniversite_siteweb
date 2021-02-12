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
<div class="formulairecreation">

	<form method="post" action="connexionadmin.php">

		<div class="formulaire-sous-titre">Veuillez saisir vos données pour vous connecter : </div> 
		<label for="nom"><span>Nom utilisateur<span class="required">*</span></span>
		<input type="text" class="champ" name="nom_admi"><br></label>
		<br>
		<label for="motdepasse"><span>Votre mot de passe<span class="required">*</span></span>
		<input type="password" class="champ" name="mdp_admi"><br></label>
		<br>		
		<label><span></span><input type="submit" name="entree_admin" value="Se connecter"></label>
		
		<br>
		<br>
	</form>
	
	<form method="post" action="mdpoublie.php">
		<label><span></span><input type="submit" name="mdpoublie" value="Mot de passe oublié ? "></label>
	</form>
</div>


<?php
	if (isset($_POST["nom_admi"]) && !empty($_POST["mdp_admi"]))
	{
		$nom_ad = htmlspecialchars(trim($_POST["nom_admi"]));
		$mdp_ad = htmlspecialchars(trim($_POST["mdp_admi"]));
		
	}
	
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

	$ok=false;
	$entreeoui=false;

	if (isset($_POST["entree_admin"]))
	{
		foreach ($admin as $cle => $val)
		{
			foreach ($val as $cle2 => $val2)
			{
				if ($val2 == $nom_ad) // SI LE PSEUDO CORRESPOND
				{
					$ok=true;
				}
				if ($val2 == $mdp_ad && $ok) // SI LE PSEUDO CORRESPOND ET LE MOT DE PASSE 
				{
					?>
					Pour entrez dans l'espace administrateur : <a href = "espaceadministrateur.php"> Cliquez ici </a>
					<?php 
					$entreeoui=true;
					$_SESSION["session_admin"] = true;
					$_SESSION["connexionok"]=true;
				}
			}
			$ok=false;
		}
		if (!$ok && !$entreeoui){echo "Le nom d'utilisateur et/ou le mot de passe sont erronés";}
	}
	
	
	
?>

</section>



<?php
	include("footer.php"); 
?>	


</html>