<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function afficherPageAdminGU() {
    require './Modele/utilisateurs.php';
    $utilisateurs = utilisateurs($db);
    include ("./Vue/Admin/gestionUtilisateur.php");
}

function afficherPageAdminGE() {
    require './Modele/evenements.php';
    $events = events($db);
    include ("./Vue/Admin/gestionEvent.php");

}

function afficherPageAdminGF() {
    require './Modele/admins.php';
    $faq=FAQ($db);
    include ("./Vue/Admin/gestionFaq.php");
}

function gestionEvent()
{
    require './Modele/evenements.php';
    $evenement_id = $_POST['id'];
    if (isset($_POST['SUPPR']))
    {
        suppressioneventBD($db,$evenement_id);
    }
    else
    {
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

        if (isset($_POST['ADD']))
        {
            $adresse_id = insertionAdresseBD($db, $adresse_numero_voie, $adresse_ville, $adresse_code_postal, $adresse_pays);
            
            insertionEventBD($db, $evenement_titre, $evenement_description, $_SESSION["userID"], $evenement_theme_id, $evenement_date_debut, $evenement_heure_debut, $evenement_date_fin,
            $evenement_heure_fin, $evenement_max_participants, $evenement_type_public, $evenement_site_web, $evenement_tarif, $adresse_id);
        }
        else if (isset($_POST['MOD']))
        {
            modificationeventBD($db,$evenement_id, $evenement_titre, $evenement_description, $_SESSION["userID"], $evenement_theme_id, $evenement_date_debut, $evenement_heure_debut, $evenement_date_fin,
            $evenement_heure_fin, $evenement_max_participants, $evenement_type_public, $evenement_site_web, $evenement_tarif);

            $adresse_id = adresseByEventBD($db, $evenement_id);
            modificationadresseBD($db, $adresse_id, $adresse_numero_voie, $adresse_ville, $adresse_code_postal, $adresse_pays);
        }
    }
    header('Location: index.php?controle=admin&action=afficherPageAdminGE');
}
function gestionFaq()
{
    require './Modele/admins.php';
    $idfaq = $_POST['id'];
    
    if (isset($_POST['SUPPR']))
    {
        suppressionFAQBD($db, $idfaq);
    }
    else
    {
        $question = htmlspecialchars($_POST['titre']);
        $reponse = htmlspecialchars($_POST['description']);

        if (isset($_POST['ADD']))
        {
            ajoutFAQBD($db, $question, $reponse, $_SESSION["userID"]);
        }
        else if (isset($_POST['MOD']))
        {
            modificationFAQBD($db, $idfaq, $question, $reponse, $_SESSION["userID"]);
        }
    }
    header('Location: index.php?controle=admin&action=afficherPageAdminGF');
}

function gestionUti()
{

    require './Modele/utilisateurs.php';
    $idUti = $_POST['id'];
    if (isset($_POST['SUPPR']))
   {
     suppressionutil($db,$idUti);
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
        $datenaissance = $_POST['annee']."-".$_POST['mois']."-".$_POST['jour'];
        $mdp = htmlspecialchars($_POST['mdp']);
        $sexe = htmlspecialchars($_POST['sexe']);
        $etat=$_POST['etat'];
        $type=$_POST['type'];
        $newsletter=0;

        if (isset($_POST['ADD']))
        {
            ajoutUtiBD($db, $nom, $prenom, $email, $voie, $codepostal, $ville, $pays
            , $datenaissance, $mdp, $sexe, $etat, $type, $newsletter);
        }
        else if (isset($_POST['MOD']))
        {
            modificationUtiBD($db, $idUti, $nom, $prenom, $email, $voie, $codepostal, $ville, $pays
            , $datenaissance, $mdp, $sexe, $etat, $type, $newsletter);
        }
    }
    header('Location: index.php?controle=admin&action=afficherPageAdminGU');
}