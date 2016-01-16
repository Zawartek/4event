<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion des events</title>
        <link rel="stylesheet" href="./Vue/css/style.css">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                var events = <?php echo json_encode($events); ?>;
                $('#MOD').show();
                $('#SUPPR').show();

                $('#ddlEvent').on('change', function () {
                    var text;
                    text = this.options[this.selectedIndex].value;
                    if (this.selectedIndex == "0") {
                        {
                        $('#id').val(events[text]['evenement_id']);
                        $('#titre').val(events[text]['evenement_titre']);
                        $('#description').val(events[text]['evenement_description']);
                        $('#dateDebut').val(events[text]['evenement_date_debut']);
                        $('#dateFin').val(events[text]['evenement_date_fin']);
                        $('#heureDebut').val(events[text]['evenement_heure_debut']);
                        $('#heureFin').val(events[text]['evenement_heure_fin']);
                        $('#max').val(events[text]['evenement_max_participants']);
                        $('#public').val(events[text]['evenement_type_public']);
                        $('#site').val(events[text]['evenement_site_web']);
                        $('#tarif').val(events[text]['evenement_type_tarif']);

                        function sansZero(number)
                        {
                            if (number.indexOf("0") === 0)
                                number = number.substring(1);
                            return number;
                        }

                        var parts = events[text]['evenement_date_debut'].split("-");
                        var jour = sansZero(parts[2]);
                        var mois = sansZero(parts[1]);
                        var annee = sansZero(parts[0]);

                        $('#jourD').val(jour);
                        $('#moisD').val(mois);
                        $('#anneeD').val(annee);

                        $('#voie').val(events[text]['adresse_numero_voie']);
                        $('#ville').val(events[text]['adresse_ville']);
                        $('#codepostal').val(events[text]['adresse_code_postal']);
                        $('#pays').val(events[text]['adresse_pays']);

                        $('#MOD').show();
                        $('#SUPPR').show();
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
            <div id='listEvent'>
                <label>Liste des évenements : </label>
                <select id="ddlEvent">
                    <?php
                    $cpt=0;
                    foreach ($events as $event) {
                        echo '<option value="' . $cpt++ . '">' . $event['evenement_titre'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <form class="cadre" method="POST" action="index.php?controle=admin&action=gestionUti">
                <table id="tableEvenement">
                    <tr>
                        <th classe="tableLabel"></th>
                        <th classe="tableValeur"></th>
                        <th classe="tableLabel"></th>
                        <th classe="tableValeur"></th>
                    </tr>
                    <tr>
                        <td>
                            <label>Titre :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="titre" type="text" name="titre" value=""/>
                        </td>
                         <td>
                            <label>Site WEB :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="titre" type="text" name="web" value=""/>
                        </td>
                        
                      
                    </tr>

                    <tr>
                        <td>
                            <label>Description :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="description" type="text" name="description" value=""/>
                        </td>
                        <td>
                            <label>Date début :</label>
                        </td>
                        <td>
                            <select class="champDateNaissance" name="jourD" id="jourD" onchange="">
                                <option value="0">Jour</option>
                                <?php
                                for ($j = 1; $j <= 31; $j ++)
                                {
                                    echo "<option value='$j'>$j</option>";
                                } ?>
                            </select>
                            <select class="champDateNaissance" name="moisD" id="moisD" onchange="">
                                <option value="0">Mois</option>
                                <?php
                                $mois = array('janv', 'févr', 'mars', 'avril', 'mai', 'juin', 'juil', 'août', 'sept', 'oct', 'nov', 'déc');
                                for ($m = 1; $m <= 12; $m ++)
                                {
                                    $indice = $m - 1;
                                    echo "<option value='$m'>$mois[$indice]</option>";
                                } ?>
                            </select>
                            <select class="champDateNaissance" name="anneeD" id="anneeD" onchange="">
                                <option value="0">Année</option>
                                <?php
                                for ($a = date("Y"); $a >= 1900; $a --)
                                {
                                    echo "<option value='$a'>$a</option>";
                                } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Max Participants :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="max" type="number" min="0" name="max" value=""/>
                        </td>
                        <td>
                            <label>Heure de début :</label>
                        </td>
                        <td>
                            
                        
                        <td><input type="time" name="heureDebut" id="heureDebut" class="input">
                                
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Type de public :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="max" type="number" min="0" name="max" value=""/>
                        </td>
                        <td>
                            <label>Date de fin :</label>
                        </td>
                        <td>
                            <select class="champDateNaissance" name="jourF" id="jourD" onchange="">
                                <option value="0">Jour</option>
                                <?php
                                for ($j = 1; $j <= 31; $j ++)
                                {
                                    echo "<option value='$j'>$j</option>";
                                } ?>
                            </select>
                            <select class="champDateNaissance" name="moisF" id="moisD" onchange="">
                                <option value="0">Mois</option>
                                <?php
                                $mois = array('janv', 'févr', 'mars', 'avril', 'mai', 'juin', 'juil', 'août', 'sept', 'oct', 'nov', 'déc');
                                for ($m = 1; $m <= 12; $m ++)
                                {
                                    $indice = $m - 1;
                                    echo "<option value='$m'>$mois[$indice]</option>";
                                } ?>
                            </select>
                            <select class="champDateNaissance" name="anneef" id="anneeD" onchange="">
                                <option value="0">Année</option>
                                <?php
                                for ($a = date("Y"); $a >= 1900; $a --)
                                {
                                    echo "<option value='$a'>$a</option>";
                                } ?>
                            </select>
                        </td>
                    </tr>
                    
                     <tr>
                        <td>
                            <label>Thème :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="max" type="number" min="0" name="max" value=""/>
                        </td>
                        <td>
                            <label>Heure de fin :</label>
                        </td>
                        <td>
                            
                               <td><input type="time" name="heureDebut" id="heureDebut" class="input">
                                
                            </select>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>Tarif :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="ville" type="text" name="ville" value=""/>
                        </td>
                    </tr>
                    
                </table>
                
                <fieldset style="border : 1px solid black">
                    <legend style="width:15%; margin-bottom: 0px;">Addresse</legend>
                    <table>
                        <th classe="tableLabel"></th>
                        <th classe="tableValeur"></th>
                        <th classe="tableLabel"></th>
                        <th classe="tableValeur"></th>
                    <tr>
                        <td>
                            <label>Voie :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="voie" type="text" name="voie" value=""/>
                        </td>
                        <td>
                            <label>Code postal :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="codepostal" type="text" name="codepostal" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Ville :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="ville" type="text" name="ville" value=""/>
                        </td>
                        <td>
                            <label>Pays :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="pays" type="text" name="pays" value=""/>
                        </td>
                    </tr>
                    </table>
                </fieldset>
                <input id="id" type="hidden" name="id"/>
                <div id="boutons">
                    <br>
                    <button id="MOD" type="submit" name="MOD" class="btn-orange">Modifier</button>
                    <button id="SUPPR" type="submit" name="SUPPR" class="btn-orange">Supprimer</button>
                    <button id="ADD" type="submit" name="ADD" class="btn-orange">Ajouter</button>
                </div>
            </form>
            </div>
            <?php require './Vue/footer.php'; ?>
        </div>
    </body>
</html>
