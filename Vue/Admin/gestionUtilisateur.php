<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion des utilisateurs</title>
        <link rel="stylesheet" href="./Vue/css/style.css">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                var utilisateurs = <?php echo json_encode($utilisateurs); ?>;
                $('#ADD').show();
                $('#MOD').hide();
                $('#SUPPR').hide();

                $('#ddlUtilisateur').on('change', function () {
                    var text;
                    text = this.options[this.selectedIndex].value;
                    if (this.selectedIndex == "0") {
                        $('#id').val("");
                        $('#email').val("");
                        $('#nom').val("");
                        $('#prenom').val("");
                        $('#sexe').val("");
                        $('#datenaissance').val("");
                        $('#etat').val("0");
                        $('#type').val("0");
                        $('#mdp').val("");

                        $('#voie').val("");
                        $('#ville').val("");
                        $('#codepostal').val("");
                        $('#pays').val("");

                        $('#ADD').show();
                        $('#MOD').hide();
                        $('#SUPPR').hide();
                    }
                    else {
                        $('#id').val(utilisateurs[text]['utilisateur_id']);
                        $('#email').val(utilisateurs[text]['utilisateur_email']);
                        $('#nom').val(utilisateurs[text]['utilisateur_nom']);
                        $('#prenom').val(utilisateurs[text]['utilisateur_prenom']);
                        $('#sexe').val(utilisateurs[text]['utilisateur_sexe']);

                        function sansZero(number)
                        {
                            if (number.indexOf("0") === 0)
                                number = number.substring(1);
                            return number;
                        }

                        var parts = utilisateurs[text]['utilisateur_date_naissance'].split("-");
                        var jour = sansZero(parts[2]);
                        var mois = sansZero(parts[1]);
                        var annee = sansZero(parts[0]);

                        $('#jour').val(jour);
                        $('#mois').val(mois);
                        $('#annee').val(annee);

                        $('#etat').val(utilisateurs[text]['utilisateur_etat']);
                        $('#type').val(utilisateurs[text]['utilisateur_type']);
                        $('#mdp').val(utilisateurs[text]['utilisateur_mot_de_passe']);

                        $('#voie').val(utilisateurs[text]['adresse_numero_voie']);
                        $('#ville').val(utilisateurs[text]['adresse_ville']);
                        $('#codepostal').val(utilisateurs[text]['adresse_code_postal']);
                        $('#pays').val(utilisateurs[text]['adresse_pays']);

                        $('#ADD').hide();
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
            <div id='listeUtilisateur'>
                <label>Liste des utilisateurs : </label>
                <select id="ddlUtilisateur">
                    <option value="0">Création d'un nouvel utilisateur</option>
                    <?php
                    $cpt=0;
                    foreach ($utilisateurs as $uti) {
                        echo '<option value="' . $cpt++ . '">' . $uti['utilisateur_email'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <form class="cadre" method="POST" action="index.php?controle=admin&action=gestionUti">
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
                            <input style="width:80%;" id="email" type="text" name="email" value=""/>
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
                        <td>
                            <label>Date de naissance :</label>
                        </td>
                        <td>
                            <select class="champDateNaissance" name="jour" id="jour" onchange="">
                                <option value="0">Jour</option>
                                <?php
                                for ($j = 1; $j <= 31; $j ++)
                                {
                                    echo "<option value='$j'>$j</option>";
                                } ?>
                            </select>
                            <select class="champDateNaissance" name="mois" id="mois" onchange="">
                                <option value="0">Mois</option>
                                <?php
                                $mois = array('janv', 'févr', 'mars', 'avril', 'mai', 'juin', 'juil', 'août', 'sept', 'oct', 'nov', 'déc');
                                for ($m = 1; $m <= 12; $m ++)
                                {
                                    $indice = $m - 1;
                                    echo "<option value='$m'>$mois[$indice]</option>";
                                } ?>
                            </select>
                            <select class="champDateNaissance" name="annee" id="annee" onchange="">
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
                            <label>Prenom :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="prenom" type="text" name="prenom" value=""/>
                        </td>
                        <td>
                            <label>Etat :</label>
                        </td>
                        <td>
                            
                            <select style="width:80%;" id="etat" type="text" name="etat" >
                                <option value="0">actif</option>
                                <option value="1">supprimé</option>
                                <option value="2">bani</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Sexe :</label>
                        </td>
                        <td>
                            <select style="width:80%;" id="sexe" type="text" name="sexe">
                                <option value="0">Femme</option>
                                <option value="1">Homme</option>
                            </select>
                        </td>
                        <td>
                            <label>Type :</label>
                        </td>
                        <td>
                            
                            <select style="width:80%;" id="type" type="text" name="type">
                                <option value="0">normal</option>
                                <option value="1">modérateur</option>
                                <option value="2">administrateur</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Mot de passe :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="mdp" type="password" name="mdp" value=""/>
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
