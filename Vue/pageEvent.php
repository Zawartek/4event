<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>page événement</title>
        <link href="./css/style.css" rel="stylesheet" media="all" type="text/css"> 
        
    </head>
    <body>
        <?php require("./header.php"); ?>
        
        <div id="content">
            <div id="profilEvent">
                <img id="photoProfil" src="./img/default-event.png" />
                <div id="infosProfil">
                    <p>Nom événement</p>
                    <p>Lieu : </p>
                    <p>Description : </p>
                </div>
            </div>
            <div id="infosEvent">
                <div id="infosOrganisateur">
                    <p>Organisateur : </p>
                    <p>Nombres d'événements organisés : </p>
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
                    <div id="map"></div>
                    <p>Lieu : </p>
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
                        -------------------------------------------------
                    </p>
                </div>
               
                <div id="commentairesEvent" class="cadre">
                    <h1>Commentaires</h1>
                    <p>
                    <?php
                    for ($i = 0 ; $i<5 ; $i++){
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
