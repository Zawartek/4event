<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function afficherPageEvent(){
    require_once './Modele/evenements.php';
    $idEvent = 1;
    $event = infosEvent($db, $idEvent);
    include ("./Vue/pageEvent.php");
    
    
}
