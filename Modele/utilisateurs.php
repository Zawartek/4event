<?php

require("configSQL.php");

// fonction qui cherche le mot de passe d'un utilisateur avec un identifiant dans la base de données
function mdp($db, $email) {
    $reponse = $db->query('SELECT * FROM utilisateur WHERE utilisateur_email="' . $email . '";');
    return $reponse;
}

// fonction qui cherche le mot de passe d'un utilisateur avec un identifiant dans la base de données
function utilisateurs($db) {
    $reponse = $db->query('SELECT utilisateur_id FROM Utilisateurs');
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

?>
