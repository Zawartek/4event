<?php

require_once ('./../Modele/configSQL.php');
require_once ('fonctions.php');

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['voie']) &&
isset($_POST['codepostal']) && isset($_POST['ville']) && isset($_POST['pays']) && isset($_POST['datenaissance']) &&
isset($_POST['mdp']) && isset($_POST['sexe']))
{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $voie = $_POST['voie'];
    $codepostal = $_POST['codepostal'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $datenaissance = formattageDateBDD($_POST['datenaissance']);
    $mdp = $_POST['mdp'];
    $sexe = $_POST['sexe'];
    
    if (isset($_POST['newsletter'])) {$newsletter = $_POST['newsletter'];}
    else {$newsletter = 0;}
    
    $sql = "SELECT MAX(adresse_id) AS ID FROM `adresse`";
    $reponse = $db->query($sql);
    $data = $reponse->fetch();
    
    $adresse_id = $data['ID'] + 1;
    
    $sql2 = "INSERT INTO `evenement`(`evenement_id`, `evenement_titre`, `evenement_utilisateur_id`, `evenement_adresse_id`,"
          . "`evenement_theme_id`, `evenement_date_debut`, `evenement_heure_debut`, `evenement_date_fin`, `evenement_heure_fin`,"
          . "`evenement_max_participants`, `evenement_type_public`, `evenement_site_web`, `evenement_tarif`)"
         . "VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13])";
    
    $sql2 = "INSERT INTO `adresse`(`adresse_id`, `adresse_numero_voie`, `adresse_ville`, `adresse_code_postal`, `adresse_pays`)"
         . "VALUES ('$adresse_id' ,'$voie' ,'$ville' ,'$codepostal' ,'$pays')";
    $reponse2 = $db->query($sql2);
    
    $sql3 = "INSERT INTO `utilisateur`(`utilisateur_id`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_email`,"
         . "`utilisateur_adresse_id`, `utilisateur_date_naissance`, `utilisateur_image_profil`, `utilisateur_mot_de_passe`,"
         . "`utilisateur_etat`, `utilisateur_type`, `utilisateur_sexe`, `utilisateur_newsletter`) VALUES"
         . "('' ,'$nom' ,'$prenom' ,'$email' ,'$adresse_id', '$datenaissance','' ,'$mdp' ,'' ,'' ,'$sexe' ,'$newsletter')";
    $reponse3 = $db->query($sql3);
}

echo "<script>location='accueil.php';</script>";

?>