<?php

require("configSQL.php");

// fonction qui cherche le mot de passe d'un utilisateur avec un identifiant dans la base de données
function mdp($db, $identifiant) {
    $reponse = $db->query('SELECT utilisateur_id, utilisateur_mot_de_passe FROM Utilisateurs WHERE identifiant="' . $identifiant . '"');
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
        $request = 'SELECT count(participation_evenement_id) as nbEventInscrit '
                . 'FROM participation p '
                . 'WHERE p.participation_utilisateur_id=' . $idUti . ';';
        $reponse = $db->query($request);
        $data['nbEventInscrit'] = $reponse->fetch()['nbEventInscrit'];
        
        // nombre d'événement organisé
        $request = 'SELECT count(evenement_id) as nbEventOrga '
                . 'FROM evenement e '
                . 'WHERE e.evenement_utilisateur_id=' . $idUti . ';';
        $reponse = $db->query($request);
        $data['nbEventOrga'] = $reponse->fetch()['nbEventOrga'];
    }
    return $data;
}

?>
