
<header>
	<div id="blocktitre">Tomatons </div>
	<div id="connexion"><a href="connexion.php">Connexion</a></div>
	
	<?php 
	
	// S'IL N'Y A PAS DE CONNEXION D'UN LOUEUR OU D'UN ADMIN ET QUE L'ETAT DE LA CONNEXION EST INACTIF ALORS APPARAISSENT DANS LE HEADER LES ONGLETS "CREER UN COMPTE ET CONNEXION "
	
	if ((!isset($_SESSION["session_active"]) || !isset($_SESSION["session_admin"])) && !isset($_SESSION["connexionok"]))
	{
		?><div id="nouvelutilisateur"><a href ="creation_compte.php">Créer un compte </div></a><?php
	}
	
	// LA DECONNEXION SE FAIT PEU IMPORTE SI C'EST L'ADMIN OU LE LOUEUR QUI EST CONNECTE 
	
	if (isset($_SESSION["session_active"]) || isset($_SESSION["session_admin"]))
	{
		?><div id="connexion"><a href="deconnexion.php"> Déconnexion </div></a><?php
	}?>
	
	<?php 
	
	// SI L'ADMIN OU SI LE LOUEUR EST CONNECTE ALORS EN FONCTION DE QUI ON AFFICHE UN ONGLET D'ACCES A UN ESPACE DIFFERENT 
	
	if (((isset($_SESSION["session_active"])) || (isset($_SESSION["session_admin"]))) && (isset($_SESSION["connexionok"])))
	{
		// SI C'EST UN LOUEUR 
		if (isset($_SESSION["session_active"]))
		{
			?><div id="nouvelutilisateur"><a href="espacepersonnel.php"> Mon espace </div></a><?php
		}
		
		// SI C'EST UN ADMIN
		if (isset($_SESSION["session_admin"]))
		{
			?><div id="nouvelutilisateur"><a href="espaceadministrateur.php"> Mon espace admin </div></a><?php
		}
		
	}?>
</header>

<nav>
	<a href="index.php" >Accueil</a>
	<a href="articles.php" >Articles</a>
	<a href="contact.php">Contact</a>
	
</nav>


