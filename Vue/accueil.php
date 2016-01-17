<?php
require('./Modele/configSQL.php');
if (isset($_POST["date"]))
    $date = formattageDate ($_POST["date"],"bdd");
else
    $date = date("Y-m-d");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>
        <link rel="icon" type="image/png" href="favicon.png">

        <!-- appels pour datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="./Vue/js/datepicker.js"></script>

        <script type="text/javascript">
            $(function ()
            {
                $("#date").datepicker($.datepicker.regional["fr"]);
                $("#date").datepicker('setDate', new Date(<?php echo json_encode($date); ?>));
            });
        </script>
    </head>
    <body>
        <div id="content">
            <?php require("./Vue/header.php"); ?>
            <div>
                <h2 class="text-orange" style=" text-align: center; margin-top: 7px; ">Le site de partage d'événements</h2>
            </div>

            <div id="slider">
                <?php include('./Vue/slider/slider.html'); ?>

                <form id="barreRecherche" method="post" action="index.php?controle=utilisateur&action=accueil">
                    <select id="choixTheme" name="choixTheme" class="input">
                        <option value="0">Tous</option>
                        <?php
                        foreach ($themes as $theme)
                        {
                            echo '<option value="' . $theme["theme_id"] . '">' . $theme["theme_nom"] . '</option>';
                        } ?>
                    </select>
                    <input type="text" id="date" name="date" class="date" readonly="readonly">
                    <input type="submit" id="valider" class="bold btn btn-orange" value="Rechercher">
                </form>
            </div>
            <div id="clear"></div>
            <div id="listeRecherche">
                <?php
                $id = 1;
                $class = array ("couleurEvent1", "couleurEvent2");
                if (sizeof($events) == 0) {
                    echo "<p align='center'>Aucun événement trouvé.</p>";
                }
                else
                {
                    foreach ($events as $event)
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
                } ?>
            </div>
        </div>
    </body>
    <?php include('./Vue/footer.php'); ?>
</html>
