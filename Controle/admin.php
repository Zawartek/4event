<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function afficherPageAdminGU(){
    require './Modele/utilisateurs.php';
    $utilisateurs = utilisateurs($db);
    include ("./Vue/Admin/GestionUtilisateur.php");
}

function afficherPageAdminGE(){
    include ("./Vue/Admin/GestionEvent.php");
}

function afficherPageAdminGF(){
    include ("./Vue/Admin/GestionForum.php");
}
