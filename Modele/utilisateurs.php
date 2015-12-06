<?php
    require("configSQL.php");

    // fonction qui cherche le mot de passe d'un utilisateur avec un identifiant dans la base de données
    function mdp($db,$identifiant){
        $reponse = $db->query('SELECT utilisateur_id, utilisateur_mot_de_passe FROM Utilisateurs WHERE identifiant="'.$identifiant.'"');
        return $reponse;
    }

    // fonction qui cherche le mot de passe d'un utilisateur avec un identifiant dans la base de données
    function utilisateurs($db){
        $reponse = $db->query('SELECT utilisateur_id FROM Utilisateurs');
        return $reponse;
    }

    
?>
