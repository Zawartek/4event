<?php

/* controleur utilisateur.php :
  fonctions-action de gestion des utilisateurs
 */

function ident() {
    require ("./Modele/utilisateurs.php");

    accueil();
}

function accueil() {
    require ('./Controle/evenement.php');
    
    $_SESSION['page'] = 'accueil';
    /*
      $nexturl = "./Vue/accueil.php";
      header ("Location:" . $nexturl);
     */
    include ("./Vue/accueil.php");
}

function afficherPageUti($idUti) {
    require_once './Modele/utilisateurs.php';
    $_SESSION['page'] = 'pageUti';
    $uti = infosUti($db, $idUti);
    include ("./Vue/profilUtilisateur.php");
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
    require ('./Vue/fonctions.php');

    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['voie']) &&
            isset($_POST['codepostal']) && isset($_POST['ville']) && isset($_POST['pays']) && isset($_POST['datenaissance']) &&
            isset($_POST['mdp']) && isset($_POST['sexe'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $voie =  htmlspecialchars($_POST['voie']);
        $codepostal = htmlspecialchars($_POST['codepostal']);
        $ville = htmlspecialchars($_POST['ville']);
        $pays = htmlspecialchars($_POST['pays']);
        $datenaissance = htmlspecialchars(formattageDateBDD($_POST['datenaissance']));
        $mdp = htmlspecialchars($_POST['mdp']);
        $sexe = htmlspecialchars($_POST['sexe']);

        if (isset($_POST['newsletter'])) {
            $newsletter = $_POST['newsletter'];
        } else {
            $newsletter = 0;
        }

        $sql = "SELECT MAX(adresse_id) AS ID FROM `adresse`";
        $reponse = $db->query($sql);
        $data = $reponse->fetch();

        $adresse_id = $data['ID'] + 1;

        $sql2 = "INSERT INTO `adresse`(`adresse_id`, `adresse_numero_voie`, `adresse_ville`, `adresse_code_postal`, `adresse_pays`)"
                . "VALUES ('$adresse_id' ,'$voie' ,'$ville' ,'$codepostal' ,'$pays')";
        $reponse2 = $db->query($sql2);

        $sql3 = "INSERT INTO `utilisateur`(`utilisateur_id`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_email`,"
                . "`utilisateur_adresse_id`, `utilisateur_date_naissance`, `utilisateur_image_profil`, `utilisateur_mot_de_passe`,"
                . "`utilisateur_etat`, `utilisateur_type`, `utilisateur_sexe`, `utilisateur_newsletter`) VALUES"
                . "('' ,'$nom' ,'$prenom' ,'$email' ,'$adresse_id', '$datenaissance','' ,'$mdp' ,'' ,'' ,'$sexe' ,'$newsletter')";
        $reponse3 = $db->query($sql3);
    }

    echo "<script>location='index.php';</script>";
}

?>