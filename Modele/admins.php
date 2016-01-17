<?php
require ("configSQL.php");

function verifAdminBD($db, $idUti){
    return $db->query("SELECT utilisateur_type FROM utilisateur where utilisateur_id=$idUti")=='2';
}

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

function ThemesBD($db){
    $reponse = $db->query("SELECT * FROM theme");
    return $reponse->fetchAll();
}

function ajoutThemeBD($db,$nom,$miniature){
    $request ="INSERT INTO theme (theme_nom,theme_miniature) VALUES('$nom','$miniature')";
    $reponse = $db->query($request);
}

function modificationThemeBD($db,$id,$nom,$miniature){
    $request ="UPDATE theme SET theme_nom='$nom',theme_miniature='$miniature' WHERE theme_id = '$id'";
    echo $request;
    $reponse = $db->query($request);
}

function getMiniature($db,$idTheme){
    $sql=" Select theme_miniature FROM theme where theme_id=$idTheme";
    $reponse=$db->query($sql);
    return $reponse->fetch()['theme_miniature'];
}

function suppressionThemeBD($db,$idTheme)
{
    $reponse = $db->query("DELETE FROM theme WHERE theme_id = '$idTheme'");
    return $reponse->fetchAll();
}
?>
