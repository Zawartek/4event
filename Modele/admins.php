<?php
require ("configSQL.php");

function ajoutFAQBD($db,$question, $reponse, $idAdmin)
{
    $sql = $db->prepare('INSERT INTO faq SET faq_question = :question, faq_reponse = :reponse, faq_utilisateur_id = :idAdmin, faq_id = :id');

    $sql->bindValue(':question', $question, PDO::PARAM_STR);
    $sql->bindValue(':reponse', $reponse, PDO::PARAM_STR);
    $sql->bindValue(':idAdmin', $idAdmin);
    $sql->bindValue(':id', '');

    $sql->execute();
}

function modificationFAQBD($db,$id, $question, $reponse, $idAdmin)
{
    $sql = $db->prepare('UPDATE faq SET faq_question = :question, faq_reponse = :reponse, faq_utilisateur_id = :idAdmin WHERE faq_id = :id');
    
    $sql->bindValue(':question', $question, PDO::PARAM_STR);
    $sql->bindValue(':reponse', $reponse, PDO::PARAM_STR);
    $sql->bindValue(':idAdmin', $idAdmin);
    $sql->bindValue(':id', $id);

    $sql->execute();
}

function suppressionFAQBD($db,$idFaq)
{
    $reponse = $db->query("DELETE FROM faq WHERE faq_id = '$idFaq'");
    return $reponse->fetchAll();
}

function FAQ($db)
{
    $reponse = $db->query("SELECT * FROM faq");
    return $reponse->fetchAll();

}

?>
