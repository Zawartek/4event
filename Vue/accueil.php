<?php
// Le champ "identifiant" ET le champ "password" sont remplis ?
if (isset($_POST['login'])) {
    // Neutralisation des éventuelles mauvaises intentions du visiteur.
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);

    if (($login != '') && ($password != '')) {
        $password = md5($password);

        $reponse = $bdd->query("SELECT * FROM joueur WHERE login='$login'");
        while ($donnees = $reponse->fetch()) {
            // Le champ "password" correspond à l'un de ces membres ?
            if ($password == $donnees['password']) {
                // Ouverture d'une session "membre"
                $_SESSION['id_joueur'] = $donnees['id'];

                // Redirection vers la page "village".
                header('Location: ' . URL . '/index.php?page=village');
                exit();
            }
        }

        $message = 'L\'identifiant ou le mot de passe sont incorrects.';
    } else {
        $message = 'Certains champs sont vides.';
    }
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>

        <!-- appels pour datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="js/datepicker.js"></script>

        <script type="text/javascript">
            $(function()
            {
                $("#date").datepicker($.datepicker.regional["fr"]);
                $("#date").datepicker('setDate', new Date());
            });
        </script>
    </head>
    <body>
        <div id="content">
<?php require("./header.php"); ?>
            <div id="slider">
<?php include('slider/slider.html'); ?>

                <form id="barreRecherche" method="post" action="#">
                    <select id="choixTheme" name="choixTheme" class="input">
            <?php
            for ($i = 0; $i < 5; $i++) {
                ?>
                            <option>Test</option>
<?php }
?>
                    </select>
                    <input type="text" id="date" name="date" class="date" onload="this.value(Date());">
                    <input type="submit" id="valider" class="bold btn btn-orange" value="Rechercher">
                </form>
            </div>
            <select id="trierPar" name="trierPar" class="select">
                <option>Trier par</option>
<?php
for ($i = 0; $i < 5; $i++) {
    ?>
                    <option>
                        Test
                    </option>
                <?php }
                ?>
            </select>

            <div id="clear"></div>

            <div class="cadre" style="height: 120px;">
                <div style="float:left; background-image: url('../Vue/img/default-event.png'); background-size: 100px 100px; background-repeat: no-repeat; width : 150px; height : 100px;"> Nom de l'évenement</div>
                <div style="float:left; width : 70%;">Descritpion------------------------------------------------------------------------------
                    -----------------------------------------------------------------------------------------------
                    -----------------------------------------------------------------------------------------------
                    <form>
                        <input type='hidden' name='controle' value='evenement'/>
                        <input type='hidden' name='action' value='afficherPageEvent'/>
                        <input type="submit" value="voir l'événement"/>
                    </form>
                    <div id="clear"></div>
                </div>
            </div>

            <div class="cadre" >
                <div style="float:left; width : 80%;">Descritpion------------------------------------------------------------------------------
                    -----------------------------------------------------------------------------------------------
                    -----------------------------------------------------------------------------------------------
                    <button>voir l'événement</button>
                </div>
                <div style="float:left; background-image: url('../Vue/img/default-event.png'); background-size: 100px 100px; background-repeat: no-repeat; width : 20%; height : 100px;"> Nom de l'évenement</div>
                <div id="clear"></div>
            </div>
<?php include('./footer.php'); ?>
        </div>
    </body>
</html>
