<?php

require ("configSQL.php");
function ajoutFAQBD($titre, $description,$idAdmin)
{
    global $db;
    $reponse = $db->query("insert into faq (faq_id, faq_question, faq_reponse, faq_utilisateur_id) values ('', '$titre', '$description', '$idAdmin')");
    return $reponse;
}
function modificationFAQBD($id, $titre, $description,$idAdmin) 
{
    global $db;
    $reponse = $db->query("update faq set faq_question ='$titre', faq_reponse='$description', faq_utilisateur_id='$idAdmin' where faq_id=$id");
    return $reponse;  
}

function suppressionFAQBD( $id)
{
    global $db;
    $reponse = $db->query("delete from fas where id = '$id'");
    return $reponse;  
}
?>