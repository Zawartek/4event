<?php

require ("configSQL.php");

function modificationeventBD($db, $evenement_id, $evenement_titre, $evenement_description, $evenement_utilisateur_id, $evenement_theme_id, $evenement_date_debut, $evenement_heure_debut, $evenement_date_fin, $evenement_heure_fin, $evenement_max_participants, $evenement_type_public, $evenement_site_web, $evenement_tarif) {
    $sql = $db->prepare('UPDATE evenement SET evenement_titre = :titre, evenement_description = :description, evenement_utilisateur_id = :user_id,'
            . 'evenement_theme_id = :theme, evenement_date_debut = :dateDebut, evenement_heure_debut = :heureDebut,'
            . 'evenement_date_fin = :dateFin, evenement_heure_fin = :heureFin, evenement_max_participants = :maxParticipants, evenement_type_public = :typePublic,'
            . 'evenement_site_web = :siteWeb, evenement_tarif = :tarif WHERE evenement_id = :evenement_id');

    $sql->bindValue(':evenement_id', $evenement_id);
    $sql->bindValue(':titre', "$evenement_titre", PDO::PARAM_STR);
    $sql->bindValue(':description', "$evenement_description", PDO::PARAM_STR);
    $sql->bindValue(':user_id', $evenement_utilisateur_id);
    $sql->bindValue(':theme', $evenement_theme_id);
    $sql->bindValue(':dateDebut', $evenement_date_debut);
    $sql->bindValue(':heureDebut', $evenement_heure_debut);
    $sql->bindValue(':dateFin', $evenement_date_fin);
    $sql->bindValue(':heureFin', $evenement_heure_fin);
    $sql->bindValue(':maxParticipants', $evenement_max_participants);
    $sql->bindValue(':typePublic', $evenement_type_public);
    $sql->bindValue(':siteWeb', $evenement_site_web, PDO::PARAM_STR);
    $sql->bindValue(':tarif', $evenement_tarif, PDO::PARAM_STR);

    $sql->execute();
}

function insertionEventBD($db, $evenement_titre, $evenement_description, $evenement_utilisateur_id, $evenement_theme_id, $evenement_date_debut, $evenement_heure_debut, $evenement_date_fin, $evenement_heure_fin, $evenement_max_participants, $evenement_type_public, $evenement_site_web, $evenement_tarif, $evenement_adresse_id) {
    $sql = $db->prepare('INSERT INTO evenement SET evenement_id = :evenement_id, evenement_titre = :titre, evenement_description = :description,'
            . 'evenement_utilisateur_id = :user_id, evenement_adresse_id = :adresse_id, evenement_theme_id = :theme, evenement_date_debut = :dateDebut,'
            . 'evenement_heure_debut = :heureDebut, evenement_date_fin = :dateFin, evenement_heure_fin = :heureFin,'
            . 'evenement_max_participants = :maxParticipants, evenement_type_public = :typePublic, evenement_site_web = :siteWeb, evenement_tarif = :tarif');

    $sql->bindValue(':evenement_id', NULL);
    $sql->bindValue(':titre', "$evenement_titre", PDO::PARAM_STR);
    $sql->bindValue(':description', "$evenement_description", PDO::PARAM_STR);
    $sql->bindValue(':user_id', $evenement_utilisateur_id);
    $sql->bindValue(':adresse_id', $evenement_adresse_id);
    $sql->bindValue(':theme', $evenement_theme_id);
    $sql->bindValue(':dateDebut', $evenement_date_debut);
    $sql->bindValue(':heureDebut', $evenement_heure_debut);
    $sql->bindValue(':dateFin', $evenement_date_fin);
    $sql->bindValue(':heureFin', $evenement_heure_fin);
    $sql->bindValue(':maxParticipants', $evenement_max_participants);
    $sql->bindValue(':typePublic', $evenement_type_public);
    $sql->bindValue(':siteWeb', $evenement_site_web, PDO::PARAM_STR);
    $sql->bindValue(':tarif', $evenement_tarif, PDO::PARAM_STR);

    $sql->execute();
}

function modificationadresseBD($db, $adresse_id, $adresse_numero_voie, $adresse_ville, $adresse_code_postal, $adresse_pays) {
    $sql = $db->prepare('UPDATE adresse SET adresse_numero_voie = :voie, adresse_ville = :ville,'
            . 'adresse_code_postal = :codepostal, adresse_pays = :pays WHERE adresse_id = :adresse_id');

    $sql->bindValue(':adresse_id', $adresse_id);
    $sql->bindValue(':voie', $adresse_numero_voie, PDO::PARAM_STR);
    $sql->bindValue(':ville', $adresse_ville, PDO::PARAM_STR);
    $sql->bindValue(':codepostal', $adresse_code_postal);
    $sql->bindValue(':pays', $adresse_pays, PDO::PARAM_STR);

    $sql->execute();
}

function insertionAdresseBD($db, $adresse_numero_voie, $adresse_ville, $adresse_code_postal, $adresse_pays) {
    $sql = "SELECT MAX(adresse_id) AS ID FROM `adresse`";
    $reponse = $db->query($sql);
    $data = $reponse->fetch();

    $adresse_id = $data['ID'] + 1;

    $sql2 = $db->prepare('INSERT INTO adresse SET adresse_id = :adresse_id, adresse_numero_voie = :voie, adresse_ville = :ville,'
            . 'adresse_code_postal = :codepostal, adresse_pays = :pays');

    $sql2->bindValue(':adresse_id', $adresse_id);
    $sql2->bindValue(':voie', $adresse_numero_voie, PDO::PARAM_STR);
    $sql2->bindValue(':ville', $adresse_ville, PDO::PARAM_STR);
    $sql2->bindValue(':codepostal', $adresse_code_postal);
    $sql2->bindValue(':pays', $adresse_pays, PDO::PARAM_STR);

    $sql2->execute();

    return $adresse_id;
}

function adresseByEventBD($db, $evenement_id) {
    $reponse = $db->query("select evenement_adresse_id from evenement where evenement_id='$evenement_id'");
    $data = $reponse->fetch();
    return $data["evenement_adresse_id"];
}

function suppressioneventBD($db, $evenement_id) {
    $reponse = $db->query("delete from evenement where evenement_id = '$evenement_id'");
    return $reponse->fetchAll();
}

function events($db) {
    $reponse = $db->query("select * from evenement, adresse where evenement_adresse_id=adresse_id");
    return $reponse->fetchAll();
}

// fonction qui cherche le mot de passe d'un utilisateur avec un identifiant dans la base de données
function infosEvent($db, $idEvent) {

    // Recuperation de l'evenement
    $request = 'SELECT * FROM evenement e, utilisateur u, adresse a'
            . ' WHERE evenement_id=' . $idEvent . ' and '
            . ' u.utilisateur_id = e.evenement_utilisateur_id and '
            . 'a.adresse_id = e.evenement_adresse_id';
    $reponse = $db->query($request);
    if ($reponse != null) {
        $data = $reponse->fetch();

        $request = 'SELECT count(e.evenement_id) as nbEvent '
                . 'FROM utilisateur u, evenement e '
                . 'WHERE u.utilisateur_id = ' . $data['evenement_utilisateur_id']
                . ' and '
                . 'u.utilisateur_id = e.evenement_utilisateur_id ' . ';';
        $reponse = $db->query($request);
        $data['nbEvent'] = $reponse->fetch()['nbEvent'];

        // ajout des commentaires
        $data['adresse'] = $data['adresse_numero_voie'] . ", "
                . $data['adresse_code_postal'] . " "
                . $data['adresse_ville'];
        $request = 'SELECT * FROM evenement e, avis a, utilisateur u'
                . ' WHERE evenement_id=' . $idEvent . ' and '
                . 'a.avis_evenement_id = e.evenement_id and '
                . 'a.avis_utilisateur_id = u.utilisateur_id;';
        $reponse = $db->query($request);
        $data['commentaires'] = array();
        while ($com = $reponse->fetch() and isset($com)) {
            $data['commentaires'][] = $com;
        }

        $sql2 = "SELECT media_url FROM `media` WHERE media_evenement_id = $idEvent AND media_type = 0 AND media_miniature = 1";
        $reponse2 = $db->query($sql2);
        $data2 = $reponse2->fetch();

        $sql3 = "SELECT theme_miniature FROM `theme` WHERE theme_id = " . $data["evenement_theme_id"];
        $reponse3 = $db->query($sql3);
        $data3 = $reponse3->fetch();

        $data["miniature"] = ($data2["media_url"] == NULL) ? "logoTheme/" . $data3["theme_miniature"] : "event/" . $data2["media_url"];
    } else {
        // return null;
    }
    // Recuperation de l'organisateur


    return $data;
}

function annulerParticipationBD($db, $idEvent, $idUti) {
    // Recuperation de l'evenement
    $request = 'DELETE FROM participation '
            . 'WHERE participation_utilisateur_id=' . $idUti .
            ' and participation_evenement_id=' . $idEvent . ';';
    $reussite = $db->exec($request);
    echo $reussite;
}

function participerBD($db, $idEvent, $idUti, $nb) {
    $request = 'INSERT INTO participation '
            . 'VALUES (' . $idUti . ',' . $idEvent . ', ' . $nb . ');';
    return $reussite = $db->exec($request);
    
}

function participe($db, $idUti, $idEvent) {
    $request = 'SELECT count(*) as nb FROM participation '
            . 'WHERE participation_utilisateur_id=' . $idUti .
            ' and participation_evenement_id=' . $idEvent . ';';
    $reponse = $db->query($request);
    return $reponse->fetch()['nb'];
}

function rechercheBD($db, $date, $theme) {
    if ($theme == "0") {
        $sql = $db->prepare("SELECT * FROM `evenement` WHERE evenement_date_debut > :date");
    } else {
        $sql = $db->prepare("SELECT * FROM `evenement` WHERE evenement_date_debut > :date AND evenement_theme_id = :theme");
    }
    $sql->bindValue(':date', $date);
    if ($theme <> "0") {
        $sql->bindValue(':theme', $theme, PDO::PARAM_STR);
    }
    $sql->execute();
    $data = $sql->fetchAll();

    return $data;
}

function rechercheEvent($condition, $db) {
    $sql1 = "SELECT evenement_id, evenement_titre, evenement_description, evenement_utilisateur_id,evenement_theme_id, evenement_date_debut FROM `evenement` $condition ORDER BY evenement_date_debut";
    $events = array(array());
    $i = 0;

    $reponse1 = $db->query($sql1);

    while ($data1 = $reponse1->fetch()) {
        $evenement_id = $data1["evenement_id"];

        $events[$i]["evenement_id"] = $evenement_id;
        $events[$i]["evenement_titre"] = $data1["evenement_titre"];
        $events[$i]["evenement_description"] = $data1["evenement_description"];
        $events[$i]["evenement_utilisateur_id"] = $data1["evenement_utilisateur_id"];
        $events[$i]["evenement_theme_id"] = $data1["evenement_theme_id"];
        $events[$i]["evenement_date_debut"] = $data1["evenement_date_debut"];

        $sql2 = "SELECT media_url FROM `media` WHERE media_evenement_id = $evenement_id AND media_type = 0 AND media_miniature = 1";
        $reponse2 = $db->query($sql2);
        $data2 = $reponse2->fetch();

        $sql3 = "SELECT theme_miniature FROM `theme` WHERE theme_id = " . $data1["evenement_theme_id"];
        $reponse3 = $db->query($sql3);
        $data3 = $reponse3->fetch();

        $events[$i]["miniature"] = ($data2["media_url"] == NULL) ? "logoTheme/" . $data3["theme_miniature"] : "event/" . $data2["media_url"];

        $i ++;
    }

    if (!isset($events[0]["evenement_id"])) {
        return NULL;
    } else {
        return $events;
    }
}

function ajoutAvisBD($db, $note, $avis, $idUser, $idEvent) {
    $request = 'INSERT INTO avis (avis_utilisateur_id, avis_evenement_id, avis_contenu, avis_note) '
            . 'VALUES (' . $idUser . ',' . $idEvent . ', "' . $avis . '",' . $note . ');';
    $reussite = $db->exec($request) or die(utf8_encode("erreur de requête : ") . $request);
}

?>