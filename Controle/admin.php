<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function afficherPageAdminGU() {
    require './Modele/utilisateurs.php';
    $utilisateurs = utilisateurs($db);
    include ("./Vue/Admin/gestionUtilisateur.php");
}

function afficherPageAdminGE() {
    include ("./Vue/Admin/gestionEvent.php");
}

function afficherPageAdminGF() {
    include ("./Vue/Admin/gestionForum.php");
}

function gestionUti() {
    require './Modele/utilisateurs.php';
    $idUti = $_POST['id'];
    if (isset($_POST['SUPPR'])) {
        
    } else {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $voie = htmlspecialchars($_POST['voie']);
        $codepostal = htmlspecialchars($_POST['codepostal']);
        $ville = htmlspecialchars($_POST['ville']);
        $pays = htmlspecialchars($_POST['pays']);
        $datenaissance = $_POST['annee']."-".$_POST['mois']."-".$_POST['jour'];
        $mdp = htmlspecialchars($_POST['mdp']);
        $sexe = htmlspecialchars($_POST['sexe']);
        $etat=$_POST['etat'];
        $type=$_POST['type'];
        $newsletter=0;
        if (isset($_POST['ADD'])) {
            ajoutUtiBD($db, $nom, $prenom, $email, $voie, $codepostal, $ville, $pays
                    , $datenaissance, $mdp, $sexe, $etat, $type, $newsletter);
        } else if (isset($_POST['MOD'])) {
            modificationUtiBD($db, $idUti, $nom, $prenom, $email, $voie, $codepostal, $ville, $pays
                    , $datenaissance, $mdp, $sexe, $etat, $type, $newsletter);
            
            header('Location: index.php?controle=admin&action=afficherPageAdminGU');
        }
    }
}
