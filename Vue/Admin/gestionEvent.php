<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion des Événements</title>
        <link rel="stylesheet" href="./Vue/css/style.css">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript">
            $(function ()
            {
                $("#dateDebut").datepicker($.datepicker.regional["fr"]);
                $("#dateDebut").datepicker('setDate', new Date());
                $("#DateFin").datepicker($.datepicker.regional["fr"]);
                $("#DateFin").datepicker('setDate', new Date());
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function ()
            {
                var events = <?php echo json_encode($events); ?>;
                $('#ADD').show();
                $('#MOD').hide();
                $('#SUPPR').hide();

                $('#ddlEvent').on('change', function ()
                {
                    var text;
                    text = this.options[this.selectedIndex].value;
                    if (this.selectedIndex == "0")
                    {
                        $('#id').val("");
                        $('#titre').val("");
                        $('#description').val("");
                        $("#dateDebut").datepicker('setDate', new Date(<?php echo json_encode(date("Y-m-d")); ?>));
                        $('#dateFin').datepicker('setDate', new Date(<?php echo json_encode(date("Y-m-d")); ?>));
                        $('#heureDebut').val("00:00");
                        $('#heureFin').val("00:00");
                        $('#max').val("0");
                        $('#public').val("0");
                        $('#themeId').val("1");
                        $('#siteWeb').val("");
                        $('#tarif').val("");
                        
                        $('#voie').val("");
                        $('#ville').val("");
                        $('#codepostal').val("");
                        $('#pays').val("");
                        
                        $('#ADD').show();
                        $('#MOD').hide();
                        $('#SUPPR').hide();
                    }
                    else
                    {
                        function formattageDate(date)
                        {
                            var parts = date.split("-");
                            return parts[2] + "/" + parts[1] + "/" + parts[0]; 
                        }

                        $('#id').val(events[text]['evenement_id']);
                        $('#titre').val(events[text]['evenement_titre']);
                        $('#description').val(events[text]['evenement_description']);
                        $('#dateDebut').val(formattageDate(events[text]['evenement_date_debut']));
                        $('#dateFin').val(formattageDate(events[text]['evenement_date_fin']));
                        $('#heureDebut').val(events[text]['evenement_heure_debut']);
                        $('#heureFin').val(events[text]['evenement_heure_fin']);
                        $('#max').val(events[text]['evenement_max_participants']);
                        $('#public').val(events[text]['evenement_type_public']);
                        $('#themeId').val(events[text]['evenement_theme_id']);
                        $('#siteWeb').val(events[text]['evenement_site_web']);
                        $('#tarif').val(events[text]['evenement_tarif']);
                        
                        $('#voie').val(events[text]['adresse_numero_voie']);
                        $('#ville').val(events[text]['adresse_ville']);
                        $('#codepostal').val(events[text]['adresse_code_postal']);
                        $('#pays').val(events[text]['adresse_pays']);
                        
                        $('#ADD').hide();
                        $('#MOD').show();
                        $('#SUPPR').show();;
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="content" >
            <?php require './Vue/header.php'; ?>
            <div classe="container_event">
                <?php
                require './Vue/Admin/menuAdmin.php';
                ?>
                <div id='listeEvent'>
                    <label>Liste des évenements : </label>
                    <select id="ddlEvent" class="input">
                        <option value="0">Création d'un nouvel événement</option>
                        <?php
                        $cpt = 0;
                        foreach ($events as $event) {
                            echo '<option value="' . $cpt++ . '">' . $event['evenement_titre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <form class="cadre" method="POST" action="index.php?controle=admin&action=gestionEvent">
                    <table id="tableEvent">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                <label>Titre :</label>
                            </td>
                            <td>
                                <input style="width:80%;" id="titre" type="text" name="titre" value="">
                            </td>
                            <td>
                                <label>Thème :</label>
                            </td>
                            <td>
                                <select style="width:80%;"  id="themeId" name="themeId" class="input">
                                    <?php
                                    foreach ($themes as $theme) {
                                        echo '<option value="' . $theme["theme_id"] . '">' . $theme["theme_nom"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>                        
                        <tr>
                            <td>
                                <label>Description :</label>
                            </td>
                            <td colspan="3">
                                <textarea id="description" name="description" rows="5" style="width:100%; resize: none;"></textarea>
                            </td>
                        </tr>    
                        <tr>
                            <td>
                                <label>Date début :</label>
                            </td>
                            <td>
                                <input style="width:80%;" type="text" id="dateDebut" name="dateDebut" readonly="readonly">
                            </td>
                            <td>
                                <label>Date de fin :</label>
                            </td>
                            <td>
                                <input style="width:80%;" type="text" id="dateFin" name="dateFin" readonly="readonly">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Heure de début :</label>
                            </td>
                            <td>
                                <input style="width:80%;" type="time" name="heureDebut" id="heureDebut" value="00:00">
                            </td>
                            <td>
                                <label>Heure de fin :</label>
                            </td>
                            <td>
                                <input style="width:80%;" type="time" name="heureFin" id="heureFin" value="00:00">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label style="visibility: hidden;">Type de public :</label>
                            </td>
                            <td>
                                <input style="width:80%;visibility: hidden;" id="public" type="number" min="0" name="public" value="0">
                            </td>
                            <td>
                                <label>Max Participants :</label>
                            </td>
                            <td>
                                <input style="width:80%;" id="max" type="number" min="0" name="max" value="0">
                            </td>                            
                        </tr>
                        <tr>
                            <td>
                                <label>Site WEB :</label>
                            </td>
                            <td>
                                <input style="width:80%;" id="siteWeb" type="text" name="web" value="">
                            </td>
                            <td>
                                <label>Tarif :</label>
                            </td>
                            <td>
                                <input style="width:80%;" id="tarif" type="text" name="tarif" value="">
                            </td>
                        </tr>
                    </table>

                    <fieldset id="fieldset">
                        <legend class="legende">Adresse</legend>
                        <table id="tableAdresse">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <tr>
                                <td>
                                    <label>Voie :</label>
                                </td>
                                <td>
                                    <input style="width:80%;" id="voie" type="text" name="voie" value="">
                                </td>
                                <td>
                                    <label>Code postal :</label>
                                </td>
                                <td>
                                    <input style="width:80%;" id="codepostal" type="text" name="codepostal" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Ville :</label>
                                </td>
                                <td>
                                    <input style="width:80%;" id="ville" type="text" name="ville" value="">
                                </td>
                                <td>
                                    <label>Pays :</label>
                                </td>
                                <td>
                                    <input style="width:80%;" id="pays" type="text" name="pays" value="">
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <input id="id" type="hidden" name="id">
                    <div id="boutons">
                        <br>
                        <button id="MOD" type="submit" name="MOD" class="bold btn btn-orange">Modifier</button>
                        <button id="SUPPR" type="submit" name="SUPPR" class="bold btn btn-orange">Supprimer</button>
                        <button id="ADD" type="submit" name="ADD" class="bold btn btn-orange">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <?php require './Vue/footer.php'; ?>
</html>