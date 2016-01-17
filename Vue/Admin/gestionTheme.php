<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion des thèmes</title>
        <link rel="stylesheet" href="./Vue/css/style.css">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                var themes = <?php echo json_encode($themes); ?>;
                $('#ADD').show();
                $('#MOD').hide();
                $('#SUPPR').hide();

                $('#ddltheme').on('change', function () {
                    var text;
                    text = this.options[this.selectedIndex].value;
                    if (this.selectedIndex == "0") {
                        $('#id').val("");
                        $('#nom').val("");
                        $('#imgMiniature').attr({
                            src:'',
                            width:0,
                            height:0
                        });
                        

                        $('#ADD').show();
                        $('#MOD').hide();
                        $('#SUPPR').hide();
                    } else {
                        $('#id').val(themes[text]['theme_id']);
                        $('#nom').val(themes[text]['theme_nom']);
                        //$('#miniature').val(themes[text]['theme_miniature']);
                        $('#imgMiniature').attr({
                            src:'./Vue/img/logoTheme/' + themes[text]['theme_miniature'],
                            width:160,
                            height:160
                        });
                        
                        $('#ADD').hide();
                        $('#MOD').show();
                        $('#SUPPR').show();
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="content">
            <?php require './Vue/header.php'; ?>
            <?php
            require_once './Vue/Admin/menuAdmin.php';
            ?>
            <div class="listeBackOffice">
                <label>Liste des thèmes : </label>
                <select id="ddltheme" class="input">
                    <option value="0">Création d'un nouveau thème</option>
                    <?php
                    $cpt = 0;
                    foreach ($themes as $s) {
                        echo '<option value="' . $cpt++ . '">'
                        . $s["theme_nom"] .
                        '</option>';
                    }
                    ?>
                </select>
            </div>

            <form class="cadre" method="POST" action="index.php?controle=admin&action=gestionTheme" enctype="multipart/form-data">
                <table class="tableBackOffice">
                    <tr>
                        <th id="tableLabel"></th>
                        <th id="tableValeur"></th>
                    </tr>
                    <tr>
                        <td>
                            <label>Nom :</label>
                        </td>
                        <td>
                            <textarea id="nom" name="nom" rows="3" style="width:100%; resize: none;"></textarea>
                            <br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Miniature :</label>
                        </td>
                        <td>
                            <img id="imgMiniature"/>
                            <br><br>
                            <input type="file" id="miniature" name="miniature" />
                        </td>
                    </tr>
                </table>
                <input id="id" type="hidden" name="id">
                <div id="boutons">
                    <br>
                    <button id="MOD" type="submit" name="MOD" class="bold btn btn-orange">Modifier</button>
                    <button id="SUPPR" type="submit" name="SUPPR" class="bold btn btn-orange">Supprimer</button>
                    <button id="ADD" type="submit" name="ADD" class="bold btn btn-orange">Ajouter</button>
                </div>
            </form>
        </div>
    </body>
    <?php require './Vue/footer.php'; ?>
</html>
