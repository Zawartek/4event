<?php
    require ("configSQL.php");

    // fonction qui cherche le mot de passe d'un utilisateur avec un identifiant dans la base de données
    function infosEvent($db, $idEvent){
        
        // Recuperation de l'evenement
        $request = 'SELECT * FROM evenement e, utilisateur u, adresse a'
                . ' WHERE evenement_id=' . $idEvent . ' and '
                . ' u.utilisateur_id = e.evenement_utilisateur_id and '
                . 'a.adresse_id = e.evenement_adresse_id';
        $reponse = $db->query($request);
        if ($reponse !=null){
            $data = $reponse->fetch();
        
        $data['adresse'] = $data['adresse_numero_voie'] . ", "
                . $data['adresse_code_postal'] . " " 
                . $data['adresse_ville'];
        }
        else {
           // return null;
        }
        // Recuperation de l'organisateur
        
        
        return $data;
    }
    
?>