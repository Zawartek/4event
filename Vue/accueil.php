<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require('./Modele/configSQL.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>

        <!-- appels pour datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="./Vue/js/datepicker.js"></script>

        <script type="text/javascript">
            $(function ()
            {
                $("#date").datepicker($.datepicker.regional["fr"]);
                $("#date").datepicker('setDate', new Date());
            });
        </script>
    </head>
    <body>
        <div id="content">
            <?php require("./Vue/header.php"); ?>
            <div>
                <h1 class="text-orange" style=" text-align: center;">Le site de partage d'événements</h1>
            </div>

            <div id="slider">
                <?php include('./Vue/slider/slider.html'); ?>

                <form id="barreRecherche" method="post" action="index.php?controle=utilisateur&action=accueil">
                    <select id="choixTheme" name="choixTheme" class="input">
                        <option value="0">Tous</option>
                        <?php
                        foreach ($themes as $theme) {
                            echo '<option value="' . $theme["theme_id"] . '">' . $theme["theme_nom"] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" id="date" name="date" class="date" onload="this.value(Date());">
                    <input type="submit" id="valider" class="bold btn btn-orange" value="Rechercher">
                </form>
            </div>
            <select id="trierPar" name="trierPar" class="select">
                <option>Trier par</option>
                <?php
                for ($i = 0; $i < 5; $i++) {
                    ?>
                    <option>
                        Test
                    </option>
                <?php }
                ?>
            </select>

            <div id="clear"></div>
            <div id="listeCommentaires">
                <?php
                if (sizeof($events) == 0) {
                    echo "<p align='center'>Aucun événement n'est prévu actuellement</p>";
                } else {
                    $bool = true;
                    foreach ($events as $event) {
                        if ($bool) {
                            ?>
                            <div class="cadre" >
                                <div style="float:left;  width : 20%;">
                                    <p><?php echo $event["evenement_titre"] ?></p>
                                    <div style="background-image: url(' ./Vue/img/logoTheme/<?php echo $event["evenement_theme_id"]; ?>.png'); background-size: 100px 100px; background-repeat: no-repeat; height : 100px;"></div>
                                </div>
                                <div style="float:left; width : 80%;"><?php echo $event["evenement_description"]; ?>
                                    <br/>

                                    <form>
                                        <input type='hidden' name='controle' value='evenement'/>
                                        <input type='hidden' name='action' value='afficherPageEvent'/>
                                        <input type='hidden' name='param' value='1'/>

                                        <input type="submit" value="voir l'événement"/>
                                    </form>
                                </div> 
                                <div id="clear"></div>
                            </div>
                        <?php } else {
                            ?>
                            <div class="cadre" >
                                <div style="float:left; width : 80%;"><?php echo $event["evenement_description"]; ?>
                                    <br/>
                                    <div style="bottom:0; right : 0;">
                                        <p style="display : inline-block"><?php echo " date de début : " . $event["evenement_date_debut"] ?></p>
                                        <form style="display : inline-block">
                                            <input type='hidden' name='controle' value='evenement'/>
                                            <input type='hidden' name='action' value='afficherPageEvent'/>
                                            <input type='hidden' name='param' value='2'/>
                                            <input type="submit" value="voir l'événement"/>
                                        </form>
                                    </div>
                                </div> 
                                <div style="float:left;  width : 20%;">
                                    <p><?php echo $event["evenement_titre"] ?></p>
                                    <div style="background-image: url(' ./Vue/img/logoTheme/<?php echo $event["evenement_theme_id"]; ?>.png'); background-size: 100px 100px; background-repeat: no-repeat; height : 100px;"></div>
                                </div>
                                <div id="clear"></div>
                            </div>
                            <?php
                        }
                        $bool = !$bool;
                    }
                }
                ?>
            </div>
            <?php include('./Vue/footer.php'); ?>
        </div>
    </body>
</html>