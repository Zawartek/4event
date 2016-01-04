<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <title>page événement</title>
        <link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">
        <?php include ('./Vue/map/getlatlng.php'); ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript">
            $(function () {
                var dialogParticipe
                dialogParticipe = $("#dialog-participe").dialog({
                    autoOpen: false,
                    height: 100,
                    width: 300,
                    modal: true,
                    position: {my: "center", at: "center", of: window},
                    close: function () {
                        form[ 0 ].reset();
                        allFields.removeClass("ui-state-error");
                    }
                });

                $("#btnParticipation").button().on("click", function () {
                    dialogParticipe.dialog("open");
                });
            });
            function loadMap() {
                initialize();
                geocode("<?php echo $event["adresse"]; ?>");
            }
        </script>
    </head>
    <body onload="loadMap()">
        <div id="content">
            <?php require("./Vue/header.php"); ?>
            <div id="profilEvent">
                <img id="photoProfil" src="./Vue/img/default-event.png" />
                <div id="infosProfil">
                    <p>
                        <?php echo $event["evenement_titre"]; ?>
                    </p>
                    <p>
                        Lieu : <span id="adresse"><?php echo $event["adresse"]; ?></span>
                    </p>
                </div>
            </div>
            <div id="infosEvent">
                <div id="infosOrganisateur">
                    <p>
                        Organisateur : <?php echo $event["utilisateur_nom"]; ?>
                    </p>
                    <p>
                        Nombres d'événements organisés : 
                        <?php echo $event["nbEvent"]; ?>
                    </p>
                    <a href='index.php?controle=utilisateur&action=afficherPageUti'>profil</a>
                </div>
                <?php if (isset($_SESSION['userID'])) { ?>
                    <div id="participationEvent">
                        <?php
                        if ($participation == 0) {
                            ?><a id="btnParticipation"
                               class="bold btn">Participer</a>

                            <a href="index.php?controle=evenement&action=ajoutInteret"
                               class="bold btn">Ajouter à ses interet</a>
                               <?php
                           } else {
                               echo '<a href="index.php?controle=evenement&action=annulerParticipation' .
                               '&param=' . $event['evenement_id'] .
                               '" class="bold btn">Annuler participation</a> ';
                           }
                       }
                       ?>
                </div>
            </div>
            <div id="clear"></div>
            <br>
            <div id ="descriptionEvent">
                <h1>Description</h1>
                <p>
                    <?php echo nl2br($event["evenement_description"]); ?>
                </p>

            </div>
            <div id="infosComplementairesEvent">
                <div id="infosLieu">
                    <h1>Plan</h1>
                    <div id="map">
                        <div id="map_canvas"></div>
                        <div id="crosshair"></div>
                    </div>
                    <div class="hidden">
                        <p id="formatedAddress"></p>
                        <div id="zoom_level"></div>
                    </div>
                </div>
                <br>
                <br>

                <div id="billeterie">
                    <h1>Billeterie</h1>
                    <a href= <?php echo "http://" . $event["evenement_site_web"]; ?> target="_blank">
                        Site Web                       
                    </a>
                </div>

            </div>
            <div id="clear"></div> 

            <div id="commentairesEvent" class="cadre">
                <h1>Commentaires</h1>
                <?php
                if (isset($event['commentaires'][0])) {
                    foreach ($event['commentaires'] as $com) {
                        ?>
                        <div class="cadre">
                            <p>
                                <?php echo nl2br($com['avis_contenu']); ?><br>
                            </p>
                            <p align="right">
                                écrit par <?php
                                echo $com['utilisateur_prenom'] .
                                ' ' . $com['utilisateur_nom'];
                                ?>
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
            <div id="clear"></div>
        </div>

        <div id="footer">

        </div>

        <div id="dialog-participe" title="Indiquer le nombre de participants!">
            <form method="post" action="index.php?controle=evenement&action=participer">
                <input type="hidden" name="controle" value="evenement"/>
                <input type="hidden" name="action" value="participer"/>
                <input type="hidden" name="idEvent" value="<?php echo $event['evenement_id'] ?>"/>
                <input type="number" min="1" name="nb" value="1"/>
                <input type="submit" value="Valider"/>
            </form>
        </div>
    </body>
</html>
