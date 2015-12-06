<?php

function formattageDateBDD ($date)
{
    $split = explode("/", $date);
    return $dateBDD = $split[2]."-".$split[1]."-".$split[0]; 
}

?>