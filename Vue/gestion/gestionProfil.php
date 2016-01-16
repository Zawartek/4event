<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>gestion utilisateur</title>
        <link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
            $(function () {
                $("#tabs").tabs();
            });
        </script>
    </head>
    <body>
        <div id="content">
            <?php require("./Vue/header.php"); ?>
            <div id="tabs">
                <ul>
                    <li><a href="#tabProfil">Profil</a></li>
                    <li><a href="#tabFavoris">Mes favoris</a></li>
                </ul>
                <div id="tabProfil">
                    <form method="POST" action="index.php?controle=admin&action=gestionUti">
                        <table id="tableUtilisateur">
                            <tr>
                                <th classe="tableLabel"></th>
                                <th classe="tableValeur"></th>
                                <th classe="tableLabel"></th>
                                <th classe="tableValeur"></th>
                            </tr>
                            <tr>
                                <td>
                                    <label>Mail :</label>
                                </td>
                                <td>
                                    <input style="width:80%;" id="email" type="text" name="email" value="<?php echo $uti['utilisateur_email']; ?>"/>
                                </td>

                                <td>
                                    <label>Mot de passe :</label>
                                </td>
                                <td>
                                    <input style="width:80%;" id="mdp" type="password" name="mdp" value="<?php echo $uti['utilisateur_mot_de_passe']; ?>"/>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Nom :</label>
                                </td>
                                <td>
                                    <input style="width:80%;" id="nom" type="text" name="nom" value="<?php echo $uti['utilisateur_nom']; ?>"/>
                                </td>
                                <td>
                                    <label>Date de naissance :</label>
                                </td>
                                <td>
                                    <input style="width:80%;" id="datenaissance" type="text" name="datenaissance" value="<?php echo $uti['utilisateur_date_naissance']; ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Prenom :</label>
                                </td>
                                <td>
                                    <input style="width:80%;" id="prenom" type="text" name="prenom" value="<?php echo $uti['utilisateur_prenom']; ?>"/>
                                </td>
                                <td>
                                    <label>Sexe :</label>
                                </td>
                                <td>
                                    <select style="width:80%;" id="sexe" type="text" name="sexe">
                                        <option value="0">Femme</option>
                                        <option value="1" selected="<?php echo ($uti['utilisateur_sexe'] == "1"); ?>">Homme</option>
                                    </select>
                                </td>
                            </tr>
                        </table>

                        <fieldset id="fieldset">
                            <legend class="legende">Adresse</legend>
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
                                        <input style="width:80%;" id="voie" type="text" name="voie" value="<?php echo $uti['adresse_numero_voie']; ?>"/>
                                    </td>
                                    <td>
                                        <label>Code postal :</label>
                                    </td>
                                    <td>
                                        <input style="width:80%;" id="codepostal" type="text" name="codepostal" value="<?php echo $uti['adresse_code_postal']; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Ville :</label>
                                    </td>
                                    <td>
                                        <input style="width:80%;" id="ville" type="text" name="ville" value="<?php echo $uti['adresse_ville']; ?>"/>
                                    </td>
                                    <td>
                                        <label>Pays :</label>
                                    </td>
                                    <td>
                                        <input style="width:80%;" id="pays" type="text" name="pays" value="<?php echo $uti['adresse_pays']; ?>"/>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <input id="id" type="hidden" name="id"/>

                    </form>
                </div>
                <div id="tabFavoris">
                    <?php
                    foreach ($themes as $theme) {
                        $selected = "";
                        if (strpos($uti["utilisateur_favoris"], $theme["theme_id"]) > -1) {
                            $selected = "checked";
                        }
                        echo "<input name='favori' type='checkbox' value='" . $theme["theme_id"] . "' " . $selected . "/>" . $theme["theme_nom"] . "<br>";
                    }
                    ?>
                </div>
                <div id="boutons">
                    <br>
                    <button id="MOD" type="submit" name="MOD" class="btn-orange">Modifier</button>
                    <button id="SUPPR" type="submit" name="SUPPR" class="btn-orange">Supprimer</button>
                </div>
            </div>
            <br>
        </div>

        <div id="footer">
            <?php include "./Vue/footer.php"; ?>
        </div>
    </body>
</html>