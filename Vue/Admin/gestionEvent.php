<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion des événements</title>
        <link rel="stylesheet" href="./Vue/css/style.css">
    </head>
    <body>
        <div id="content">
        <?php require './Vue/header.php'; ?>
        <?php 
            require './Vue/Admin/menuAdmin.php';
        ?>
        <div id="listeFAQ">
        <label>Liste des événements : </label>
        <select>
            <option>Création d'une nouveau événement</option>
            <?php
            for ($i = 0; $i<10; $i++){
            echo '<option>' .
                'Event ' . $i .
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
