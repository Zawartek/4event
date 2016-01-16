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
                        $('#titre').val(faqs[text]['faq_question']);
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
            require_once './Vue/Admin/menuAdmin.php';
        ?>
        <div id="listeFAQ">
        <label>Liste des Questions : </label>
        <select id="ddlfaq">
            <option value="0">Création d'une nouvelle Question</option>
            <?php
            $cpt=0;
            foreach ($faq as $s){
            echo '<option value="'.$cpt++.'">'
             .$s["faq_question"].
            '</option>';
            }
            ?>
        </select>
        </div>
        
        <form class="cadre" method="POST" action="index.php?controle=admin&action=gestionFaq">
            <table id="tableFAQ">
                <tr>
                    <th id="tableLabel"></th>
                    <th id="tableValeur"></th>
                </tr>
                <tr>
                    <td>
                        
            <label>Question :</label>
                    </td>
                    <td>
            <input id="titre" type="text" name="titre" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Réponse :</label>
                    </td>
                    <td>
                        <textarea id="description" name="description" rows="5" style="width:100%; resize: none;"></textarea>
                    </td>
                </tr>
            </table>
                <input id="id" type="hidden" name="id"/>
                <div id="boutons">
                    <br>
                    <button id="MOD" type="submit" name="MOD" class="btn-orange">Modifier</button>
                    <button id="SUPPR" type="submit" name="SUPPR" class="btn-orange">Supprimer</button>
                    <button id="ADD" type="submit" name="ADD" class="btn-orange">Ajouter</button>
                </div>
        </form>
        <?php require './Vue/footer.php'; ?>
        </div>
    </body>
</html>
