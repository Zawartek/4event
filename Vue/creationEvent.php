<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Création</title>
        <link href="./Vue/css/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet" media="all" type="text/css">
        <link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">

        <!-- appels pour datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="./Vue/js/datepicker.js"></script>

        <script type="text/javascript">
            $(function ()
            {
                $("#dateDebut").datepicker($.datepicker.regional["fr"]);
                $("#dateDebut").datepicker('setDate', new Date());

                $("#dateFin").datepicker($.datepicker.regional["fr"]);
                $("#dateFin").datepicker('setDate', new Date());
            });
        </script>
    </head>

    <body>


        <div id="content">
            <form id="creationEvent" method="post" action="index.php?controle=evenement&action=creationEvent" style="margin: auto;">
                <h2 style="margin-top: 10px;" class="text-orange bold">Création Evénement</h2><br>

                <label for="titre">Titre :</label>
                <input type="text" name="titre" id="titre" class="input"><br>

                <label for="description">Description :</label><br>
                <textarea name="description" id="description" cols="120" rows="10" class="text-area"></textarea><br><br>

                <table id="tabCreationEvent">
                    <tr>
                        <td><label for="voie">Lieu de l'événement</label></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td><label for="voie">Voie :</label></td>
                        <td><input type="text" name="voie" id="voie" class="input"></td>
                        <td><label for="codepostal">Code postal :</label></td>
                        <td><input type="text" name="codepostal" id="codepostal" class="input"></td>
                    <br>
                    </tr>


                    <tr>
                        <td><label for="ville">Ville :</label></td>
                        <td><input type="text" name="ville" id="ville" class="input"></td>
                        <td><label for="pays">Pays :</label></td>
                        <td><input type="text" name="pays" id="pays" class="input"><br></td>
                    </tr>
                    <tr>
                        <td><label for="theme">Thème :</label></td>
                        <td>
                            <select id="theme" name="theme" class="input">
                                <?php
                                foreach($themes as $theme)
                                {
                                    echo '<option value="'.$theme["theme_id"].'">'.$theme["theme_nom"].'</option>';
                                }
                                ?>
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label for="dateDebut">Date début :</label></td>
                        <td><input type="text" id="dateDebut" name="dateDebut" class="input" onload="this.value(Date());" readonly="readonly"></td>
                        <td><label for="heureDebut">Heure début :</label></td>
                        <td><input type="time" name="heureDebut" id="heureDebut" class="input"></td>

                    </tr>
                    <tr>
                        <td><label for="dateFin">Date fin :</label></td>
                        <td><input type="text" id="dateFin" name="dateFin" class="input" onload="this.value(Date());" readonly="readonly"></td>
                        <td><label for="heureFin">Heure fin :</label></td>
                        <td><input type="time" name="heureFin" id="heureFin" class="input"></td>
                    </tr>
                    <tr>
                        <td><label for="maxParticipants">Max participants :</label></td>
                        <td><input type="text" name="maxParticipants" id="maxParticipants" class="input"></td>
                        <td><label for="typePublic">Type public :</label></td>
                        <td>
                            <select id="typePublic" name="typePublic" class="input">
                                <?php
                                foreach($themes as $theme)
                                {
                                    echo '<option value="'.$theme["theme_id"].'">'.$theme["theme_nom"].'</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="siteWeb">Site Web :</label></td>
                        <td><input type="text" name="siteWeb" id="siteWeb" class="input"></td>
                        <td><label for="tarif">Tarif :</label></td>
                        <td><input type="text" name="tarif" id="tarif" class="input"></td>
                    </tr>
                </table><br><br>

                <input class="btn btn-orange bold" style="display: block; margin: 10px auto 0px auto;" type="submit" value="Créer">
            </form>
        </div>




    </body>
</html>
