<?php
    // Il s'agit simplement ici de vider les variables de SESSION et de les recréer par la suite en précisant que l'utilisateur est déconnecté.
    session_start();

    $_SESSION = array();
    $_SESSION["session_admin"] = false;
    $_SESSION["session_active"] = false;
	$_SESSION["connexionok"]= false;
	
	session_destroy();
	
	
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta name = "language" content ="fr"/>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<!--<meta charset="UTF-8"/>-->
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

	<?php // redirection vers la page accueil 
	echo "<br><br><br><br><br><br><br><br>";
	echo "Vous êtes maintenant déconnectez, veuillez cliquez" ?> <a href="index.php"> ici </a> <?php echo "pour allez vers l'accueil" ; 
	echo "<br><br><br><br><br><br><br><br>";?>

	
</section>

<?php
	include("footer.php"); 
?>	


</html>