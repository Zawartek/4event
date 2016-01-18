<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$split = explode("-", $uti["utilisateur_date_naissance"]);
$annee = sansZero($split[0]);
$mois = sansZero($split[1]);
$jour = sansZero($split[2]);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mon Profil</title>
        <link rel="stylesheet" href="./Vue/css/style.css">
    </head>
    <body>
        <div id="content">
            <?php require("./Vue/header.php"); ?>
            <form class="cadre" style="width: 100%;" method="POST" action="index.php?controle=utilisateur&action=modificationProfil"  enctype="multipart/form-data">
                <table id="tableUtilisateur">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>
                            <label>Nom :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="nom" type="text" name="nom" value="<?php echo $uti['utilisateur_nom']; ?>"/>
                        </td>
                        <td>
                            <label>Mail :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="email" type="text" name="email" value="<?php echo $uti['utilisateur_email']; ?>"/>
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
                            <label>Mot de passe :</label>
                        </td>
                        <td>
                            <input style="width:80%;" id="mdp" type="password" name="mdp" value="<?php echo $uti['utilisateur_mot_de_passe']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Sexe :</label>
                        </td>
                        <td>
                            <select style="width:80%;" id="sexe" type="text" name="sexe" class="input">
                                <option value="0">Femme</option>
                                <option value="1" selected="<?php echo ($uti['utilisateur_sexe'] == "1"); ?>">Homme</option>
                            </select>
                        </td>
                        <td>
                            <label>Date de naissance :</label>
                        </td>
                        <td>
                            <select class="input" name="jour" id="jour">
                                <option value="0">Jour</option>
                                <?php
                                for ($j = 1; $j <= 31; $j ++)
                                {
                                    $selection = "";
                                    if ($j == $jour) { $selection = "selected"; }
                                    echo "<option ".$selection." value='$j'>$j</option>";
                                }
                                ?>
                            </select>
                            <select class="input" name="mois" id="mois">
                                <option value="0">Mois</option>
                                <?php
                                $intuleMois = array('Janv', 'Févr', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc');
                                for ($m = 1; $m <= 12; $m ++)
                                {
                                    $indice = $m - 1;
                                    $selection = "";
                                    if ($m == $mois) { $selection = "selected"; }
                                    echo "<option ".$selection." value='$m'>$intuleMois[$indice]</option>";
                                }
                                ?>
                            </select>
                            <select class="input" name="annee" id="annee">
                                <option value="0">Année</option>
                                <?php
                                for ($a = date("Y"); $a >= 1900; $a --)
                                {
                                    $selection = "";
                                    if ($a == $annee) { $selection = "selected"; }
                                    echo "<option ".$selection." value='$a'>$a</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Photo :</label>
                        </td>
                        <td>
                            <img id="photoProfilBack" src='<?php echo "./Vue/img/photoProfil/".$uti["utilisateur_image_profil"]; ?>'>
                        </td>
                        <td>
                            <label>Nouvelle photo :</label>
                        </td>
                        <td>
                            <input type="file" id="photo" name="photo">
                            <input type="hidden" name="photoActuelle" id="photoActuelle" value="<?php echo $uti["utilisateur_image_profil"];?>">
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
                <fieldset id="fieldset">
                    <legend class="legende">Vos Favoris</legend>
                    <div class="checkbox">
                        <?php
                        $compteur = 0;
                        foreach ($themes as $theme)
                        {
                            $selected = "";
                            if (strpos($uti["utilisateur_favoris"], $theme["theme_id"]) > -1) { $selected = "checked"; }

                            echo "<label><input name='favori' type='checkbox' value='" . $theme["theme_id"] . "' " . $selected . ">" . $theme["theme_nom"] . "</label>";
                        }
                        ?>
                    </div>
                </fieldset>
                <div id="boutons">
                    <br>
                    <button id="MOD" type="submit" name="MOD" class="bold btn btn-orange">Modifier</button>
                    <button id="SUPPR" type="submit" name="SUPPR" class="bold btn btn-orange">Supprimer</button>
                    <a href="<?php echo "index.php?controle=utilisateur&action=afficherPageUti&param=".$_SESSION['userID']; ?>">
                        <input type="button" value="Retour" id="retourProfil" class="bold btn btn-orange">
                    </a>
                </div>
            </form>
            <br>
        </div>
    </body>
    <?php require './Vue/footer.php'; ?>
</html>