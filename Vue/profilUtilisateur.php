<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>profil utilisateur</title>
        <link href="./css/style.css" rel="stylesheet" media="all" type="text/css"> 
        
    </head>
    <body>
        <?php require("/header.php"); ?>
        
        <div id="content">
            <div id="profil">
                <img id="photoProfil" src="./img/default-user.png" />
                <div id="infosProfil">
                    <p>Prenom NOM</p>
                    <p>Ville</p>
                    <p>Evenements inscrits : </p>
                    <p>Evenements organisés : </p>
                </div>
                <div id="clear"></div>
            </div>
            <br>
            <div id="infosComplementaires">
                <div id="agenda">
                    <p class="titre">Agenda</p>
                    
                    <?php
                    for ($i = 0 ; $i<5 ; $i++){
                        ?>
                    <a class="eventProfil" href=""> lien événement</a>
                    <br>
                    <?php
                    }
                    ?>
                </div>
                <div id="commentaires">
                    <p class="titre">Commentaires</p>
                    <p>
                    <?php
                    for ($i = 0 ; $i<5 ; $i++){
                        ?>
                    <p class="comsProfil">
                        Commentaire---------------------------------------------
                        <br>
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
