<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion des utilisteurs</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div id="content" class="cadre">
        <?php 
            require './menuAdmin.php';
        ?>
        <div id="listeUtilisateur">
        <label>Liste des utilisateurs</label>
        <select>
            <?php
            for ($i = 0; $i<10; $i++){
            echo '<option>' .
                'Utilisateur' . $i .
            '</option>';
            }
            ?>
        </select>
        </div>
        
        <form class="cadre">
            <table id="tableUtilisateur">
                <tr>
                    <th id="tableLabel"></th>
                    <th id="tableValeur"></th>
                </tr>
                <tr>
                    <td>
                        <label>Mail :</label>
                    </td>
                    <td>
                        <input type="text" name="mail" value="testMail"/>
                    </td>
                    <td>
                        <button>rechercher</button>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Nom :</label>
                    </td>
                    <td>
                        <input type="text" name="nom" value="testNom"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Prenom :</label>
                    </td>
                    <td>
                        <input type="text" name="prenom" value="testPrenom"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ville :</label>
                    </td>
                    <td>
                        <input type="text" name="ville" value="testVille"/>
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
        </div>
    </body>
</html>
