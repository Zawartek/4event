<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function afficherPageEvent($idEvent)
{
    require './Modele/evenements.php';
    $event = infosEvent($db, $idEvent);
    
    if ($event ==null)
    {
        require './Controle/utilisateur.php';
        accueil();
    }
    $participation = participe($db,$_SESSION['userID'], $idEvent);
    include ("./Vue/pageEvent.php");
}

function participer($idEvent)
{
    require './Modele/evenements.php';
    if (isset($_SESSION['userID'])){
        participerBD($db, $idEvent, $_SESSION['userID']);
    }
    
    $nexturl = "index.php?controle=evenement&action=afficherPageEvent&param=".$idEvent;
    header ("Location:" . $nexturl);
}

function ajoutInteret()
{
    require './Modele/evenements.php';
    ajoutInteretBD($idEvent);
}

function annulerParticipation($idEvent)
{
    require './Modele/evenements.php';
    if (isset($_SESSION['userID'])){
        annulerParticipationBD($db, $idEvent, $_SESSION['userID']);
    }
    $nexturl = "index.php?controle=evenement&action=afficherPageEvent&param=".$idEvent;
    header ("Location:" . $nexturl);
}

function creationEvent()
{
    require ('./Modele/configSQL.php');
    require ('./Vue/fonctions.php');

    if (isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['voie']) && isset($_POST['codepostal']) &&
    isset($_POST['ville']) && isset($_POST['pays']) && isset($_POST['theme']) && isset($_POST['dateDebut']) &&
    isset($_POST['dateFin']) && isset($_POST['maxParticipants']) && isset($_POST['typePublic']) && isset($_POST['tarif']) &&
    isset($_POST['heureDebut']) && isset($_POST['heureFin']) && isset($_POST['siteWeb']))
    {
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $voie = htmlspecialchars($_POST['voie']);
        $codepostal = htmlspecialchars($_POST['codepostal']);
        $ville = htmlspecialchars($_POST['ville']);
        $pays = htmlspecialchars($_POST['pays']);
        $theme = htmlspecialchars($_POST['theme']);
        $dateDebut = formattageDateBDD($_POST['dateDebut']);
        $dateFin = formattageDateBDD($_POST['dateFin']);
        $maxParticipants = htmlspecialchars($_POST['maxParticipants']);
        $tarif = htmlspecialchars($_POST['tarif']);
        $typePublic = htmlspecialchars($_POST['typePublic']);
        $heureDebut = htmlspecialchars($_POST['heureDebut']);
        $heureFin = htmlspecialchars($_POST['heureFin']);
        $siteWeb = htmlspecialchars($_POST['siteWeb']);

        $sql = "SELECT MAX(adresse_id) AS ID FROM `adresse`";
        $reponse = $db->query($sql);
        $data = $reponse->fetch();

        $adresse_id = $data['ID'] + 1;

        $sql2 = $db->prepare('INSERT INTO adresse SET adresse_id = :adresse_id, adresse_numero_voie = :voie, adresse_ville = :ville,'
                .'adresse_code_postal = :codepostal, adresse_pays = :pays');

        $sql2->bindValue(':adresse_id', $adresse_id);
        $sql2->bindValue(':voie', $voie, PDO::PARAM_STR);
        $sql2->bindValue(':ville', $ville, PDO::PARAM_STR);
        $sql2->bindValue(':codepostal', $codepostal);
        $sql2->bindValue(':pays', $pays, PDO::PARAM_STR);

        $sql2->execute();

        $sql3 = $db->prepare('INSERT INTO evenement SET evenement_id = :evenement_id, evenement_titre = :titre, evenement_description = :description,'
                .'evenement_utilisateur_id = :user_id, evenement_adresse_id = :adresse_id, evenement_theme_id = :theme, evenement_date_debut = :dateDebut,'
                .'evenement_heure_debut = :heureDebut, evenement_date_fin = :dateFin, evenement_heure_fin = :heureFin,'
                .'evenement_max_participants = :maxParticipants, evenement_type_public = :typePublic, evenement_site_web = :siteWeb, evenement_tarif = :tarif');
        
        $sql3->bindValue(':evenement_id', NULL);
        $sql3->bindValue(':titre', $titre, PDO::PARAM_STR);
        $sql3->bindValue(':description', $description, PDO::PARAM_STR);
        $sql3->bindValue(':user_id', "1"); // Récup l'id de l'user par la session
        $sql3->bindValue(':adresse_id', $adresse_id);
        $sql3->bindValue(':theme', $theme);
        $sql3->bindValue(':dateDebut', $dateDebut);
        $sql3->bindValue(':heureDebut', $heureDebut);
        $sql3->bindValue(':dateFin', $dateFin);
        $sql3->bindValue(':heureFin', $heureFin);
        $sql3->bindValue(':maxParticipants', $maxParticipants);
        $sql3->bindValue(':typePublic', $typePublic);
        $sql3->bindValue(':siteWeb', $siteWeb, PDO::PARAM_STR);
        $sql3->bindValue(':tarif', $tarif, PDO::PARAM_STR);
        
        $sql3->execute();
    }

    echo "<script>location='index.php';</script>";
}

function getThemeEvent()
{
    require ('./Modele/configSQL.php');

    $sql = "SELECT * FROM theme";
    $reponse = $db->query($sql);

    $i = 0;
    $tableau = array();
    
    while($ligne = $reponse->fetch())
    {
        $tableau[$i] = $ligne;
        $i++;
    }
    
    return $tableau;
}