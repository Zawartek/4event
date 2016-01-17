<?php
require('./Modele/configSQL.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>
        <link rel="icon" type="image/png" href="favicon.png">
    </head>
    <body>
        <div id="content">
            <?php require("./Vue/header.php"); ?>
            <div>
                <h2 class="text-orange" style=" text-align: center; margin: 15px 0px;">Le site de partage d'événements</h2>
            </div>

            <div id="slider">
                <?php include('./Vue/slider/slider.html'); ?>
            </div>
            <div id="clear"></div>
            <div id="listeRecherche">
                <div id="favoris">
                <?php
                $affichageTitre = 0;
                $affichageTitre2 = 0;
                $id = 1;
                if (isset($_SESSION["prenom_nom"]))
                {
                    $class = array ("couleurEvent1", "couleurEvent2");
                    if ($events[0] == 1)
                    {
                        echo "<h3>Aucun événement ne correspond a vos favoris.</h3>";
                        $affichageTitre2 = 1;
                    }
                    elseif ($events[0] !== NULL)
                    {
                        $affichageTitre = 1;
                        echo "<h3>Événements liés à vos Favoris :</h3>";
                        
                        foreach ($events[0] as $event)
                        { ?>
                            <div class="cadre <?php echo $class[$id]; ?>">
                                <form style="float: right;">
                                    <input type='hidden' name='controle' value='evenement'/>
                                    <input type='hidden' name='action' value='afficherPageEvent'/>
                                    <input type='hidden' name='param' value='<?php echo $event["evenement_id"]; ?>'/>
                                    <input type="submit" class="btn bold btn-orange" value="Afficher"/>
                                </form>
                                <p><?php echo formattageDate($event["evenement_date_debut"], "aff"); ?></p>
                                <div class="bold"><?php echo $event["evenement_titre"]; ?></div>

                                <div style="float: left; margin: 10px;">
                                    <img src="./Vue/img/<?php echo $event["miniature"]; ?>" height="100" width="100">
                                </div>

                                <textarea class="text-area description" disabled="disable"><?php echo $event["evenement_description"]; ?></textarea>

                                <div id="clear"></div>
                            </div>
                            <?php
                            $id = ($id == 1) ? 0 : 1;
                        }
                    }
                } ?>
                </div>
                <?php
                $class = array ("couleurEvent1", "couleurEvent2");
                if (sizeof($events[1]) == 0) { echo "<h3>Aucun événement trouvé.</h3>"; }
                else
                {
                    if ($affichageTitre == 1) { echo "<h3>Autres Événements à venir :</h3>"; }
                    elseif ($affichageTitre2 == 1) { echo "<h3>Voici d'autres Événements à venir :</h3>"; }
                    elseif(isset($_POST["dateRecherche"])) { echo "<h3>Voici les résultats de votre recherche :</h3>"; }
                    else { echo "<h3>Voici les Événements à venir :</h3>"; }
                    
                    foreach ($events[1] as $event)
                    { ?>
                        <div class="cadre <?php echo $class[$id]; ?>">
                            <form style="float: right;">
                                <input type='hidden' name='controle' value='evenement'/>
                                <input type='hidden' name='action' value='afficherPageEvent'/>
                                <input type='hidden' name='param' value='<?php echo $event["evenement_id"]; ?>'/>
                                <input type="submit" class="btn bold btn-orange" value="Afficher"/>
                            </form>
                            <p><?php echo formattageDate($event["evenement_date_debut"], "aff"); ?></p>
                            <div class="bold"><?php echo $event["evenement_titre"]; ?></div>
                            
                            <div style="float: left; margin: 10px;">
                                <img src="./Vue/img/<?php echo $event["miniature"]; ?>" height="100" width="100">
                            </div>

                            <textarea class="text-area description" disabled="disable"><?php echo $event["evenement_description"]; ?></textarea>
                            
                            <div id="clear"></div>
                        </div>
                        <?php
                        $id = ($id == 1) ? 0 : 1;
                    }
                }
                ?>
            </div>
        </div>
    </body>
    <?php include('./Vue/footer.php'); ?>
</html>