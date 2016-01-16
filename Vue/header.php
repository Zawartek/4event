<link href="./Vue/css/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet" media="all" type="text/css">
<link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<!-- Google sign in api
<meta name="google-signin-scope" content="profile email">
<meta name="google-signin-client_id" content="129178937096-9qmmouu4uov21rk8l8l3p05hch25lgj5.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js" async defer></script> -->

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
                position: {my: "center ", at: "top", of: window},
                close: function () {
                }
            });

            dialogConnexion = $("#dialog-connexion").dialog({
                autoOpen: false,
                height: 475,
                width: 500,
                modal: true,
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
                height: 800,
                width: 850,
                modal: true,
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