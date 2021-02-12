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

	
	
	<title> Tomatons - Gérer loueurs </title>
</head>

<?php
	include("header.php");
?>

<section>
<!--  Gestion des comptes d'utilisateurs  -->
<form method="post" action="admin_gere_loueurs.php" >
	<!-- récupérer nom et prénom de l'admin -->
	<div class="espace-admin">Bienvenue sur l'espace administrateur </div> 
	
	
	<?php 
	
		include("fonctions.php");
		$connexion = connexion_bdd();
		
		$requete = $connexion -> prepare("Select * from coordonn_loueurs");
		$requete -> execute();
		$i=0;
		
		while ($donnees = $requete -> fetch())
		{
			$tab_loueurs[$donnees["id_loue"]] = array("pseudo_loue" => $donnees["pseudo_loue"], "adress_loue" => $donnees["adress_loue"], "arrondiss_loue" => $donnees["arrondiss_loue"]);
		}	

		$o=0;

		// APRES AVOIR RECUPERER LES DONNEES DU LOUEURS, ON L'AFFICHE AFIN QUE L'ADMINISTRATEUR PUISSE SUPPRIMER LE LOUEUR QU'IL VEUT 
		foreach ($tab_loueurs as $cle => $val)
		{
			foreach ($val as $cle2 => $val2)
			{
				if($cle2=="pseudo_loue") 
				{
					
					echo "<br>Loueur : " .$val2 . "<br>";
					$pseudo[$o]=$val2;	?>
					
					<?php
				}
				
				if ($cle2 =="adress_loue")
				{
					echo "Adresse : " . $val2 . "<br>";
				}
				if ($cle2 =="arrondiss_loue")
				{
					echo  $val2 . "e arrondissement" . "<br>";
				}
			}?>
			<div class="formulairecreation">
			<form action="admin_gere_loueurs.php" method="post">
			
				<!-- on récupère le pseudo de chaque loueur afin de l'inscrire dans le type = submit, lors du clique sur "supprimer", le pseudo correspondant sera supprimé de la base de données-->
				<?php echo "<input type=\"hidden\" name=\"id\" value=$pseudo[$o]>";?>
				<label><input type="submit" name="supprimer" value="Supprimer"/></label><br>
			</form>
			</div>
			<?php
			$o++;
		}	
		?>
	
</form>
	
	<?php 	
		if(isset($_POST["supprimer"]) && $_POST["supprimer"]=="Supprimer")
		{
			$pseudo[$o]=" ";
			if(isset($_POST['id']))
			{
				$pseudo[$o]=$_POST['id'];
				// le pseudo récupéré sera associé au "bouton : supprimer", son pseudo est matché avec la liste dans la base de données, et supprimé de la base
			}
			$req = $connexion->prepare('DELETE FROM coordonn_loueurs WHERE pseudo_loue="'.$pseudo[$o].'"');
			$req -> execute(array('pseudo_loue'=> $pseudo[$o])); 
			
			echo "Veuillez rafraîchir la page pour voir le loueur supprimé";

		}
	?>


</section>

<?php
	include("footer.php"); 
?>	


</html>