<?php

/* controleur utilisateur.php :
  fonctions-action de gestion des utilisateurs
 */

function ident() {
    require ("./Modele/utilisateurs.php");

    accueil();
}

function accueil() {
    
    $_SESSION['page'] = 'accueil';
    $themes = getThemeEvent();
    $events = recherche();
    include ("./Vue/accueil.php");
}

function afficherPageUti($idUti) {
    require_once './Modele/utilisateurs.php';
    $_SESSION['page'] = 'pageUti';
    $uti = infosUti($db, $idUti);
    include ("./Vue/profilUtilisateur.php");
}

function afficherPageGestionUti(){
    require_once './Modele/utilisateurs.php';
    $idUti = $_SESSION["userID"];
    $uti = infosUti($db, $idUti);
    $themes = getThemeEvent();
    $uti["utilisateur_favoris"] = rechercheFavori($db, $idUti);
    $uti["utilisateur_alertes"] = alertesUti($db, $idUti);
    include './Vue/gestion/gestionProfil.php';
}

// Controleur pour gérer le formulaire de connexion des utilisateurs
function connexion() {
    if (!empty($_POST['email']) && !empty($_POST['mdp'])) {
        // L'utilisateur a rempli tous les champs du formulaire
        require ("./Modele/utilisateurs.php");


        $reponse = mdp($db, $_POST['email']);

        if ($reponse->rowcount() == 0) {
            // L'utilisateur n'a pas été trouvé dans la base de données
            $erreur = "Utilisateur inconnu";
        } else { // utilisateur trouvé dans la base de données
            $ligne = $reponse->fetch();
            if ($_POST['mdp'] != $ligne['utilisateur_mot_de_passe']) {
                // Le mot de passe entré ne correspond pas
                // à celui stocké dans la base de données
                $erreur = "Mot de passe incorrect";
            } else { // mot de passe correct, on affiche la page d'accueil
                $_SESSION['userID'] = $ligne['utilisateur_id'];
                $_SESSION['prenom_nom'] = $ligne['utilisateur_prenom'] . " " . $ligne['utilisateur_nom'];
                $_SESSION['userType'] = $ligne['utilisateur_type'];
                
            }
        }
    } else { // L'utilisateur n'a pas rempli tous les champs du formulaire
        $erreur = "Veuillez remplir tous les champs";
    }
    $nexturl = "index.php?controle=utilisateur&action=accueil";
    header ("Location:" . $nexturl);
}

function deconnexion(){
    session_destroy();
    $nexturl = "index.php?controle=utilisateur&action=accueil";
    header ("Location:" . $nexturl);
}

function inscription() {
    require ('./Modele/configSQL.php');
    require ('./Modele/utilisateurs.php');

    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['voie']) && isset($_POST['codepostal']) &&
            isset($_POST['ville']) && isset($_POST['pays']) && isset($_POST['jour']) && isset($_POST['mois']) && isset($_POST['annee']) &&
            isset($_POST['mdp']) && isset($_POST['sexe'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $voie =  htmlspecialchars($_POST['voie']);
        $codepostal = htmlspecialchars($_POST['codepostal']);
        $ville = htmlspecialchars($_POST['ville']);
        $pays = htmlspecialchars($_POST['pays']);
        $datenaissance = $_POST['annee']."-".$_POST['mois']."-".$_POST['jour'];
        $mdp = htmlspecialchars($_POST['mdp']);
        $sexe = htmlspecialchars($_POST['sexe']);

        $newsletter = (isset($_POST['newsletter'])) ? $_POST['newsletter'] : 0;

        ajoutUtiBD($db, $nom, $prenom, $email, $voie, $codepostal, $ville, $pays
        , $datenaissance, $mdp, $sexe,0,0,$newsletter);
    }

    echo "<script>location='index.php';</script>";
}

?>
