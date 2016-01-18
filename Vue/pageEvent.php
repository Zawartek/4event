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
        <title><?php echo $event["evenement_titre"]; ?></title>
        <link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">
        <?php include ('./Vue/map/getlatlng.php'); ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript">
            $(function () {
                initialize();
                geocode("<?php echo $event["adresse"]; ?>");

                var dialogParticipe
                dialogParticipe = $("#dialog-participe").dialog({
                    autoOpen: false,
                    height: 100,
                    width: 300,
                    modal: true,
                    resizable: false,
                    draggable: false,
                    position: {my: "center", at: "center", of: window},
                    close: function () {
                    }
                });
                $("#btnParticipation").button().on("click", function () {
                    dialogParticipe.dialog("open");
                });
                $("#btnInteret").button();

                // Lorsque le DOM est chargé on applique le Javascript $(document).ready(function() {
                // On ajoute la classe "js" à la liste pour mettre en place par la suite du code CSS uniquement dans le cas où le Javascript est activé
                $("ul.notes-echelle").addClass("js");
                // On passe chaque note à l'état grisé par défaut
                //$("ul.notes-echelle li").addClass("note-off");
                // Au survol de chaque note à la souris
                $("ul.notes-echelle li").mouseover(function () {
                    // On passe les notes supérieures à l'état inactif (par défaut)
                    $(this).nextAll("li").addClass("note-off");
                    // On passe les notes inférieures à l'état actif
                    $(this).prevAll("li").removeClass("note-off");
                    // On passe la note survolée à l'état actif (par défaut)
                    $(this).removeClass("note-off");
                });
                // Lorsque l'on sort du sytème de notation à la souris
                $("ul.notes-echelle").mouseout(function () {
                    // On passe toutes les notes à l'état inactif
                    $(this).children("li").addClass("note-off");
                    // On simule (trigger) un mouseover sur la note cochée s'il y a lieu
                    $(this).find("li input:checked").parent("li").trigger("mouseover");
                });
            });
        </script>
    </head>
    <body>
        <div class="container_event">
            <?php require("./Vue/header.php"); ?>
            <div id="profilEvent">
                <img id="photoProfil" src="./Vue/img/<?php echo $event["miniature"]; ?>" height="100" width="100">

                <div id="infosProfil">
                    <h1>
                        <?php echo $event["evenement_titre"]; ?>
                    </h1>
                    <p>Organisé par
                        <a href="index.php?controle=utilisateur&action=afficherPageUti&param=<?php echo $event["evenement_utilisateur_id"]; ?>">
                            <span class='bold'><?php echo $event["utilisateur_prenom"] . " " . $event["utilisateur_nom"]; ?></span>
                        </a>
                    </p>
                    <p>
                        Lieu : <span id="adresse"><?php echo $event["adresse"]; ?></span>
                    </p>
                    <p>
                        <?php echo "du ".formattageDate($event["evenement_date_debut"],"aff")." au ".formattageDate($event["evenement_date_fin"],"aff"); ?>
                    </p>
                    <p>
                        Horaires : <span><?php echo substr($event["evenement_heure_debut"],0 ,5)." - ".substr($event["evenement_heure_fin"],0 ,5); ?></span>
                    </p>
                </div>
                <div id="participationEvent">
                    <?php
                    if (isset($_SESSION['userID']))
                    {
                        if ($participation == 0)
                        { ?>
                            <a id="btnParticipation" class="bold btn">Participer</a>
                        <?php
                        }
                        else
                        {
                           echo '<a href="index.php?controle=evenement&action=annulerParticipation' .
                           '&param=' . $event['evenement_id'] .
                           '" class="bold btn">Annuler la participation</a> ';
                        }
                    }
                    else
                    {
                        echo "<p style='margin: 8px;'>Veuillez vous connecter pour<br>pouvoir participer a cet événement.</p>";
                    } ?>
                </div>
            </div>

            <div id ="descriptionEvent">
                <h1>DESCRIPTION</h1>
                <p class="justify">
                    <?php echo nl2br($event["evenement_description"]); ?>
                </p>
                <div id="billeterie">
                    <h1>LIENS</h1>
                    <?php
                    $rien = 1;
                    if ($event["evenement_site_web"] != "")
                    { 
                        $rien = 0;
                        ?>
                        <a href= <?php echo $event["evenement_site_web"]; ?> target="_blank" style="margin-right: 20px;">
                            Site de l'Événement
                        </a>
                        <?php
                    }
                    if ($event["evenement_tarif"] != "")
                    { 
                        $rien = 0;
                        ?>
                        <a href= <?php echo $event["evenement_tarif"]; ?> target="_blank">
                            Site de la Billetterie
                        </a>
                    <?php
                    }
                    if ($rien == 1)
                    {
                        echo "<p>Cet Événement n'a encore pas de liens associés.</p>";
                    } ?>
                </div>
            </div>
            <div id="infosComplementairesEvent">
                <div id="infosLieu">
                    <h1>PLAN</h1>
                    <div id="map">
                        <div id="map_canvas"></div>
                        <div id="crosshair"></div>
                    </div>
                    <div class="hidden">
                        <p id="formatedAddress"></p>
                        <div id="zoom_level"></div>
                    </div>
                </div>

            </div>
            <div id="clear"></div>
            <div class="cadre">
                <h1>DONNEZ VOTRE AVIS !</h1>
                <form method="POST" action="index.php?controle=evenement&action=ajoutAvis">
                    <table>
                        <tr>
                            <td>
                                <ul class="notes-echelle">
                                    <li>
                                        <label for="note01" title="Note&nbsp;: 1 sur 5">&nbsp;</label>
                                        <input id="note01" name="noteAvis" type="radio" value="1"/>
                                    </li>
                                    <li>
                                        <label for="note02" title="Note&nbsp;: 2 sur 5">&nbsp;</label>
                                        <input id="note02" name="noteAvis" type="radio" value="2"/>
                                    </li>
                                    <li>
                                        <label for="note03" title="Note&nbsp;: 3 sur 5">&nbsp;</label>
                                        <input id="note03" name="noteAvis" type="radio" value="3"/>
                                    </li>
                                    <li>
                                        <label for="note04" title="Note&nbsp;: 4 sur 5">&nbsp;</label>
                                        <input id="note04" name="noteAvis" type="radio" value="4"/>
                                    </li>
                                    <li>
                                        <label for="note05" title="Note&nbsp;: 5 sur 5">&nbsp;</label>
                                        <input id="note05" name="noteAvis" type="radio" value="5" checked="true"/>
                                    </li>
                                </ul>
                                <div id="clear"></div>
                            </td>
                            <td rowspan="2">
                                <textarea name="avis" style="width:600px; height:100px; margin-left:50px; resize: none"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <input type="hidden" name="idEvent" value="<?php echo $event['evenement_id']; ?>"/>
                                <?php
                                if (isset($_SESSION['userID']))
                                { ?>
                                    <input style="margin-right:16px;" type="submit" value="envoyer"/>
                                <?php
                                }
                                else { echo "<p>Veuillez vous connecter pour donner votre avis.</p>"; }
                                ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div id="commentairesEvent" class="cadre">
                <h1>COMMENTAIRES</h1>
                <?php
                if (isset($event['commentaires'][0])) {
                    foreach ($event['commentaires'] as $com) {
                        ?>
                        <div class="cadre" style="width:830px;">
                            <p style="margin-left: 0px;">
                                <?php
                                for ($i = 0; $i < 5; $i++) {
                                    if ($i < $com['avis_note']) {
                                        echo "<img class='noteCom' src='./Vue/img/etoileCom.png'  style='height:auto'/>";
                                    } else {
                                        echo "<img class='noteCom' src='./Vue/img/etoileComBlanc.png'  style='height:auto'/>";
                                    }
                                }
                                ?>
                            </p>
                            <br/>
                            <textarea class="text-area comContenu" disabled="true"><?php echo $com['avis_contenu']; ?></textarea>

                            <p align="right">écrit par
                                <a href="index.php?controle=utilisateur&action=afficherPageUti&param=<?php echo $com["utilisateur_id"]; ?>" style="margin: 0px;">
                                    <span class='bold'><?php echo $com["utilisateur_prenom"] . " " . $com["utilisateur_nom"]; ?></span>
                                </a>
                            </p>
                        </div>
                        <br>
                        <?php
                    }
                } else {
                    echo '<p> Aucun commentaire n\'a été ajouté pour le moment. Soyez le premier à laisser votre avis ! </p>';
                }
                ?>
            </div>
            <div id="clear"></div>
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
    <div><?php include('./Vue/footer.php'); ?></div>
</html>