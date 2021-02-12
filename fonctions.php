<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


// FICHIER DES FONCTIONS UTILISES DANS LE PROGRAMME
	
// CONNEXION A LA BASE DE DONNEES 		
function connexion_bdd($bdd="tomatons_donneesv2", $login="root", $mdp="", $host = "localhost", $dsn = "mysql") 
{
	try 
	{	// ON RENVOIE LA CONNEXION
		return $connex = new PDO($dsn . ":host=" . $host . ";dbname=" . $bdd .";charset=utf8", $login, $mdp);
	}
	catch (PDOException $e)
	{
			die('Erreur : ' . $e->getMessage()); 
	}
}
	
// ON RECUPERE LES LOUEURS DE LA BASE DE DONNEES DANS UN TABLEAU 
function connexion_loue_bdd($tab_bdd)
{
	$requete = $tab_bdd-> prepare("SELECT * FROM coordonn_loueurs");
	$requete -> execute();
	$tab_loueurs = array();
		
	while ($donnees = $requete -> fetch())
	{
		$tab_loueurs[$donnees["id_loue"]] = array("nom_loue" => $donnees["nom_loue"], "prenom_loue" => $donnees["prenom_loue"], "tel_loue" => $donnees["tel_loue"], "mail_loue" => $donnees["mail_loue"], "adress_loue" => $donnees["adress_loue"], "code_loue" => $donnees["code_loue"],"arrondiss_loue" => $donnees["arrondiss_loue"], "mdp_loue"=>$donnees["mdp_loue"]);
	}
	return $tab_loueurs;
}
	
	
// ON FORME LE CODE POSTAL A PARTIR DE L'ARRONDISSEMENT ENVOYE DANS L'APPEL DE LA FONCTION
function CodePostal($arrondissement)
{
	$paris = 750;
	$cp=$paris.$arrondissement;

	return $cp;
}



//Fonction permettant de vérifier si une adresse e-mail n'a pas été inscrite au préalable

$tab_bdd=array();
$tab_loue=array();
$tab_bdd = connexion_bdd();
$tab_loue = connexion_loue_bdd($tab_bdd); 
$_SESSION["tab_loue"] = $tab_loue;


function VerifMail($mail_inscrit)  
{ 
	$mailUnique=true;
	$i=1; 

	foreach($_SESSION["tab_loue"] as $loueurs=> $val)
	{
		foreach ($val as $mail=>$val2)
		{
			if ($mail_inscrit==$val2)
			{
				$mailUnique=false;
			}		
		}
	}

	return $mailUnique;
}			
?>
