<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion de la FAQ</title>
        <link rel="stylesheet" href="./Vue/css/style.css">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                var faqs = <?php echo json_encode($faq); ?>;
                $('#ADD').show();
                $('#MOD').hide();
                $('#SUPPR').hide();

                $('#ddlfaq').on('change', function () {
                    var text;
                    text = this.options[this.selectedIndex].value;
                    if (this.selectedIndex == "0") {
                        $('#id').val("");
                        $('#titre').val("");
                        $('#description').val("");
                       
                        $('#ADD').show();
                        $('#MOD').hide();
                        $('#SUPPR').hide();
                    }
                    else {
                        $('#id').val(faqs[text]['faq_id']);
                        $('#titre').val(faqs[text]['fas_question']);
                        $('#description').val(faqs[text]['faq_reponse']);
                       
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
            require './Vue/Admin/menuAdmin.php';
        ?>
        <div id="listeFAQ">
        <label>Liste des FAQ : </label>
        <select id="ddlfaq">
            <option>Création d'une nouvelle FAQ</option>
            <?php
            foreach ($faq as $s){
            echo '<option>'
             .$s["faq_question"].
            '</option>';
            }
            ?>
        </select>
        </div>
        
        <form class="cadre">
            <table id="tableFAQ">
                <tr>
                    <th id="tableLabel"></th>
                    <th id="tableValeur"></th>
                </tr>
                <tr>
                    <td>
                        
            <label>Titre :</label>
                    </td>
                    <td>
            <input type="text" name="titre" value="testPrenom"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Description :</label>
                    </td>
                    <td>
                        <textarea name="description" rows="5" style="width:100%;"></textarea>
                    </td>
                </tr>
            </table>
            <div id="boutons">
                <button class="btn-orange">Modifier</button>
                <button class="btn-orange">Supprimer</button>
                <br>
                <button class="btn-orange">Ajouter</button>
            </div>
        </form>
        <?php require './Vue/footer.php'; ?>
        </div>
    </body>
</html>
