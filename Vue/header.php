<link href="./Vue/css/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet" media="all" type="text/css">
<link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="./Vue/js/datepicker.js"></script>   

<?php
$date = (isset($_POST["date"])) ? formattageDate ($_POST["date"],"bdd") : date("Y-m-d");
?>

<script type="text/javascript">
    $(function ()
    {
        <?php
        if (!isset($_SESSION['prenom_nom']))
        { ?>
            var dialogInscription, dialogConnexion, dialogCreerEvent
            dialogInscription = $("#dialog-inscription").dialog({
                autoOpen: false,
                height: 640,
                width: 500,
                modal: true,
                resizable: false,
                draggable: false,
                position: {my: "center ", at: "top", of: window},
                close: function () {
                }
            });

            dialogConnexion = $("#dialog-connexion").dialog({
                autoOpen: false,
                height: 390,
                width: 500,
                modal: true,
                resizable: false,
                draggable: false,
                position: {my: "center", at: "top", of: window},
                close: function () {
                }
            });

            $("#btnInscription").button().on("click", function () {
                dialogInscription.dialog("open");
            });

            $("#btnConnexion").button().on("click", function () {
                dialogConnexion.dialog("open");
            });
        <?php
        }
        else
        {  ?>
            dialogCreerEvent = $("#dialog-creerEvent").dialog({
                autoOpen: false,
                height: 780,
                width: 850,
                modal: true,
                resizable: false,
                draggable: false,
                position: {my: "center", at: "top", of: window},
                close: function () {
                }
            });

            $("#btnCreerEvent").button().on("click", function () {
                dialogCreerEvent.dialog("open");
            });
            $("#btnBackOffice").button();
        <?php
        } ?>
    });
</script>
<script type="text/javascript">
    $(function ()
    {
        $("#date").datepicker($.datepicker.regional["fr"]);
        $("#date").datepicker('setDate', new Date(<?php echo json_encode($date); ?>));
    });
</script>

<div id="header">
    <div style="display: block; ">
        <a href="index.php"><img src="./Vue/img/logo.png" height="70px" style="margin-right: 25px;"></a>
        <a class="lien-reseau" href="index.php" style="margin-right:30px;"><img class="logo-reseau" src="./Vue/img/2435.png" alt="home"></a>

    <?php
    if (isset($_SESSION['prenom_nom']))
    {
        $urlProfil = "index.php?controle=utilisateur&action=afficherPageUti&param=".$_SESSION['userID'];
        ?>
        <nav class="NomPrenDecon" >
            <a href="<?php echo $urlProfil; ?>" style="display:inline" class="bold btn btn-link text-orange">
                <?php echo $_SESSION['prenom_nom']; ?>
            </a>
            <a href="index.php?controle=utilisateur&action=deconnexion" style="display:inline" class="bold btn btn-link text-orange">
                Déconnexion
            </a>
        </nav>
    </div>
    <div class="barreMenu" >
        <a id="btnCreerEvent" style="margin: 5px; float: right;" class="bold btn">Ajouter un Evénement</a>

        <?php
        if ($_SESSION['userType'] == 2)
        { ?>
            <a id="btnBackOffice" style="margin: 5px; float: right;" class="bold btn"
               href="index.php?controle=admin&action=afficherPageAdminGU">
                BackOffice
            </a>
        <?php
        } ?>
    </div>
    <?php
    }
    else
    { ?>
        <div style="float: right;">
            <a id ="btnConnexion" class="bold btn btn-orange">Connexion</a>
            <a id="btnInscription" class="bold btn btn-link text-orange">Inscription</a>
        </div>
        </div>
    <?php
    }

    if (isset($erreur)) { echo $erreur; }
    ?>

    <div id="users-contain" class="ui-widget"></div>
    <?php
    if (!isset($_SESSION['prenom_nom']))
    { ?>
        <div id="dialog-connexion" title="Connexion d'un utilisateur">
            <?php include ('./Vue/connexion.php'); ?>
        </div>

        <div id="dialog-inscription" title="Inscription d'un utilisateur">
            <?php include ('./Vue/inscription.php'); ?>
        </div>
    <?php
    }
    else
    { ?>
        <div id="dialog-creerEvent" title="Création d'un événement">
            <?php
            $themes = getThemeEvent();
            include ('./Vue/creationEvent.php');
            ?>
        </div>
    <?php
    } ?>
</div>

<form id="barreRecherche" method="post" action="./index.php?controle=utilisateur&action=accueil">
    <input type="text" id="date" name="date" class="date" readonly="readonly">                    
    <input type="text" id="motCle" name="motCle" placeholder="Mot Clé">
    <input type="text" id="ville" name="ville" placeholder="Ville">
    <select id="choixTheme" name="choixTheme" class="input">
        <option value="0">Tous</option>
        <?php
        foreach ($themes as $theme) {
            echo '<option value="' . $theme["theme_id"] . '">' . $theme["theme_nom"] . '</option>';
        }
        ?>
    </select>
    <input type="submit" id="valider" class="bold btn btn-orange" value="Rechercher">
</form>