<?php 

/*controleur utilisateur.php :
  fonctions-action de gestion des utilisateurs
*/

function ident () {
	/*
	require_once ("./modele/utilisateurBD.php");
	$ident=isset($_POST['ident'])?trim($_POST['ident']):'';
	$num=isset($_POST['mdp'])?trim($_POST['mdp']):'';
	$msg="";
	$_SESSION['page'] = 'accueil';
	$P=array();
	if (count($_POST)==0){
		$_SESSION['profilU'] = $P;
		require("./Vue/accueil.php");
	}
	else {
		if(verif_bd($ident, $num, $P)) {
			$_SESSION['profilU'] = $P;
			$_SESSION['typeUti'] = $P['type'];
			require("./Vue/accueil.php");
		}
		else {
			$_SESSION['profilU'] = $P;
			require("./Vue/accueil.php");
		}
	}
	*/
	accueil();
}
function accueil(){
	$_SESSION['page'] = 'accueil';
	require("./Vue/accueil.php");
}
?>