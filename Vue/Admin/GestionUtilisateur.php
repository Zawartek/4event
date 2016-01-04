<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var utilisateurs = <?php echo json_encode($utilisateurs); ?>;
        $('#ddlUtilisateur').on('change', function () {
            var text;
            text = this.options[this.selectedIndex].value-1;
            if (this.selectedIndex == "0") {
                $('#mail').val("");
                $('#nom').val("");
                $('#prenom').val("");
                $('#ville').val("");
            }
            else {
                $('#mail').val(utilisateurs[text]['utilisateur_email']);
                $('#nom').val(utilisateurs[text]['utilisateur_nom']);
                $('#prenom').val(utilisateurs[text]['utilisateur_prenom']);
                $('#ville').val("utilisateurs[" +text + "]['utilisateur_adresse']");
            }
        });
    });
</script>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion des utilisteurs</title>
        <link rel="stylesheet" href="./Vue/css/style.css">
    </head>
    <body>
        <div id="content" >
            <?php require './Vue/header.php'; ?>
            <?php
            require './Vue/Admin/menuAdmin.php';
            ?>
            <div id='listeUtilisateur'>
                <label>Liste des utilisateurs : </label>
                <select id="ddlUtilisateur">
                    <option value="0">Création d'un nouvel utilisateur</option>
                    <?php
                    foreach ($utilisateurs as $uti) {
                        echo '<option value="' . $uti['utilisateur_id'] . '">' . $uti['utilisateur_email'] . '</option>';
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
                            <input style="width:80%;" id="mail" type="text" name="mail" value=""/>
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
                            <input style="width:80%;" id="nom" type="text" name="nom" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Prenom :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="prenom" type="text" name="prenom" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Ville :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="ville" type="text" name="ville" value=""/>
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
