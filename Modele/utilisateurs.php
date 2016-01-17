<?php

require("configSQL.php");

// fonction qui cherche le mot de passe d'un utilisateur avec un identifiant dans la base de données
function mdp($db, $email) {
    $reponse = $db->query('SELECT * FROM utilisateur WHERE utilisateur_email="' . $email . '";');
    return $reponse;
}

// fonction qui cherche le mot de passe d'un utilisateur avec un identifiant dans la base de données
function utilisateurs($db) {
    $reponse = $db->query('SELECT * FROM utilisateur u, adresse a '
            . 'WHERE u.utilisateur_adresse_id = a.adresse_id ORDER BY utilisateur_nom');
    return $reponse->fetchAll();
}

function suppressionutil($db, $idUti) {
    $reponse = $db->query("delete from utilisateur where utilisateur_id = '$idUti'");
    return $reponse;
}

function infosUti($db, $idUti) {

    // Recuperation de l'utilisateur
    $request = 'SELECT * FROM utilisateur u, adresse a'
            . ' WHERE utilisateur_id=' . $idUti
            . ' and u.utilisateur_adresse_id = a.adresse_id;';
    $reponse = $db->query($request);
    $data = $reponse->fetch();

    if ($reponse != null) {
        // nombre d'événement inscrit
        $request = 'SELECT * '
                . 'FROM participation p, evenement e '
                . 'WHERE p.participation_utilisateur_id=' . $idUti . ' '
                . 'and p.participation_evenement_id = e.evenement_id;';
        $reponseIns = $db->query($request);
        $data['evenements'] = Array();
        while ($event = $reponseIns->fetch() and isset($event)) {
            $data['evenements'][] = $event;
        }
        $reponseIns->fetch();

        // nombre d'événement organisé
        $request = 'SELECT count(evenement_id) as nbEventOrga '
                . 'FROM evenement e '
                . 'WHERE e.evenement_utilisateur_id=' . $idUti . ';';
        $reponseOrg = $db->query($request);
        $data['nbEventOrga'] = $reponseOrg->fetch()['nbEventOrga'];

        // Commentaires postés
        $request = 'SELECT * FROM evenement e, avis a, utilisateur u'
                . ' WHERE u.utilisateur_id=' . $idUti . ' and '
                . 'a.avis_evenement_id = e.evenement_id and '
                . 'a.avis_utilisateur_id = u.utilisateur_id;';
        $reponseCom = $db->query($request);
        $data['commentaires'] = array();
        while ($com = $reponseCom->fetch() and isset($com)) {
            $data['commentaires'][] = $com;
        }
    }
    return $data;
}

function eventOrga($db, $idUti) {
    // nombre d'événement organisé
    $request = 'SELECT evenement_titre, evenement_id '
            . 'FROM evenement e '
            . 'WHERE e.evenement_utilisateur_id=' . $idUti . ';';
    $reponseOrg = $db->query($request);
    $data = Array();
    while ($event = $reponseOrg->fetch() and isset($event)) {
        $data[] = $event;
    }
    return $data;
}

function ajoutUtiBD($db, $nom, $prenom, $email, $voie, $codepostal, $ville, $pays
, $datenaissance, $mdp, $sexe, $etat, $type, $newsletter) {

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
            . "('' ,'$nom' ,'$prenom' ,'$email' ,'$adresse_id', '$datenaissance','' ,'$mdp' ,$etat ,$type ,'$sexe' ,'$newsletter')";
    $reponse3 = $db->query($sql3);
}

function modificationUtiBD($db, $idUti, $nom, $prenom, $email, $voie, $codepostal, $ville, $pays
, $datenaissance, $mdp, $sexe, $etat, $type, $newsletter) {
    $uti = infosUti($db, $idUti);
    if ($uti['adresse_numero_voie'] <> $voie || $uti['adresse_code_postal'] <> $codepostal || $uti['adresse_ville'] <> $ville || $uti['adresse_pays'] <> $pays) {
        $sql = "SELECT MAX(adresse_id) AS ID FROM `adresse`";
        $reponse = $db->query($sql);
        $data = $reponse->fetch();

        $sql2 = "UPDATE adresse "
                . "SET "
                . "`adresse_numero_voie`='$voie',"
                . "`adresse_ville`='$ville',"
                . "`adresse_code_postal`='$codepostal',"
                . "`adresse_pays`='$pays' "
                . "WHERE adresse_id=" . $uti['utilisateur_adresse_id']
                . "";
        $reponse2 = $db->query($sql2);
    }
    $mdpBDD = $db->query("select utilisateur_mot_de_passe from utilisateur where utilisateur_id=$idUti")->fetch()["utilisateur_mot_de_passe"];
    if ($mdp!=$mdpBDD){
        $mdp = md5($mdp);
    }
    $sql3 = "UPDATE utilisateur "
            . "SET "
            . "utilisateur_nom='" . $nom . "',"
            . "utilisateur_prenom='" . $prenom . "',"
            . "utilisateur_email='" . $email . "',"
            . "utilisateur_adresse_id='" . $uti['adresse_id'] . "',"
            . "utilisateur_date_naissance='" . $datenaissance . "',"
            . "utilisateur_image_profil='" . $nom . "',"
            . "utilisateur_mot_de_passe='" . $mdp . "',"
            . "utilisateur_etat='" . $etat . "',"
            . "utilisateur_type='" . $type . "',"
            . "utilisateur_sexe='" . $sexe . "',"
            . "utilisateur_newsletter='" . $newsletter . "' "
            . "WHERE utilisateur_id='" . $idUti . "'";
    $reponse3 = $db->query($sql3);
    echo $sql2 . "<br>" . $sql3;
}

function ajoutFavori($db, $idUti, $idTheme) {
    $sql1 = "INSERT INTO favori(favori_id, favori_utilisateur_id, favori_theme_id) VALUES ('',$idUti,$idTheme)";
    $reponse1 = $db->query($sql1);
}

function rechercheFavori($db, $idUti) {
    $sql1 = "SELECT favori_theme_id FROM favori WHERE favori_utilisateur_id = $idUti";
    $reponse1 = $db->query($sql1);

    $retour = "";
    while ($data1 = $reponse1->fetch()) {
        $retour .= $data1["favori_theme_id"] . ",";
    }

    if ($retour != "") {
        $retour = "(" . substr($retour, 0, -1) . ")";
    }

    return $retour;
}

function alertesUti($db, $idUti) {
    $sql1 = "SELECT alerte_id, evenement_titre FROM alerte, evenement WHERE alerte_utilisateur_id = $idUti and alerte_evenement_id = evenement_id";
    $reponse1 = $db->query($sql1);
    return $data1 = $reponse1->fetchAll();
}

?>