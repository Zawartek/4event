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
            echo $com['avis_id'];
        }
    } else {
        // return null;
    }
    // Recuperation de l'organisateur


    return $data;
}

function participerBD($db, $idEvent, $idUti)
{
    // Recuperation de l'evenement
    $request = 'INSERT INTO participation '
            . 'VALUES (' . $idUti . ',' . $idEvent . ');';
    $reussite = $db->exec($request);
    echo $reussite;
}

?>