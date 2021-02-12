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

	
	
	<title> Tomatons - Gérer Articles </title>
</head>

<?php
	include("header.php");
?>

<section>

	<?php include("fonctions.php");  

		$connexion = connexion_bdd();
		
		$requete = $connexion -> prepare("Select * from tomatons_articles");
		$requete -> execute();
		$i=0;
		
		while ($donnees = $requete -> fetch())
		{
			$articles[$donnees["id_article"]] = array("titre_article" =>$donnees["titre_article"]);
 			$i++;
		}	
		$compteur=1;
		$o=0;

		foreach ($articles as $cle => $val)
		{
			foreach ($val as $cle2 =>$val2)
			{
				$id[$o]=$cle;		
				echo "Article : " . $compteur ." " . $val2. "<br>" ;
			}
			?>
			<div class="formulairecreation">
			<form action="admin_gere_articles.php" method="post">
				<!-- on récupère l'id de chaque loueur afin de l'inscrire dans le type = submit, lors du clique sur "supprimer", le l'id correspondant sera supprimé de la base de données-->
				<?php echo "<input type=hidden name=id value=$id[$o]>";?>
				<label><input type="submit" name="aSupprimer" value="Supprimer"/></label><br><br>
			</form>
			</div>
			<?php
			$compteur++;
			$o++;
		
		}
		echo "<br>";
		?>

		<?php 
			if(isset($_POST['aSupprimer']) && $_POST['aSupprimer']=="Supprimer")
			{
				$id="";
				if(isset($_POST['id']))
				{
					// l'id récupéré sera associé au "bouton : supprimer", son id est matché avec la liste dans la base de données, et supprimé de la base
					$id=$_POST['id'];
				}

				$requete = 'DELETE FROM tomatons_articles WHERE id_article ="'.$id.'"'; 
				$req = $connexion->prepare($requete);
				$req -> execute(array("id_article"=> $id)); 

				echo " Veuillez rafraîchir la page pour voir la suppression";
				
			}

		?>


</section>

<?php
	include("footer.php"); 
?>	


</html>