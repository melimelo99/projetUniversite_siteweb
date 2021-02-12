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

	
	
	<title> Tomatons - Messages reçus</title>
</head>

<?php
	include("header.php");
?>

<section>
		<?php include("fonctions.php");
		$connexion = connexion_bdd();
		
		$requete = $connexion -> prepare("Select * from tomatons_contact");
		$requete -> execute();
		$i=0;
		
		
		// ON RECUPERE LES MESSAGES INSCRIT DANS LE FORMULAIRE DE CONTACT , POUR LES AFFICHER A L'ADMIN
		while ($donnees = $requete -> fetch())
		{
			$tab_contact[$donnees["id_contact"]] = array("mail_contact" => $donnees["mail_contact"], "nom_contact" => $donnees["nom_contact"], "prenom_contact" => $donnees["prenom_contact"], "tel_contact" => $donnees["tel_contact"], "message_contact" => $donnees["message_contact"]);
			$i++;
		}	

		foreach ($tab_contact as $cle => $val)
		{
			foreach ($val as $cle2 =>$val2)
			{
				if ($cle2=="mail_contact")
				{
					echo "<a href=mailto:?to= $val2> Cliquez pour répondre </a>"; // LIEN POUR ALLER DIRECTEMENT SUR LA MESSAGERIE AVEC LE MAIL INSCRIT 
				}
				if ($cle2=="nom_contact")
				{
					echo "Nom : " . $val2;
				}
				if ($cle2=="prenom_contact")
				{
					echo "Prénom : " . $val2;
				}
				if ($cle2=="tel_contact")
				{
					if ($val2==NULL)
					{
						$val2 = "NC";
					}
					echo "Tél : " . $val2;
				}
				if ($cle2=="message_contact")
				{
					echo "Message : " . "<br>" . $val2;
				}
				echo "<br>" ;
			}
			echo "<br>";
			echo "<br>";
		}

		?>
	
</form>

</section>

<?php
	include("footer.php"); 
?>	


</html>