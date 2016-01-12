<?php

function formattageDate ($date, $type)
{
    // Format pour la BDD
    if ($type == "bdd")
    {
        $charResearch = "/";
        $charReplace = "-";
    }
    // Format pour l'affichage
    elseif ($type == "aff")
    {
        $charResearch = "-";
        $charReplace = "/";
    }
    
    $split = explode($charResearch, $date);
    return $dateBDD = $split[2].$charReplace.$split[1].$charReplace.$split[0]; 
}
?>