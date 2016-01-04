<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function afficherPageEvent(){
    require_once './Modele/evenements.php';
    $idEvent = 1;
    $event = infosEvent($db, $idEvent);
    if ($event ==null)
    {
        require_once './Controle/utilisateur.php';
        accueil();
    }
    include ("./Vue/pageEvent.php");
}

function creationEvent(){
    
    
require ('./Modele/configSQL.php');
require ('./Vue/fonctions.php');

if (isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['voie']) && isset($_POST['codepostal']) &&
isset($_POST['ville']) && isset($_POST['pays']) && isset($_POST['theme']) && isset($_POST['dateDebut']) &&
isset($_POST['dateFin']) && isset($_POST['maxParticipants'])&& isset($_POST['typePublic'])&& isset($_POST['tarif'])
        && isset($_POST['heureDebut'])&& isset($_POST['heureFin'])&& isset($_POST['siteWeb']))
{
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $voie = $_POST['voie'];
    $codepostal = $_POST['codepostal'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $theme = $_POST['theme'];
    $dateDebut = formattageDateBDD($_POST['dateDebut']);
    $dateFin = formattageDateBDD($_POST['dateFin']);
    $maxParticipants = $_POST['maxParticipants'];
    $tarif = $_POST['tarif'];
    $typePublic = $_POST['typePublic'];
    $heureDebut = $_POST['heureDebut'];
    $heureFin = $_POST['heureFin'];
    $siteWeb = $_POST['siteWeb'];
    
    $sql = "SELECT MAX(adresse_id) AS ID FROM `adresse`";
    $reponse = $db->query($sql);
    $data = $reponse->fetch();
    
    $adresse_id = $data['ID'] + 1;
    
    $sql2 = "INSERT INTO `adresse`(`adresse_id`, `adresse_numero_voie`, `adresse_ville`, `adresse_code_postal`, `adresse_pays`)"
         . "VALUES ('$adresse_id' ,'$voie' ,'$ville' ,'$codepostal' ,'$pays')";
        $reponse2 = $db->query($sql2);
        
    $sql3 = "INSERT INTO `evenement`(`evenement_id`, `evenement_titre`, `evenement_description`,`evenement_utilisateur_id`, `evenement_adresse_id`,"
          . "`evenement_theme_id`, `evenement_date_debut`, `evenement_heure_debut`, `evenement_date_fin`, `evenement_heure_fin`,"
          . "`evenement_max_participants`, `evenement_type_public`, `evenement_site_web`, `evenement_tarif`)"
          . "VALUES ('','$titre','$description','1','$adresse_id','$theme','$dateDebut','$heureDebut','$dateFin','$heureFin','$maxParticipants',"
          . "'$typePublic','$siteWeb','$tarif')";
    $reponse3 = $db->query($sql3);
}

echo "<script>location='index.php';</script>";
}