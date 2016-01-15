<?php
require ("configSQL.php");

function ajoutFAQBD($db,$question, $reponse, $idAdmin)
{
    $reponse = $db->query("insert into faq (faq_id, faq_question, faq_reponse, faq_utilisateur_id) values ('', '$question', '$reponse', '$idAdmin')");
    return $reponse->fetchAll();
}

function modificationFAQBD($db,$id, $question, $reponse, $idAdmin) 
{   
    $reponse = $db->query("update faq set faq_question ='$question', faq_reponse='$reponse', faq_utilisateur_id='$idAdmin' where faq_id=$id");
    return $reponse->fetchAll(); 
}

function suppressionFAQBD($db,$idFaq)
{   
    $reponse = $db->query("delete from faq where faq_id = '$idFaq'");
    return $reponse->fetchAll();
}

function FAQ($db)
{   
    $reponse = $db->query("select * from faq");
    return $reponse->fetchAll();
      
}

?>
