<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>profil utilisateur</title>
        <link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css"> 
    </head>
    <body>
        <div id="content">
            <?php require("./Vue/header.php"); ?>
            <div id="profil">
                <img id="photoProfil" src="./Vue/img/default-user.png" />
                <div id="infosProfil">
                    <p><?php echo $uti['utilisateur_prenom'] . " " . $uti['utilisateur_nom'] ?></p>
                    <p><?php echo $uti['adresse_ville'] ?></p>
                    <p>Evenements inscrits : <?php echo sizeof($uti['evenements']); ?></p>
                    <p>Evenements organisés : <?php echo $uti['nbEventOrga'] ?></p>
                </div>
                <div id="clear"></div>
            </div>
            <br>
            <div id="infosComplementaires">
                <div id="agenda">
                    <p class="titre">Agenda</p>
                    
                    <?php
                    if (sizeof($uti['evenements'])>0){
                    foreach ($uti['evenements'] as $event){
                        ?>
                    <a class="eventProfil" 
                       href="<?php echo "index.php?controle=evenement"
                       . "&action=afficherPageEvent"
                               . "&param=" . $event['evenement_id'];?>"> 
                           <?php echo $event["evenement_titre"] ?>
                    </a>
                    <br>
                    <?php
                    }
                    }
                    else {
                        echo "<p>aucun événément de prévu dans l'agenda</p>";
                    }
                    ?>
                </div>
                <div id="orga">
                    <p class="titre">Evénements organisés</p>
                    
                    <?php
                    if (sizeof($uti['eventOrga'])>0){
                    foreach ($uti['eventOrga'] as $event){
                        ?>
                    <a class="eventProfil" 
                       href="<?php echo "index.php?controle=evenement"
                       . "&action=afficherPageEvent"
                               . "&param=" . $event['evenement_id'];?>"> 
                           <?php echo $event["evenement_titre"] ?>
                    </a>
                    <br>
                    <?php
                    }
                    }
                    else {
                        echo "<p>aucun événément n'a été organisé.</p>";
                    }
                    ?>
                </div>
                <div id="clear"></div>
                <div id="commentaires">
                    <p class="titre">Commentaires</p>
                    <?php
                if (isset($uti['commentaires'][0])) {
                    foreach ($uti['commentaires'] as $com) {
                        ?>
                        <div class="cadre">
                            <textarea class="text-area comContenu" disabled="true"><?php echo $com['avis_contenu']; ?></textarea>
                            <p align="right">
                                écrit par <?php
                                echo $com['utilisateur_prenom'] .
                                ' ' . $com['utilisateur_nom'];
                                ?>
                            </p>
                            <p align="right">
                                <?php echo  '<a href="index.php?'.
                                    'controle=evenement&'.
                                        'action=afficherPageEvent'.
                                        '&param='.$com["evenement_id"].'">'.
                                    'Aller à l\'événement'.
                                '</a>'?>
                            </p>
                        </div>
                        <br>
                        <?php
                    }
                } else {
                    echo '<p> aucun commentaire n\'a été ajouté</p>';
                }
                ?>
                </div>
            </div>
        </div>    
        
        <div id="footer">
            
        </div>
    </body>
</html>
