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

	
	
	<title> Tomatons - Gérer Annonces </title>
</head>

<?php
	include("header.php");
?>

<section>

		<?php include("fonctions.php");
		$connexion = connexion_bdd();
		
		$requete = $connexion -> prepare("Select * from tomatons_annonces");
		$requete -> execute();
		$i=0;
		
		while ($donnees = $requete -> fetch())
		{
			$id[$i] = $donnees["id_annonce"] . " " . $donnees["adresse_annonce"];
			$i++;
		}	
		$o=0;
		$tab = array($id) ; 
		foreach ($tab as $cle => $val)
		{
			foreach ($val as $cle2 =>$val2)
			{
				echo "Annonce : " . $val2. "<br>" ;
				$idAsuppr = $val2;
		
				?>
				<div class="formulairecreation">
				<form action="admin_gere_annonces.php" method="post">
					<!-- on récupère l'id de chaque loueur afin de l'inscrire dans le type = submit, lors du clique sur "supprimer", le l'id correspondant sera supprimé de la base de données-->
					<input type=hidden name=id value=<?php echo $idAsuppr[$o]; ?>>
					<label><span></span><input type="submit" name="aSupprimer" value="Supprimer"/></label><br><br>
				</form>
				</div>
				<?php
			}
			$o++;
			
		}
		echo "<br>";
		?>
	
</form>

		
	
	<?php 
		if(isset($_POST['aSupprimer']) && $_POST['aSupprimer']=="Supprimer")
		{
			$idAsuppr="";
			if(isset($_POST['id']))
			{
				// le l'id récupéré sera associé au "bouton : supprimer", son id est matché avec la liste dans la base de données, et supprimé de la base
				$idAsuppr=$_POST['id'];
				echo "L'annonce " . $idAsuppr . " a été supprimée, veuillez rafraîchir la page.";
			}
			$requete = "DELETE FROM tomatons_annonces WHERE id_annonce= :lannonce"; 
			$req = $connexion->prepare($requete);
			$req -> execute(array("lannonce"=> $idAsuppr)); 

		}
		
		
	?>



</section>

<?php
	include("footer.php"); 
?>	


</html>