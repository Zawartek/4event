<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <title>page événement</title>
        <link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">
        <?php include ('./Vue/map/getlatlng.php');?>
        <script type="text/javascript">
            function loadMap(){
                initialize();
            }
            function centerMap(){
                document.getElementById("description").text(geocode());
            }
        </script>
    </head>
    <body onload="loadMap()">
        <div id="content">
            <?php require("./Vue/header.php"); ?>
            <div id="profilEvent">
                <img id="photoProfil" src="./Vue/img/default-event.png" />
                <div id="infosProfil">
                    <p>
                        <?php echo $event["evenement_titre"]; ?>
                    </p>
                    <p>
                        Lieu : <span id="adress"><?php echo $event["adresse"]; ?></span>
                    </p>
                    <p id="description">
                        Description : 
                        <?php //echo $event["evenement_description"];?>
                    </p>
                </div>
            </div>
            <div id="infosEvent">
                <div id="infosOrganisateur">
                    <p>
                        Organisateur : <?php echo $event["utilisateur_nom"];?>
                    </p>
                    <p>
                        Nombres d'événements organisés : 
                    </p>
                    <a href=''>profil</a>
                </div>
                <div id="participationEvent">
                    <button>Participer</button>
                    <button>Ajouter à ses interet</button>
                </div>
            </div>
            <div id="clear"></div>
            <br>
            <div id="infosComplementaires">
                <div id="infosLieu" class="cadre">
                    <div id="map">
                        <div id="map_canvas" style="width:100%; height:400px"></div>
                        <div id="crosshair"></div>
                        <input type='button' onclick="centerMap()" value='visualiser'/>
                    </div>
                </div>
                <div id ="descriptionEvent" class="cadre">
                    <h1>Description</h1>
                    <p>
                        ----------------------------------------------------------------------------------------------------------------
                        ----------------------------------------------------------------------------------------------------------------
                        ----------------------------------------------------------------------------------------------------------------
                        ----------------------------------------------------------------------------------------------------------------<br>
                        ----------------------------------------------------------------------------------------------------------------
                        ----------------------------------------------------------------------------------------------------------------<br>
                    </p>

                </div>

                <div id="billeterie" class="cadre">
                    <h1>Lien vers la billeterie</h1>
                    <p>
                        <?php echo $event["evenement_site_web"];?>
                    </p>
                </div>

                <div id="commentairesEvent" class="cadre">
                    <h1>Commentaires</h1>
                    <p>
                        <?php
                        for ($i = 0; $i < 5; $i++) {
                            ?>
                        <p class="cadre">
                            Commentaire---------------------------------------------
                            --------------------------------------------------------
                            <br>
                            --------------------------------------------------------
                            --------------------------------------------------------
                            --------------------------------------------------------
                            <br>
                            <a href=""> lire la suite</a>
                        </p>
                        <br>
                        <?php
                    }
                    ?>
                    </p>
                </div>
                <div id="clear"></div>
            </div>
        </div>

        <div id="footer">

        </div>
    </body>
</html>
