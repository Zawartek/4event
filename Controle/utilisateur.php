<?php

/* controleur utilisateur.php :
  fonctions-action de gestion des utilisateurs
 */

function ident() {
    require ("./Modele/utilisateurs.php");

    accueil();
}

function accueil() {
    require_once './Modele/utilisateurs.php';
    $_SESSION['page'] = 'accueil';
    $themes = getThemeEvent();
    $events = recherche();
    include ("./Vue/accueil.php");
}

function afficherPageUti($idUti) {
    require_once './Modele/utilisateurs.php';
    $_SESSION['page'] = 'pageUti';
    $uti = infosUti($db, $idUti);
    $uti["eventOrga"]=  eventOrga($db, $idUti);
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

function afficherPageFAQ(){
    require_once './Modele/utilisateurs.php';
    require_once './Modele/admins.php';
    $faqs = FAQ($db);
    include './Vue/faq.php';
}


// Controleur pour gérer le formulaire de connexion des utilisateurs
function connexion()
{
    if (!empty($_POST['email']) && !empty($_POST['mdp']))
    {
        // L'utilisateur a rempli tous les champs du formulaire
        require ("./Modele/utilisateurs.php");

        $mail = htmlspecialchars($_POST['email']);
        $mdp = md5(htmlspecialchars($_POST['mdp']));

        $reponse = mdp($db, $mail);

        if ($reponse->rowcount() == 0)
        {
            // L'utilisateur n'a pas été trouvé dans la base de données
            $erreur = "Utilisateur inconnu";
        }
        else
        {
            // utilisateur trouvé dans la base de données
            $ligne = $reponse->fetch();

            if ($mdp != $ligne['utilisateur_mot_de_passe'])
            {
                // Le mot de passe entré ne correspond pas
                // à celui stocké dans la base de données
                $erreur = "Mot de passe incorrect";
            }
            else
            {
                // mot de passe correct, on affiche la page d'accueil
                $_SESSION['userID'] = $ligne['utilisateur_id'];
                $_SESSION['prenom_nom'] = $ligne['utilisateur_prenom'] . " " . $ligne['utilisateur_nom'];
                $_SESSION['userType'] = $ligne['utilisateur_type'];
            }
        }
    }
    else
    {
        // L'utilisateur n'a pas rempli tous les champs du formulaire
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
        $mdp = md5(htmlspecialchars($_POST['mdp']));
        $sexe = htmlspecialchars($_POST['sexe']);

        $newsletter = (isset($_POST['newsletter'])) ? $_POST['newsletter'] : 0;

        ajoutUtiBD($db, $nom, $prenom, $email, $voie, $codepostal, $ville, $pays
        , $datenaissance, $mdp, $sexe,0,0,$newsletter);
    }

    echo "<script>location='index.php';</script>";
}

function modificationProfil()
{
    require './Modele/utilisateurs.php';
    require './Controle/admin.php';
    
    $idUti = $_SESSION['userID'];
    if (isset($_POST['SUPPR']))
    {
        suppressionutil($db, $idUti);
        session_destroy();
        header('Location: index.php');
    }
    else
    {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $voie = htmlspecialchars($_POST['voie']);
        $codepostal = htmlspecialchars($_POST['codepostal']);
        $ville = htmlspecialchars($_POST['ville']);
        $pays = htmlspecialchars($_POST['pays']);
        $datenaissance = $_POST['annee'] . "-" . $_POST['mois'] . "-" . $_POST['jour'];
        $mdp = htmlspecialchars($_POST['mdp']);
        $sexe = htmlspecialchars($_POST['sexe']);
        
        if (isset($_FILES['photo']['name']) && $_FILES['photo']['name']<>"")
        {
            $photo = $_FILES['photo']['name'];
            uploadFile("./Vue/img/photoProfil/", 'photo');
        }
        else
        {
            $photo = $_POST["photoActuelle"];
        }
        
        $newsletter = 0;
        
        $infosFixes = infosFixesProfil($db, $idUti);
        $etat = $infosFixes["utilisateur_etat"];
        $type = $infosFixes["utilisateur_type"];
        
        $nbThemes = getNbTheme($db);
        $favoris = array();
        
        for ($i = 1; $i <= $nbThemes; $i++)
        {
            $theme = "favori".$i;
            
            if (isset($_POST[$theme]))
            {
                $favoris[] = $_POST[$theme];
            }
        }
        majFavoris($db, $idUti, $favoris);
        
        modificationUtiBD($db, $idUti, $nom, $prenom, $email, $voie, $codepostal, $ville, $pays
                , $datenaissance, $mdp, $sexe, $etat, $type, $newsletter, $photo);
        
        header('Location: index.php?controle=utilisateur&action=afficherPageGestionUti');
    }
}
?>