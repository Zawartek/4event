<?php

require ("configSQL.php");

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
                . 'WHERE u.utilisateur_id = '. $data['evenement_utilisateur_id']
                . ' and '
                . 'u.utilisateur_id = e.evenement_utilisateur_id ' .';';
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
    } else {
        // return null;
    }
    // Recuperation de l'organisateur


    return $data;
}

function annulerParticipationBD($db, $idEvent, $idUti)
{
    // Recuperation de l'evenement
    $request = 'DELETE FROM participation '
            . 'WHERE participation_utilisateur_id=' . $idUti . 
            ' and participation_evenement_id=' . $idEvent . ';';
    $reussite = $db->exec($request);
    echo $reussite;
}

function participerBD($db, $idEvent, $idUti,$nb)
{
    // Recuperation de l'evenement
    $request = 'INSERT INTO participation '
            . 'VALUES (' . $idUti . ',' . $idEvent . ', '. $nb . ');';
    $reussite = $db->exec($request) or die (utf8_encode("erreur de requête : ") . $request);;
    echo "test" . $reussite;
}

function participe($db, $idUti, $idEvent)
{
    // Recuperation de l'evenement
    $request = 'SELECT count(*) as nb FROM participation '
            . 'WHERE participation_utilisateur_id=' . $idUti . 
            ' and participation_evenement_id=' . $idEvent . ';';
    $reponse = $db->query($request);
    return $reponse->fetch()['nb'];
}

function rechercheBD($db, $date, $theme){
    if ($theme=="0"){
        $sql = $db->prepare("SELECT * FROM `evenement` WHERE evenement_date_debut > :date");
    }
    else {
        $sql = $db->prepare("SELECT * FROM `evenement` WHERE evenement_date_debut > :date AND evenement_theme_id = :theme");
    }
    $sql->bindValue(':date', $date);
    if ($theme<>"0"){
        $sql->bindValue(':theme', $theme, PDO::PARAM_STR);
    }
    $sql->execute();
    $data = $sql->fetchAll();
    
    return $data;
}

function rechercheEvent($condition, $db)
{
    $sql1 = "SELECT evenement_id, evenement_titre, evenement_description, evenement_utilisateur_id,evenement_theme_id FROM `evenement` $condition";
    $events = array(array());
    $i = 0;

    $reponse1 = $db->query($sql1);

    while ($data1 = $reponse1->fetch())
    {
        $evenement_id = $data1["evenement_id"];

        $events[$i]["evenement_id"] = $evenement_id;
        $events[$i]["evenement_titre"] = $data1["evenement_titre"];
        $events[$i]["evenement_description"] = $data1["evenement_description"];
        $events[$i]["evenement_utilisateur_id"] = $data1["evenement_utilisateur_id"];
        $events[$i]["evenement_theme_id"] = $data1["evenement_theme_id"];

        $sql2 = "SELECT media_url FROM `media` WHERE media_evenement_id = $evenement_id AND media_type = 0 AND media_miniature = 1";
        $reponse2 = $db->query($sql2);
        $data2 = $reponse2->fetch();

        $sql3 = "SELECT theme_miniature FROM `theme` WHERE theme_id = ".$data1["evenement_theme_id"];
        $reponse3 = $db->query($sql3);
        $data3 = $reponse3->fetch();

        $events[$i]["miniature"] = ($data2["media_url"] == NULL) ? "logoTheme/".$data3["theme_miniature"] : "event/".$data2["media_url"];

        $i ++;
    }
    
    if (!isset($events[0]["evenement_id"])) { return NULL; }
    else { return $events; }
}
?>