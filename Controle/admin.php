<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function verifAdmin(){
    if (!isset($_SESSION['userID']) || !verifAdminBD($db, $_SESSION['userID'])){
        header("Location:./");
    }
}

function afficherPageAdminGU() {
    require './Modele/admins.php';
    verifAdmin();
    require './Modele/utilisateurs.php';
    $utilisateurs = utilisateurs($db);
    include ("./Vue/Admin/gestionUtilisateur.php");
}

function afficherPageAdminGE() {
    require './Modele/admins.php';
    verifAdmin();
    require './Modele/evenements.php';
    $events = events($db);
    include ("./Vue/Admin/gestionEvent.php");
}

function afficherPageAdminGF() {
    require './Modele/admins.php';
    verifAdmin();
    $faq = FAQ($db);
    include ("./Vue/Admin/gestionFaq.php");
}

function afficherPageAdminGT() {
    require './Modele/admins.php';
    verifAdmin();
    $themes = ThemesBD($db);
    include ("./Vue/Admin/gestionTheme.php");
}

function gestionEvent() {
    require './Modele/evenements.php';
    $evenement_id = $_POST['id'];
    if (isset($_POST['SUPPR'])) {
        suppressioneventBD($db, $evenement_id);
    } else {
        $evenement_titre = htmlspecialchars($_POST['titre']);
        $evenement_description = htmlspecialchars($_POST['description']);
        $evenement_theme_id = htmlspecialchars($_POST['themeId']);
        $evenement_date_debut = htmlspecialchars(formattageDate($_POST['dateDebut'], "bdd"));
        $evenement_heure_debut = htmlspecialchars($_POST['heureDebut']);
        $evenement_date_fin = htmlspecialchars(formattageDate($_POST['dateFin'], "bdd"));
        $evenement_heure_fin = htmlspecialchars($_POST['heureFin']);
        $evenement_max_participants = htmlspecialchars($_POST['max']);
        $evenement_type_public = htmlspecialchars($_POST['public']);
        $evenement_site_web = htmlspecialchars($_POST['web']);
        $evenement_tarif = htmlspecialchars($_POST['tarif']);

        $adresse_numero_voie = htmlspecialchars($_POST['voie']);
        $adresse_ville = htmlspecialchars($_POST['ville']);
        $adresse_code_postal = htmlspecialchars($_POST['codepostal']);
        $adresse_pays = htmlspecialchars($_POST['pays']);

        if (isset($_POST['ADD'])) {
            $adresse_id = insertionAdresseBD($db, $adresse_numero_voie, $adresse_ville, $adresse_code_postal, $adresse_pays);

            insertionEventBD($db, $evenement_titre, $evenement_description, $_SESSION["userID"], $evenement_theme_id, $evenement_date_debut, $evenement_heure_debut, $evenement_date_fin, $evenement_heure_fin, $evenement_max_participants, $evenement_type_public, $evenement_site_web, $evenement_tarif, $adresse_id);
        } else if (isset($_POST['MOD'])) {
            modificationeventBD($db, $evenement_id, $evenement_titre, $evenement_description, $_SESSION["userID"], $evenement_theme_id, $evenement_date_debut, $evenement_heure_debut, $evenement_date_fin, $evenement_heure_fin, $evenement_max_participants, $evenement_type_public, $evenement_site_web, $evenement_tarif);

            $adresse_id = adresseByEventBD($db, $evenement_id);
            modificationadresseBD($db, $adresse_id, $adresse_numero_voie, $adresse_ville, $adresse_code_postal, $adresse_pays);
        }
    }
    header('Location: index.php?controle=admin&action=afficherPageAdminGE');
}

function gestionFaq() {
    require './Modele/admins.php';
    $idfaq = $_POST['id'];

    if (isset($_POST['SUPPR'])) {
        suppressionFAQBD($db, $idfaq);
    } else {
        $question = htmlspecialchars($_POST['titre']);
        $reponse = htmlspecialchars($_POST['description']);

        if (isset($_POST['ADD'])) {
            ajoutFAQBD($db, $question, $reponse, $_SESSION["userID"]);
        } else if (isset($_POST['MOD'])) {
            modificationFAQBD($db, $idfaq, $question, $reponse, $_SESSION["userID"]);
        }
    }
    header('Location: index.php?controle=admin&action=afficherPageAdminGF');
}

function gestionUti() {

    require './Modele/utilisateurs.php';
    $idUti = $_POST['id'];
    if (isset($_POST['SUPPR'])) {
        suppressionutil($db, $idUti);
    } else {
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
        $etat = $_POST['etat'];
        $type = $_POST['type'];
        $newsletter = 0;

        if (isset($_POST['ADD'])) {
            ajoutUtiBD($db, $nom, $prenom, $email, $voie, $codepostal, $ville, $pays
                    , $datenaissance, $mdp, $sexe, $etat, $type, $newsletter);
        } else if (isset($_POST['MOD'])) {
            modificationUtiBD($db, $idUti, $nom, $prenom, $email, $voie, $codepostal, $ville, $pays
                    , $datenaissance, $mdp, $sexe, $etat, $type, $newsletter);
        }
    }
    header('Location: index.php?controle=admin&action=afficherPageAdminGU');
}

function gestionTheme() {

    require './Modele/admins.php';
    $idTheme = $_POST['id'];

    if (isset($_POST['SUPPR'])) {
        suppressionThemeBD($db, $idTheme);
    } else {
        $nom = htmlspecialchars($_POST['nom']);
        print_r($_FILES);
        if (isset($_FILES['miniature']['name']) && $_FILES['miniature']['name']<>"") {
            uploadFile("./Vue/img/logoTheme/", 'miniature');
        }
        if (isset($_POST['ADD'])) {
            if (isset($_POST['nom']) && isset($_FILES['miniature']['name'])) {
                ajoutThemeBD($db, $nom, $_FILES['miniature']['name']);
            }
        } else if (isset($_POST['MOD'])) {
            if (isset($_POST['nom'])) {
                if (isset($_FILES['miniature']['name']) && $_FILES['miniature']['name']<>"") {
                    $miniature = $_FILES['miniature']['name'];
                } else {
                    $miniature = getMiniature($db, $idTheme);
                }
                modificationThemeBD($db, $idTheme, $nom, $miniature);
            }
        }
    }
    header('Location: index.php?controle=admin&action=afficherPageAdminGT');
}

function uploadFile($target_dir, $file_to_upload) {
    $target_file = $target_dir . basename($_FILES[$file_to_upload]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES[$file_to_upload]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES[$file_to_upload]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$file_to_upload]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES[$file_to_upload]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
