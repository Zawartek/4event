<link href="./Vue/css/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet" media="all" type="text/css">
<link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function(){
      var dialogInscription, dialogConnexion, dialogCreerEvent
      dialogInscription= $( "#dialog-inscription" ).dialog({
      autoOpen: false,
      height: 600,
      width: 500,
      modal: true,
      position : { my: "center ", at: "top", of: window },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
    
      dialogConnexion= $( "#dialog-connexion" ).dialog({
      autoOpen: false,
      height: 500,
      width: 500,
      modal: true,
      position : { my: "center", at: "top", of: window },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
    
      dialogCreerEvent= $( "#dialog-creerEvent" ).dialog({
      autoOpen: false,
      height: 700,
      width: 920,
      modal: true,
      position : { my: "center", at: "top", of: window },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
    
    
    $( "#btnInscription" ).button().on( "click", function() {
      dialogInscription.dialog( "open" );
    });
    $( "#btnConnexion" ).button().on( "click", function() {
      dialogConnexion.dialog( "open" );
    });
    $( "#btnCreerEvent" ).button().on( "click", function() {
      dialogCreerEvent.dialog( "open" );
    });
    });
    </script>
<div id="header">
    <a href="index.php"><img src="./Vue/img/logo.png" height="70px" style="margin-right: 25px;"></a>
    <a class="lien-reseau" href="index.php"><img class="logo-reseau" src="./Vue/img/2435.png" alt="home" style="margin-right:30px;"></a>     
    <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/facebook.png" alt="facebook"></a>
    <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/twitter.png" alt="twitter"></a> 
    <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/googleplus.png" alt="google+"></a>
    <?php
    if (isset($_SESSION['prenom_nom']))
    {
        
        echo '<a id="btnCreerEvent" style="margin-left:100px;" class="bold btn btn-link text-orange">ajouter un événement</a>';
        
        echo "<a href=\"index.php?controle=utilisateur&action=afficherPageUti\""
        . "class=\"bold btn btn-link text-orange\">" . $_SESSION['prenom_nom'] . "</a>";
        echo '<a href="index.php?controle=utilisateur&action=deconnexion"'
        . 'class="bold btn btn-link text-orange">Déconnexion</a>';
    }
    else
    {?>
        <a id ="btnConnexion" style="margin-left:260px;" class="bold btn btn-orange">Connexion</a>
        <a id="btnInscription" class="bold btn btn-link text-orange">Inscription</a>
    <?php }
    
    if (isset($erreur)){
        echo $erreur;
    }
    ?>
<div id="users-contain" class="ui-widget">
</div>
    <div id="dialog-connexion" title="Connexion d'un utilisateur">
        <?php include ('./Vue/connexion.php'); ?>
    </div>
    
    <div id="dialog-inscription" title="Inscription d'un utilisateur">
        <?php include ('./Vue/inscription.php'); ?>
    </div>
    
    <div id="dialog-creerEvent" title="Création d'un événement">
        <?php include ('./Vue/creationEvent.php'); ?>
    </div>
    
</div>