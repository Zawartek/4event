<link href="./Vue/css/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet" media="all" type="text/css">
<link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<!-- Google sign in api-->
<meta name="google-signin-scope" content="profile email">
<meta name="google-signin-client_id" content="129178937096-9qmmouu4uov21rk8l8l3p05hch25lgj5.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js" async defer></script>

<script type="text/javascript">
    $(function ()
    {
<?php
if (!isset($_SESSION['prenom_nom'])) {
    ?>
            var dialogInscription, dialogConnexion, dialogCreerEvent
            dialogInscription = $("#dialog-inscription").dialog({
                autoOpen: false,
                height: 600,
                width: 500,
                modal: true,
                position: {my: "center ", at: "top", of: window},
                close: function () {
                }
            });

            dialogConnexion = $("#dialog-connexion").dialog({
                autoOpen: false,
                height: 500,
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
} else {
    ?>
            dialogCreerEvent = $("#dialog-creerEvent").dialog({
                autoOpen: false,
                height: 700,
                width: 920,
                modal: true,
                position: {my: "center", at: "top", of: window},
                close: function () {
                }
            });

            $("#btnCreerEvent").button().on("click", function () {
                dialogCreerEvent.dialog("open");
            });
<?php }
?>
    });
</script>

<div id="header">
    <a href="index.php"><img src="./Vue/img/logo.png" height="70px" style="margin-right: 25px;"></a>
    <a class="lien-reseau" href="index.php"><img class="logo-reseau" src="./Vue/img/2435.png" alt="home" style="margin-right:30px;"></a>     
    <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/facebook.png" alt="facebook"></a>
    <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/twitter.png" alt="twitter"></a> 
    <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/googleplus.png" alt="google+"></a>

    <?php
    if (isset($_SESSION['prenom_nom'])) {
        ?>
        <a id="btnCreerEvent" style="margin-left:90px;" 
           class="bold btn btn-orange">Ajouter un Evénement</a>

        <a href="index.php?controle=utilisateur&action=afficherPageUti&param=<?php echo $_SESSION['userID']; ?>" 
           style="display:inline"
           class="bold btn btn-link text-orange"> 
               <?php echo $_SESSION['prenom_nom']; ?> 
        </a>

        <a href="index.php?controle=utilisateur&action=deconnexion" 
           style="display:inline"
           class="bold btn btn-link text-orange">Déconnexion
        </a>
    
        <a href="#" onclick="signOut();">Sign out</a>
        <script>
            function signOut() {
                var auth2 = gapi.auth2.getAuthInstance();
                auth2.signOut().then(function () {
                    console.log('User signed out.');
                });
            }
        </script>
        <?php
    } else {
        ?>
        <div style="float: right;">
            <a id ="btnConnexion" class="bold btn btn-orange">Connexion</a>
            <a id="btnInscription" class="bold btn btn-link text-orange">Inscription</a>
        </div>
        <?php
    }

    if (isset($erreur)) {
        echo $erreur;
    }
    ?>

    <div id="users-contain" class="ui-widget"></div>
    <?php
    if (!isset($_SESSION['prenom_nom'])) {
        ?>
        <div id="dialog-connexion" title="Connexion d'un utilisateur">
            <?php include ('./Vue/connexion.php'); ?>
        </div>

        <div id="dialog-inscription" title="Inscription d'un utilisateur">
            <?php include ('./Vue/inscription.php'); ?>
        </div>

        <script>
            function onSignIn(googleUser) {
                // Useful data for your client-side scripts:
                var profile = googleUser.getBasicProfile();
                console.log("ID: " + profile.getId()); // Don't send this directly to your server!
                console.log("Name: " + profile.getName());
                console.log("Image URL: " + profile.getImageUrl());
                console.log("Email: " + profile.getEmail());
                // The ID token you need to pass to your backend:
                var id_token = googleUser.getAuthResponse().id_token;
                console.log("ID Token: " + id_token);
            }
        </script>
		
        <!-- <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div> -->

        
        <?php
    } else {
        ?>
        <div id="dialog-creerEvent" title="Création d'un événement">
            <?php
            $themes = getThemeEvent();
            include ('./Vue/creationEvent.php');
            ?>
        </div>

        <?php if ($_SESSION['userType'] == 2) { ?>
            <a class="lien-reseau" 
               href="index.php?controle=utilisateur&action=afficherPageAdmin">
                <img class="logo-reseau" src="./Vue/img/2435.png" 
                     alt="home" style="margin-right:30px;">
            </a>     

            <?php
        }
    }
    ?>

</div>